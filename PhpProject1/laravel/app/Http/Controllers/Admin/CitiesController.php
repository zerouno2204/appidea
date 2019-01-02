<?php

namespace App\Http\Controllers\Admin;

use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCitiesRequest;
use App\Http\Requests\Admin\UpdateCitiesRequest;

class CitiesController extends Controller
{
    /**
     * Display a listing of City.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('city_access')) {
            return abort(401);
        }


                $cities = City::all();

        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating new City.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('city_create')) {
            return abort(401);
        }
        
        $provinces = \App\Province::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.cities.create', compact('provinces'));
    }

    /**
     * Store a newly created City in storage.
     *
     * @param  \App\Http\Requests\StoreCitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCitiesRequest $request)
    {
        if (! Gate::allows('city_create')) {
            return abort(401);
        }
        $city = City::create($request->all());



        return redirect()->route('admin.cities.index');
    }


    /**
     * Show the form for editing City.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('city_edit')) {
            return abort(401);
        }
        
        $provinces = \App\Province::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        $city = City::findOrFail($id);

        return view('admin.cities.edit', compact('city', 'provinces'));
    }

    /**
     * Update City in storage.
     *
     * @param  \App\Http\Requests\UpdateCitiesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCitiesRequest $request, $id)
    {
        if (! Gate::allows('city_edit')) {
            return abort(401);
        }
        $city = City::findOrFail($id);
        $city->update($request->all());



        return redirect()->route('admin.cities.index');
    }


    /**
     * Display City.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('city_view')) {
            return abort(401);
        }
        
        $provinces = \App\Province::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');$hotels = \App\Hotel::where('citta_id', $id)->get();$congresses = \App\Congress::where('id_citta_sede_id', $id)->get();

        $city = City::findOrFail($id);

        return view('admin.cities.show', compact('city', 'hotels', 'congresses'));
    }


    /**
     * Remove City from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('city_delete')) {
            return abort(401);
        }
        $city = City::findOrFail($id);
        $city->delete();

        return redirect()->route('admin.cities.index');
    }

    /**
     * Delete all selected City at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('city_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = City::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
