<?php

namespace App\Http\Controllers\Admin;

use App\ImagesHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreImagesHotelsRequest;
use App\Http\Requests\Admin\UpdateImagesHotelsRequest;

class ImagesHotelsController extends Controller
{
    /**
     * Display a listing of ImagesHotel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('images_hotel_access')) {
            return abort(401);
        }


                $images_hotels = ImagesHotel::all();

        return view('admin.images_hotels.index', compact('images_hotels'));
    }

    /**
     * Show the form for creating new ImagesHotel.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('images_hotel_create')) {
            return abort(401);
        }
        
        $imgs = \App\Image::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $hotels = \App\Hotel::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.images_hotels.create', compact('imgs', 'hotels'));
    }

    /**
     * Store a newly created ImagesHotel in storage.
     *
     * @param  \App\Http\Requests\StoreImagesHotelsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImagesHotelsRequest $request)
    {
        if (! Gate::allows('images_hotel_create')) {
            return abort(401);
        }
        $images_hotel = ImagesHotel::create($request->all());



        return redirect()->route('admin.images_hotels.index');
    }


    /**
     * Show the form for editing ImagesHotel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('images_hotel_edit')) {
            return abort(401);
        }
        
        $imgs = \App\Image::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $hotels = \App\Hotel::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        $images_hotel = ImagesHotel::findOrFail($id);

        return view('admin.images_hotels.edit', compact('images_hotel', 'imgs', 'hotels'));
    }

    /**
     * Update ImagesHotel in storage.
     *
     * @param  \App\Http\Requests\UpdateImagesHotelsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImagesHotelsRequest $request, $id)
    {
        if (! Gate::allows('images_hotel_edit')) {
            return abort(401);
        }
        $images_hotel = ImagesHotel::findOrFail($id);
        $images_hotel->update($request->all());



        return redirect()->route('admin.images_hotels.index');
    }


    /**
     * Display ImagesHotel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('images_hotel_view')) {
            return abort(401);
        }
        $images_hotel = ImagesHotel::findOrFail($id);

        return view('admin.images_hotels.show', compact('images_hotel'));
    }


    /**
     * Remove ImagesHotel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('images_hotel_delete')) {
            return abort(401);
        }
        $images_hotel = ImagesHotel::findOrFail($id);
        $images_hotel->delete();

        return redirect()->route('admin.images_hotels.index');
    }

    /**
     * Delete all selected ImagesHotel at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('images_hotel_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ImagesHotel::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
