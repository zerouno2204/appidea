<?php

namespace App\Http\Controllers\Admin;

use App\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCodesRequest;
use App\Http\Requests\Admin\UpdateCodesRequest;

class CodesController extends Controller
{
    /**
     * Display a listing of Code.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('code_access')) {
            return abort(401);
        }


                $codes = Code::with('id_congress','sponsor')->get();
                //dd($codes);

        return view('admin.codes.index', compact('codes'));
    }

    /**
     * Show the form for creating new Code.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('code_create')) {
            return abort(401);
        }
        
        $id_congresses = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_users = \App\User::where('role_id', 6)->get();

        return view('admin.codes.create', compact('id_congresses', 'id_users'));
    }

    /**
     * Store a newly created Code in storage.
     *
     * @param  \App\Http\Requests\StoreCodesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCodesRequest $request)
    {
        if (! Gate::allows('code_create')) {
            return abort(401);
        }
        $code = Code::create($request->all());



        return redirect()->route('admin.codes.index');
    }


    /**
     * Show the form for editing Code.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('code_edit')) {
            return abort(401);
        }
        
        $id_congresses = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_users = \App\User::where('role_id', 6)->get();

        $code = Code::findOrFail($id);

        return view('admin.codes.edit', compact('code', 'id_congresses', 'id_users'));
    }

    /**
     * Update Code in storage.
     *
     * @param  \App\Http\Requests\UpdateCodesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCodesRequest $request, $id)
    {
        if (! Gate::allows('code_edit')) {
            return abort(401);
        }
        $code = Code::findOrFail($id);
        $code->update($request->all());



        return redirect()->route('admin.codes.index');
    }


    /**
     * Display Code.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('code_view')) {
            return abort(401);
        }
        $code = Code::findOrFail($id);

        return view('admin.codes.show', compact('code'));
    }


    /**
     * Remove Code from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('code_delete')) {
            return abort(401);
        }
        $code = Code::findOrFail($id);
        $code->delete();

        return redirect()->route('admin.codes.index');
    }

    /**
     * Delete all selected Code at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('code_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Code::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
