<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreImagesRequest;
use App\Http\Requests\Admin\UpdateImagesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class ImagesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Image.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('image_access')) {
            return abort(401);
        }


                $images = Image::all();

        return view('admin.images.index', compact('images'));
    }

    /**
     * Show the form for creating new Image.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('image_create')) {
            return abort(401);
        }
        return view('admin.images.create');
    }

    /**
     * Store a newly created Image in storage.
     *
     * @param  \App\Http\Requests\StoreImagesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImagesRequest $request)
    {
        if (! Gate::allows('image_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $image = Image::create($request->all());


        foreach ($request->input('path_id', []) as $index => $id) {
            $model          = config('medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $image->id;
            $file->save();
        }


        return redirect()->route('admin.images.index');
    }


    /**
     * Show the form for editing Image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('image_edit')) {
            return abort(401);
        }
        $image = Image::findOrFail($id);

        return view('admin.images.edit', compact('image'));
    }

    /**
     * Update Image in storage.
     *
     * @param  \App\Http\Requests\UpdateImagesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImagesRequest $request, $id)
    {
        if (! Gate::allows('image_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $image = Image::findOrFail($id);
        $image->update($request->all());


        $media = [];
        foreach ($request->input('path_id', []) as $index => $id) {
            $model          = config('medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $image->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $image->updateMedia($media, 'path');


        return redirect()->route('admin.images.index');
    }


    /**
     * Display Image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('image_view')) {
            return abort(401);
        }
        $images_hotels = \App\ImagesHotel::where('img_id', $id)->get();

        $image = Image::findOrFail($id);

        return view('admin.images.show', compact('image', 'images_hotels'));
    }


    /**
     * Remove Image from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('image_delete')) {
            return abort(401);
        }
        $image = Image::findOrFail($id);
        $image->deletePreservingMedia();

        return redirect()->route('admin.images.index');
    }

    /**
     * Delete all selected Image at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('image_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Image::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }

}
