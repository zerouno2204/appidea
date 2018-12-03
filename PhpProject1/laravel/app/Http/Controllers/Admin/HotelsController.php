<?php

namespace App\Http\Controllers\Admin;

use App\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHotelsRequest;
use App\Http\Requests\Admin\UpdateHotelsRequest;

class HotelsController extends Controller
{
    /**
     * Display a listing of Hotel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('hotel_access')) {
            return abort(401);
        }


                $hotels = Hotel::all();

        return view('admin.hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating new Hotel.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('hotel_create')) {
            return abort(401);
        }
        
        $cittas = \App\City::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $provincias = \App\Province::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.hotels.create', compact('cittas', 'provincias'));
    }

    /**
     * Store a newly created Hotel in storage.
     *
     * @param  \App\Http\Requests\StoreHotelsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHotelsRequest $request)
    {
        if (! Gate::allows('hotel_create')) {
            return abort(401);
        }
        $hotel = Hotel::create($request->all());



        return redirect()->route('admin.hotels.index');
    }


    /**
     * Show the form for editing Hotel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('hotel_edit')) {
            return abort(401);
        }
        
        $cittas = \App\City::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $provincias = \App\Province::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        $hotel = Hotel::findOrFail($id);

        return view('admin.hotels.edit', compact('hotel', 'cittas', 'provincias'));
    }

    /**
     * Update Hotel in storage.
     *
     * @param  \App\Http\Requests\UpdateHotelsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHotelsRequest $request, $id)
    {
        if (! Gate::allows('hotel_edit')) {
            return abort(401);
        }
        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->all());



        return redirect()->route('admin.hotels.index');
    }


    /**
     * Display Hotel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('hotel_view')) {
            return abort(401);
        }
        
        $cittas = \App\City::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $provincias = \App\Province::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');$congress_hotels = \App\CongressHotel::where('id_hotel_id', $id)->get();$images_hotels = \App\ImagesHotel::where('hotel_id', $id)->get();$rooms = \App\Room::where('id_hotel_id', $id)->get();$registrations = \App\Registration::where('id_hotel_id', $id)->get();

        $hotel = Hotel::findOrFail($id);

        return view('admin.hotels.show', compact('hotel', 'congress_hotels', 'images_hotels', 'rooms', 'registrations'));
    }


    /**
     * Remove Hotel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('hotel_delete')) {
            return abort(401);
        }
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->route('admin.hotels.index');
    }

    /**
     * Delete all selected Hotel at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('hotel_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Hotel::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
