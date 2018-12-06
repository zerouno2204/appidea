<?php

namespace App\Http\Controllers\Admin;

use App\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEntriesRequest;
use App\Http\Requests\Admin\UpdateEntriesRequest;
use App\CongressEntry;

class EntriesController extends Controller
{
    /**
     * Display a listing of Entry.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('entry_access')) {
            return abort(401);
        }


                $entries = Entry::all();

        return view('admin.entries.index', compact('entries'));
    }

    /**
     * Show the form for creating new Entry.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('entry_create')) {
            return abort(401);
        }
        
        $congresses = \App\Congress::all();
        
        return view('admin.entries.create', compact('congresses'));
    }

    /**
     * Store a newly created Entry in storage.
     *
     * @param  \App\Http\Requests\StoreEntriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntriesRequest $request)
    {
        if (! Gate::allows('entry_create')) {
            return abort(401);
        }
        $input = $request->input();
        $entry = Entry::create($request->all());
        
        $congress_entry = new CongressEntry();
        $congress_entry->id_entry_id = $entry->id;
        $congress_entry->id_congress_id = $input['congresso'];
        $congress_entry->save();


        return redirect()->route('admin.entries.index');
    }


    /**
     * Show the form for editing Entry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('entry_edit')) {
            return abort(401);
        }
        
        $congresses = \App\Congress::all();
        $congress_entry = CongressEntry::where('id_entry_id', $id)->first();
        $entry = Entry::findOrFail($id);

        return view('admin.entries.edit', compact('entry', 'congresses', 'congress_entry'));
    }

    /**
     * Update Entry in storage.
     *
     * @param  \App\Http\Requests\UpdateEntriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEntriesRequest $request, $id)
    {
        if (! Gate::allows('entry_edit')) {
            return abort(401);
        }
        $entry = Entry::findOrFail($id);
        $entry->update($request->all());



        return redirect()->route('admin.entries.index');
    }


    /**
     * Display Entry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('entry_view')) {
            return abort(401);
        }
        $congress_entries = \App\CongressEntry::where('id_entry_id', $id)->get();$registrations = \App\Registration::where('id_entry_id', $id)->get();

        $entry = Entry::findOrFail($id);

        return view('admin.entries.show', compact('entry', 'congress_entries', 'registrations'));
    }


    /**
     * Remove Entry from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('entry_delete')) {
            return abort(401);
        }
        $entry = Entry::findOrFail($id);
        $entry->delete();

        return redirect()->route('admin.entries.index');
    }

    /**
     * Delete all selected Entry at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('entry_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Entry::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
