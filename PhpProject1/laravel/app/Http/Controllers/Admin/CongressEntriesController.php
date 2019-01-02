<?php

namespace App\Http\Controllers\Admin;

use App\CongressEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCongressEntriesRequest;
use App\Http\Requests\Admin\UpdateCongressEntriesRequest;

class CongressEntriesController extends Controller
{
    /**
     * Display a listing of CongressEntry.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('congress_entry_access')) {
            return abort(401);
        }


                $congress_entries = CongressEntry::all();

        return view('admin.congress_entries.index', compact('congress_entries'));
    }

    /**
     * Show the form for creating new CongressEntry.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('congress_entry_create')) {
            return abort(401);
        }
        
        $id_congresses = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_entries = \App\Entry::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.congress_entries.create', compact('id_congresses', 'id_entries'));
    }

    /**
     * Store a newly created CongressEntry in storage.
     *
     * @param  \App\Http\Requests\StoreCongressEntriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCongressEntriesRequest $request)
    {
        if (! Gate::allows('congress_entry_create')) {
            return abort(401);
        }
        $congress_entry = CongressEntry::create($request->all());



        return redirect()->route('admin.congress_entries.index');
    }


    /**
     * Show the form for editing CongressEntry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('congress_entry_edit')) {
            return abort(401);
        }
        
        $id_congresses = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_entries = \App\Entry::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        $congress_entry = CongressEntry::findOrFail($id);

        return view('admin.congress_entries.edit', compact('congress_entry', 'id_congresses', 'id_entries'));
    }

    /**
     * Update CongressEntry in storage.
     *
     * @param  \App\Http\Requests\UpdateCongressEntriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCongressEntriesRequest $request, $id)
    {
        if (! Gate::allows('congress_entry_edit')) {
            return abort(401);
        }
        $congress_entry = CongressEntry::findOrFail($id);
        $congress_entry->update($request->all());



        return redirect()->route('admin.congress_entries.index');
    }


    /**
     * Display CongressEntry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('congress_entry_view')) {
            return abort(401);
        }
        $congress_entry = CongressEntry::findOrFail($id);

        return view('admin.congress_entries.show', compact('congress_entry'));
    }


    /**
     * Remove CongressEntry from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('congress_entry_delete')) {
            return abort(401);
        }
        $congress_entry = CongressEntry::findOrFail($id);
        $congress_entry->delete();

        return redirect()->route('admin.congress_entries.index');
    }

    /**
     * Delete all selected CongressEntry at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('congress_entry_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CongressEntry::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
