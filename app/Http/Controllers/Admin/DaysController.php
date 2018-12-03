<?php

namespace App\Http\Controllers\Admin;

use App\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDaysRequest;
use App\Http\Requests\Admin\UpdateDaysRequest;

class DaysController extends Controller
{
    /**
     * Display a listing of Day.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('day_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('day_delete')) {
                return abort(401);
            }
            $days = Day::onlyTrashed()->get();
        } else {
            $days = Day::all();
        }

        return view('admin.days.index', compact('days'));
    }

    /**
     * Show the form for creating new Day.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('day_create')) {
            return abort(401);
        }
        
        $id_congressos = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.days.create', compact('id_congressos'));
    }

    /**
     * Store a newly created Day in storage.
     *
     * @param  \App\Http\Requests\StoreDaysRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDaysRequest $request)
    {
        if (! Gate::allows('day_create')) {
            return abort(401);
        }
        $day = Day::create($request->all());



        return redirect()->route('admin.days.index');
    }


    /**
     * Show the form for editing Day.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('day_edit')) {
            return abort(401);
        }
        
        $id_congressos = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        $day = Day::findOrFail($id);

        return view('admin.days.edit', compact('day', 'id_congressos'));
    }

    /**
     * Update Day in storage.
     *
     * @param  \App\Http\Requests\UpdateDaysRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDaysRequest $request, $id)
    {
        if (! Gate::allows('day_edit')) {
            return abort(401);
        }
        $day = Day::findOrFail($id);
        $day->update($request->all());



        return redirect()->route('admin.days.index');
    }


    /**
     * Display Day.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('day_view')) {
            return abort(401);
        }
        
        $id_congressos = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');$halls = \App\Hall::where('id_giorno_id', $id)->get();

        $day = Day::findOrFail($id);

        return view('admin.days.show', compact('day', 'halls'));
    }


    /**
     * Remove Day from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('day_delete')) {
            return abort(401);
        }
        $day = Day::findOrFail($id);
        $day->delete();

        return redirect()->route('admin.days.index');
    }

    /**
     * Delete all selected Day at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('day_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Day::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Day from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('day_delete')) {
            return abort(401);
        }
        $day = Day::onlyTrashed()->findOrFail($id);
        $day->restore();

        return redirect()->route('admin.days.index');
    }

    /**
     * Permanently delete Day from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('day_delete')) {
            return abort(401);
        }
        $day = Day::onlyTrashed()->findOrFail($id);
        $day->forceDelete();

        return redirect()->route('admin.days.index');
    }
}
