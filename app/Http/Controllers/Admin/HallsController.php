<?php

namespace App\Http\Controllers\Admin;

use App\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHallsRequest;
use App\Http\Requests\Admin\UpdateHallsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class HallsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Hall.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('hall_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('hall_delete')) {
                return abort(401);
            }
            $halls = Hall::onlyTrashed()->get();
        } else {
            $halls = Hall::all();
        }

        return view('admin.halls.index', compact('halls'));
    }

    /**
     * Show the form for creating new Hall.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('hall_create')) {
            return abort(401);
        }
        
        $id_giornos = \App\Day::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.halls.create', compact('id_giornos'));
    }

    /**
     * Store a newly created Hall in storage.
     *
     * @param  \App\Http\Requests\StoreHallsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHallsRequest $request)
    {
        if (! Gate::allows('hall_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $hall = Hall::create($request->all());


        foreach ($request->input('planimetria_id', []) as $index => $id) {
            $model          = config('medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $hall->id;
            $file->save();
        }


        return redirect()->route('admin.halls.index');
    }


    /**
     * Show the form for editing Hall.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('hall_edit')) {
            return abort(401);
        }
        
        $id_giornos = \App\Day::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        $hall = Hall::findOrFail($id);

        return view('admin.halls.edit', compact('hall', 'id_giornos'));
    }

    /**
     * Update Hall in storage.
     *
     * @param  \App\Http\Requests\UpdateHallsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHallsRequest $request, $id)
    {
        if (! Gate::allows('hall_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $hall = Hall::findOrFail($id);
        $hall->update($request->all());


        $media = [];
        foreach ($request->input('planimetria_id', []) as $index => $id) {
            $model          = config('medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $hall->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $hall->updateMedia($media, 'planimetria');


        return redirect()->route('admin.halls.index');
    }


    /**
     * Display Hall.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('hall_view')) {
            return abort(401);
        }
        
        $id_giornos = \App\Day::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');$events = \App\Event::where('id_sala_id', $id)->get();

        $hall = Hall::findOrFail($id);

        return view('admin.halls.show', compact('hall', 'events'));
    }


    /**
     * Remove Hall from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('hall_delete')) {
            return abort(401);
        }
        $hall = Hall::findOrFail($id);
        $hall->deletePreservingMedia();

        return redirect()->route('admin.halls.index');
    }

    /**
     * Delete all selected Hall at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('hall_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Hall::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Hall from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('hall_delete')) {
            return abort(401);
        }
        $hall = Hall::onlyTrashed()->findOrFail($id);
        $hall->restore();

        return redirect()->route('admin.halls.index');
    }

    /**
     * Permanently delete Hall from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('hall_delete')) {
            return abort(401);
        }
        $hall = Hall::onlyTrashed()->findOrFail($id);
        $hall->forceDelete();

        return redirect()->route('admin.halls.index');
    }
}
