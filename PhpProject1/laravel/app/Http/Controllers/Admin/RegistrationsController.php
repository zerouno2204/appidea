<?php

namespace App\Http\Controllers\Admin;

use App\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRegistrationsRequest;
use App\Http\Requests\Admin\UpdateRegistrationsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\DocumentType;
use App\Image;
use App\RegistrationImage;
use App\Code;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\User;



class RegistrationsController extends Controller {

    use FileUploadTrait;

    /**
     * Display a listing of Registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!Gate::allows('registration_access')) {
            return abort(401);
        }


        $registrations = Registration::all();

        return view('admin.registrations.index', compact('registrations'));
    }

    /**
     * Show the form for creating new Registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (!Gate::allows('registration_create')) {
            return abort(401);
        }

        $id_entries = \App\Entry::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_congresses = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_speakers = \App\Speaker::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_hotels = \App\Hotel::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $id_cameras = \App\Room::get()->pluck('descrizione', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.registrations.create', compact('id_entries', 'id_congresses', 'id_speakers', 'id_hotels', 'id_users', 'id_cameras'));
    }

    public function registration($congress_id) {
        if (!Gate::allows('registration_create')) {
            return abort(401);
        }

        $roles = \App\Role::all();
        $id_entries = \App\Entry::whereIn('id', function($q) use ($congress_id) {
                    $q->select('id_entry_id')
                            ->from('congress_entries')
                            ->where('id_congress_id', $congress_id);
                })->get();
        $congress = \App\Congress::where('id', $congress_id)->first();
        $id_speakers = \App\Speaker::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_tipo_doc = DocumentType::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        $id_hotels = \App\Hotel::whereIn('id', function($q) use ($congress_id) {
                    $q->select('id_hotel_id')
                            ->from('congress_hotels')
                            ->where('id_congress_id', $congress_id);
                })->get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        $id_cameras = \App\Room::whereIn('id', function($q) use ($congress_id) {
                    $q->select('id_room')
                            ->from('room_congress')
                            ->where('id_congress', $congress_id);
                })->get()->pluck('descrizione', 'id')->prepend(trans('global.app_please_select'), '');

        return view('customer.registration.create', compact('roles', 'id_tipo_doc', 'id_entries', 'congress', 'id_speakers', 'id_hotels', 'id_users', 'id_cameras'));
    }
    
    public function checkCode(Request $request){
        $input = $request->input();
        
        
        if(!empty($input['code'])){
            $code = $input['code'];
            
            $check = Code::where('code', $code)->where('id_congress_id', $input['congress'])->first();
                                            
            if(!empty($check)){
                return 'True';
            } else {
                return 'FALSE';
            }
        }
                
    }

    /**
     * Store a newly created Registration in storage.
     *
     * @param  \App\Http\Requests\StoreRegistrationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegistrationsRequest $request) {
        if (!Gate::allows('registration_create')) {
            return abort(401);
        }

        $input = $request->input();
        //$request = $this->saveFiles($request);
        
        $registration = Registration::create($request->all());

        $images = array();
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('image', $name);
                $images[] = $name;
                
                $img = new Image();
                $img->nome = $name;
                $img->save();
                
                $registrationImage = new RegistrationImage();
                $registrationImage->id_image = $img->id;
                $registrationImage->id_registrazione = $registration->id;
                //$registrationImage->save();
                //dd($registrationImage);
            }
        }
        
     
        //$writer->writeFile( url('/registation/qrlink/').$registration->id, $registration->id.'-qrCode.png' );
        
        $registration->qrcode = $registration->id.'-qrCode.png';

        if ($input['nome']) {
            $registration->nome = $input['nome'];
        }
        if ($input['cognome']) {
            $registration->cognome = $input['cognome'];
        }
        
        $iscrizione = \App\Entry::where('id', $registration->id_entry_id)->first();
        if( $iscrizione->ab_codice == 1 && !empty($input['codice']) ){
            $registration->codice == 1;
            $codice = Code::where('code', $input['codice'])->first();
            $codice->id_user_id = Auth()->user()->id;
            $codice->save();
        }
        
        //$registration->save();
        
        
        
         $this->sendMail($registration->id);
        
        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3){
        return redirect()->route('admin.registrations.index');
        } else {
         return redirect('/admin/customer-index-congress');   
        }
    }
    
    public function sendMail($id){        
        
       $registration = Registration::with('id_entry','id_congress.id_citta_sede','id_hotel','id_camera')->where('id',$id)->where('id_user_id', Auth::user()->id)->first();
       
       $congress = $registration->id_congress;
       
       $id_congress = $congress->id;
       $user_id =  Auth::user()->id;
       
       
       
       $azienda = User::whereIn('id', function ($q) use($id_congress, $user_id) {
           $q->select('sponsor')
                   ->from('codes')
                   ->where('id_congress_id', $id_congress)
                   ->where('id_user_id', $user_id);
       })->first();
        
        $images = Image::whereIn('id', function ($q) use ($id){
            $q->select('id_image')
                    ->from('images_registration')
                    ->where('id_registrazione', $id);
        })->get();
        
        $user = Auth::user();      
               
         if(!empty($azienda) && !empty($azienda->email)){
        Mail::to($user->email)
                ->cc('info@flamingosoftware.it')
                ->cc('c.centi@ideacpa.com')
                ->cc('e.diana@ideacpa.com')
                ->cc($congress->email_referente)               
                ->cc($azienda->email)                
                ->send( new SendEmail($registration));
         }else{
             Mail::to($user->email)
                ->cc('info@flamingosoftware.it')
                ->cc('c.centi@ideacpa.com')
                ->cc('e.diana@ideacpa.com')
                ->cc($congress->email_referente)      
                ->send( new SendEmail($registration));
         }
        
        
        //return new SendEmail($registration);
        
    }

    /**
     * Show the form for editing Registration.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (!Gate::allows('registration_edit')) {
            return abort(401);
        }

        $id_entries = \App\Entry::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_congresses = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_speakers = \App\Speaker::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_hotels = \App\Hotel::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $id_cameras = \App\Room::get()->pluck('descrizione', 'id')->prepend(trans('global.app_please_select'), '');

        $registration = Registration::findOrFail($id);

        return view('admin.registrations.edit', compact('registration', 'id_entries', 'id_congresses', 'id_speakers', 'id_hotels', 'id_users', 'id_cameras'));
    }

    /**
     * Update Registration in storage.
     *
     * @param  \App\Http\Requests\UpdateRegistrationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegistrationsRequest $request, $id) {
        if (!Gate::allows('registration_edit')) {
            return abort(401);
        }
        $registration = Registration::findOrFail($id);
        $registration->update($request->all());



        return redirect()->route('admin.registrations.index');
    }

    /**
     * Display Registration.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if (!Gate::allows('registration_view')) {
            return abort(401);
        }
        $registration = Registration::findOrFail($id);
        
        $images = Image::whereIn('id', function ($q) use ($id){
            $q->select('id_image')
                    ->from('images_registration')
                    ->where('id_registrazione', $id);
        })->get();

        return view('admin.registrations.show', compact('registration', 'images'));
    }

    /**
     * Remove Registration from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if (!Gate::allows('registration_delete')) {
            return abort(401);
        }
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return redirect()->route('admin.registrations.index');
    }

    /**
     * Delete all selected Registration at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request) {
        if (!Gate::allows('registration_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Registration::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
    
    public function customerShow($id) {
        $registration = Registration::with('id_entry','id_congress','id_hotel','id_camera')->where('id',$id)->where('id_user_id', Auth::user()->id)->first();
        
        $images = Image::whereIn('id', function ($q) use ($id){
            $q->select('id_image')
                    ->from('images_registration')
                    ->where('id_registrazione', $id);
        })->get();

        return view('customer.registration.show', compact('registration', 'images'));
    }
    
    public function QrCodeShow($id) {
        $registration = Registration::with('id_entry','id_congress','id_hotel','id_camera')->where('id',$id)->first();
        $user = App\User::where('id', $registration->id_user_id)->first();
        $images = Image::whereIn('id', function ($q) use ($id){
            $q->select('id_image')
                    ->from('images_registration')
                    ->where('id_registrazione', $id);
        })->get();

        return view('customer.registration.qr_show', compact('registration', 'images', 'user'));
    }
    
     public function customerIndex() {
       
        $registrations = Registration::where('id_user_id', Auth::user()->id)->get();

        return view('customer.registration.index', compact('registrations'));
    }

}
