<?php

namespace App\Http\Controllers\Admin;

use App\Congress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCongressesRequest;
use App\Http\Requests\Admin\UpdateCongressesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class CongressesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Congress.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('congress_access')) {
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
    public function create()
    {
        if (! Gate::allows('congress_create')) {
            return abort(401);
        }
        
        $id_citta_sedes = \App\City::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $id_prov_sedes = \App\Province::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.congresses.create', compact('id_citta_sedes', 'id_prov_sedes'));
    }

    /**
     * Store a newly created Congress in storage.
     *
     * @param  \App\Http\Requests\StoreCongressesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCongressesRequest $request)
    {
        if (! Gate::allows('congress_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $congress = Congress::create($request->all());



        return redirect()->route('admin.congresses.index');
    }


    /**
     * Show the form for editing Congress.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('congress_edit')) {
            return abort(401);
        }
        
        $id_citta_sedes = \App\City::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $id_prov_sedes = \App\Province::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        $congress = Congress::findOrFail($id);

        return view('admin.congresses.edit', compact('congress', 'id_citta_sedes', 'id_prov_sedes'));
    }

    /**
     * Update Congress in storage.
     *
     * @param  \App\Http\Requests\UpdateCongressesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCongressesRequest $request, $id)
    {
        if (! Gate::allows('congress_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $congress = Congress::findOrFail($id);
        $congress->update($request->all());



        return redirect()->route('admin.congresses.index');
    }


    /**
     * Display Congress.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('congress_view')) {
            return abort(401);
        }
        
        $id_citta_sedes = \App\City::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $id_prov_sedes = \App\Province::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');$congress_entries = \App\CongressEntry::where('id_congress_id', $id)->get();$congress_hotels = \App\CongressHotel::where('id_congress_id', $id)->get();$speakers_congresses = \App\SpeakersCongress::where('id_congress_id', $id)->get();$days = \App\Day::where('id_congresso_id', $id)->get();$codes = \App\Code::where('id_congress_id', $id)->get();$registrations = \App\Registration::where('id_congress_id', $id)->get();

        $congress = Congress::findOrFail($id);

        return view('admin.congresses.show', compact('congress', 'congress_entries', 'congress_hotels', 'speakers_congresses', 'days', 'codes', 'registrations'));
    }


    /**
     * Remove Congress from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('congress_delete')) {
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
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('congress_delete')) {
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
