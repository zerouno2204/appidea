<?php

namespace App\Http\Controllers\Admin;

use App\CongressHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCongressHotelsRequest;
use App\Http\Requests\Admin\UpdateCongressHotelsRequest;

class CongressHotelsController extends Controller
{
    /**
     * Display a listing of CongressHotel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('congress_hotel_access')) {
            return abort(401);
        }


                $congress_hotels = CongressHotel::all();

        return view('admin.congress_hotels.index', compact('congress_hotels'));
    }

    /**
     * Show the form for creating new CongressHotel.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('congress_hotel_create')) {
            return abort(401);
        }
        
        $id_congresses = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_hotels = \App\Hotel::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.congress_hotels.create', compact('id_congresses', 'id_hotels'));
    }

    /**
     * Store a newly created CongressHotel in storage.
     *
     * @param  \App\Http\Requests\StoreCongressHotelsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCongressHotelsRequest $request)
    {
        if (! Gate::allows('congress_hotel_create')) {
            return abort(401);
        }
        $congress_hotel = CongressHotel::create($request->all());



        return redirect()->route('admin.congress_hotels.index');
    }


    /**
     * Show the form for editing CongressHotel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('congress_hotel_edit')) {
            return abort(401);
        }
        
        $id_congresses = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_hotels = \App\Hotel::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        $congress_hotel = CongressHotel::findOrFail($id);

        return view('admin.congress_hotels.edit', compact('congress_hotel', 'id_congresses', 'id_hotels'));
    }

    /**
     * Update CongressHotel in storage.
     *
     * @param  \App\Http\Requests\UpdateCongressHotelsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCongressHotelsRequest $request, $id)
    {
        if (! Gate::allows('congress_hotel_edit')) {
            return abort(401);
        }
        $congress_hotel = CongressHotel::findOrFail($id);
        $congress_hotel->update($request->all());



        return redirect()->route('admin.congress_hotels.index');
    }


    /**
     * Display CongressHotel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('congress_hotel_view')) {
            return abort(401);
        }
        $congress_hotel = CongressHotel::findOrFail($id);

        return view('admin.congress_hotels.show', compact('congress_hotel'));
    }


    /**
     * Remove CongressHotel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('congress_hotel_delete')) {
            return abort(401);
        }
        $congress_hotel = CongressHotel::findOrFail($id);
        $congress_hotel->delete();

        return redirect()->route('admin.congress_hotels.index');
    }

    /**
     * Delete all selected CongressHotel at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('congress_hotel_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CongressHotel::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
