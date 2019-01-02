<?php

namespace App\Http\Controllers\Admin;

use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProvincesRequest;
use App\Http\Requests\Admin\UpdateProvincesRequest;

class ProvincesController extends Controller
{
    /**
     * Display a listing of Province.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('province_access')) {
            return abort(401);
        }


                $provinces = Province::all();

        return view('admin.provinces.index', compact('provinces'));
    }

    /**
     * Show the form for creating new Province.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('province_create')) {
            return abort(401);
        }
        return view('admin.provinces.create');
    }

    /**
     * Store a newly created Province in storage.
     *
     * @param  \App\Http\Requests\StoreProvincesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProvincesRequest $request)
    {
        if (! Gate::allows('province_create')) {
            return abort(401);
        }
        $province = Province::create($request->all());



        return redirect()->route('admin.provinces.index');
    }


    /**
     * Show the form for editing Province.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('province_edit')) {
            return abort(401);
        }
        $province = Province::findOrFail($id);

        return view('admin.provinces.edit', compact('province'));
    }

    /**
     * Update Province in storage.
     *
     * @param  \App\Http\Requests\UpdateProvincesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvincesRequest $request, $id)
    {
        if (! Gate::allows('province_edit')) {
            return abort(401);
        }
        $province = Province::findOrFail($id);
        $province->update($request->all());



        return redirect()->route('admin.provinces.index');
    }


    /**
     * Display Province.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('province_view')) {
            return abort(401);
        }
        $cities = \App\City::where('province_id', $id)->get();$hotels = \App\Hotel::where('provincia_id', $id)->get();$congresses = \App\Congress::where('id_prov_sede_id', $id)->get();

        $province = Province::findOrFail($id);

        return view('admin.provinces.show', compact('province', 'cities', 'hotels', 'congresses'));
    }


    /**
     * Remove Province from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('province_delete')) {
            return abort(401);
        }
        $province = Province::findOrFail($id);
        $province->delete();

        return redirect()->route('admin.provinces.index');
    }

    /**
     * Delete all selected Province at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('province_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Province::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
