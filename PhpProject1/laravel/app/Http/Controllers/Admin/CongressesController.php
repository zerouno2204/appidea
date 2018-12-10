<?php

namespace App\Http\Controllers\Admin;

use App\Congress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCongressesRequest;
use App\Http\Requests\Admin\UpdateCongressesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Hotel;
use App\Room;
use App\Congress_Rooms;
use App\CongressHotel;
use App\SpeakersCongress;

class CongressesController extends Controller {

    use FileUploadTrait;

    /**
     * Display a listing of Congress.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!Gate::allows('congress_access')) {
            return abort(401);
        }


        $congresses = Congress::all();

        return view('admin.congresses.index', compact('congresses'));
    }

    /**
     * Show the form for creating new Congress.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (!Gate::allows('congress_create')) {
            return abort(401);
        }
        $relatori = \App\Speaker::all();
        $id_citta_sedes = \App\City::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $id_prov_sedes = \App\Province::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $hotels = \App\Hotel::all();
        return view('admin.congresses.create', compact('hotels', 'id_citta_sedes', 'id_prov_sedes', 'relatori'));
    }

    /**
     * Store a newly created Congress in storage.
     *
     * @param  \App\Http\Requests\StoreCongressesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCongressesRequest $request) {
        if (!Gate::allows('congress_create')) {
            return abort(401);
        }

        $input = $request->input();

        //dd($input);

        $request = $this->saveFiles($request);
        $congress = Congress::create($request->all());

        foreach ($input['hotels'] as $id_hotel) {
            $hotel = Hotel::find($id_hotel);
            if (!empty($hotel)) {
                $congress_hotel = new CongressHotel();
                $congress_hotel->id_congress_id = $congress->id;
                $congress_hotel->id_hotel_id = $hotel->id;
                $congress_hotel->save();
            }
        }

        foreach ($input['rooms'] as $id_room) {
            $room = Room::find($id_room);
            if (!empty($room) && $input['qty-' . $room->id] > 0) {
                $congress_room = new Congress_Rooms();
                $congress_room->id_congress = $congress->id;
                $congress_room->id_room = $room->id;
                $congress_room->qty = $input['qty-' . $room->id];
                $congress_room->save();
            }
        }

        $relatori = $input['relatori[]'];

        foreach ($relatori as $relatore) {
            $relatoreCongress = new SpeakersCongress();
            $relatoreCongress->id_congress_id = $congress->id;
            $relatoreCongress->id_speaker_id = $relatore;
            $relatoreCongress->save();
        }



        return redirect()->route('admin.congresses.index');
    }

    public function getRooms(Request $request) {
        $input = $request->input();

        $array = $input['selected'];
        $i = 0;

        foreach ($array as $item) {
            $array[$i] = Hotel::with('rooms')->where('id', $item)->first();

            $i = $i + 1;
        }

        return response()->json($array);
    }
    
    public function getCongressRooms(Request $request) {
        $input = $request->input();
        
        $i = 0;
        $hotel_id = $input['hotel_id'];
        $congress_id = $input['congress_id'];
        $array = [];
        $rooms= Room::where('id_hotel_id', $hotel_id)->get();
        
        foreach ($rooms as $room){            
            $congressRoom = Congress_Rooms::where('id_room', $room->id)->where('id_congress', $congress_id)->first();
            
            if(!empty($congressRoom)){
                $array[$i] = $room;
                
                $i = $i + 1;
            }
            
        }
           
        return response()->json($array);
    }

    /**
     * Show the form for editing Congress.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (!Gate::allows('congress_edit')) {
            return abort(401);
        }

        $relatori = \App\Speaker::all();
        $id_citta_sedes = \App\City::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $id_prov_sedes = \App\Province::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $congress_hotel = CongressHotel::where('id_congress_id', $id)->get();
        $congress_room = Congress_Rooms::where('id_congress', $id)->get();
        $congress_relatori = SpeakersCongress::where('id_congress_id', $id)->get();
        $rooms = Room::all();
        $hotels = Hotel::all();
        $congress = Congress::findOrFail($id);


        return view('admin.congresses.edit', compact('congress_relatori', 'relatori', 'hotels', 'rooms', 'congress', 'id_citta_sedes', 'id_prov_sedes', 'congress_hotel', 'congress_room'));
    }

    /**
     * Update Congress in storage.
     *
     * @param  \App\Http\Requests\UpdateCongressesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCongressesRequest $request, $id) {
        if (!Gate::allows('congress_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $congress = Congress::findOrFail($id);
        $congress->update($request->all());

        $input = $request->input();

        if (isset($input['hotels'])) {
            foreach ($input['hotels'] as $id_hotel) {
                $old_relation = CongressHotel::where('id_hotel_id', $id_hotel)->where('id_congress_id', $congress->id)->first();

                if (empty($old_relation)) {
                    $hotel = Hotel::find($id_hotel);
                    if (!empty($hotel)) {
                        $congress_hotel = new CongressHotel();
                        $congress_hotel->id_congress_id = $congress->id;
                        $congress_hotel->id_hotel_id = $hotel->id;
                        $congress_hotel->save();
                    }
                }
            }


            foreach ($input['rooms'] as $id_room) {

                $old_relation_room = Congress_Rooms::where('id_room', $id_room)->where('id_congress', $congress->id)->first();

                if (empty($old_relation_room)) {
                    $room = Room::find($id_room);
                    if (!empty($room) && $input['qty-' . $room->id] > 0) {
                        $congress_room = new Congress_Rooms();
                        $congress_room->id_congress = $congress->id;
                        $congress_room->id_room = $room->id;
                        $congress_room->qty = $input['qty-' . $room->id];
                        $congress_room->save();
                    }
                } else {
                    if (!empty($room) && $input['qty-' . $room->id] > 0) {
                        $old_relation_room->qty = $input['qty-' . $room->id];
                        $old_relation_room->save();
                    }
                }
            }
        }

        if (isset($input['relatori[]'])) {

            $relatori = $input['relatori[]'];

            foreach ($relatori as $relatore) {

                $old_relation_relatore = SpeakersCongress::where('id_congress_id', $congress->id)->where('id_speaker_id', $relatore)->first();

                if (empty($old_relation_relatore)) {
                    $relatoreCongress = new SpeakersCongress();
                    $relatoreCongress->id_congress_id = $congress->id;
                    $relatoreCongress->id_speaker_id = $relatore;
                    $relatoreCongress->save();
                }
            }
        }

        return redirect()->route('admin.congresses.index');
    }

    /**
     * Display Congress.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if (!Gate::allows('congress_view')) {
            return abort(401);
        }
        
        $congress = Congress::findOrFail($id);
        
        $congress_entries = \App\CongressEntry::where('id_congress_id', $id)->get();
        $congress_hotels = \App\CongressHotel::where('id_congress_id', $id)->get();
        $speakers_congresses = \App\SpeakersCongress::where('id_congress_id', $id)->get();
        $days = \App\Day::where('id_congresso_id', $id)->get();
        $codes = \App\Code::where('id_congress_id', $id)->get();
        $registrations = \App\Registration::where('id_congress_id', $id)->get();
        $congress_rooms = Congress_Rooms::with('room.id_hotel')->where('id_congress', $id)->get();

        //dd($congress_hotels);

        return view('admin.congresses.show', compact('congress_rooms', 'congress', 'congress_entries', 'congress_hotels', 'speakers_congresses', 'days', 'codes', 'registrations'));
    }

    public function showEvent($id) {
        
        $congress_entries = \App\CongressEntry::where('id_congress_id', $id)->get();
        $congress_hotels = \App\CongressHotel::where('id_congress_id', $id)->get();
        $speakers_congresses = \App\SpeakersCongress::where('id_congress_id', $id)->get();
        $days = \App\Day::where('id_congresso_id', $id)->get();
        $codes = \App\Code::where('id_congress_id', $id)->get();
        $registrations = \App\Registration::where('id_congress_id', $id)->get();
        $congress_rooms = Congress_Rooms::with('room.id_hotel')->where('id_congress', $id)->get();

        $congress = Congress::findOrFail($id);
        
        $citta = \App\City::where('id',$congress->id_citta_sede_id)->first();
        $prov = \App\Province::where('id',$congress->id_prov_sede_id)->first();
           
        if (empty($congress->lat) || empty($congress->lng)) {
            $prepAddr = str_replace(' ', '+', $congress->ind_sede.'+'.$citta->name.'+'.$prov->slug);
            $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&key=AIzaSyCp20T5LN8Yk8dW4TaLj6KvTpdSF8L223I');
            $output = json_decode($geocode);
            //dd($output);
            $congress->lat = $output->results[0]->geometry->location->lat;
            $congress->lng = $output->results[0]->geometry->location->lng;
            $congress->save();
        }

        return view('customer.congress.show', compact('congress_rooms', 'congress', 'congress_entries', 'congress_hotels', 'speakers_congresses', 'days', 'codes', 'registrations'));
    }

    /**
     * Remove Congress from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if (!Gate::allows('congress_delete')) {
            return abort(401);
        }
        $congress = Congress::findOrFail($id);
        $congress->delete();

        return redirect()->route('admin.congresses.index');
    }

    /**
     * Delete all selected Congress at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request) {
        if (!Gate::allows('congress_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Congress::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
