<?php

namespace App\Http\Controllers\Admin;

use App\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDocumentTypesRequest;
use App\Http\Requests\Admin\UpdateDocumentTypesRequest;

class DocumentTypesController extends Controller
{
    /**
     * Display a listing of DocumentType.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('document_type_access')) {
            return abort(401);
        }


                $document_types = DocumentType::all();

        return view('admin.document_types.index', compact('document_types'));
    }

    /**
     * Show the form for creating new DocumentType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('document_type_create')) {
            return abort(401);
        }
        return view('admin.document_types.create');
    }

    /**
     * Store a newly created DocumentType in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentTypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentTypesRequest $request)
    {
        if (! Gate::allows('document_type_create')) {
            return abort(401);
        }
        $document_type = DocumentType::create($request->all());



        return redirect()->route('admin.document_types.index');
    }


    /**
     * Show the form for editing DocumentType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('document_type_edit')) {
            return abort(401);
        }
        $document_type = DocumentType::findOrFail($id);

        return view('admin.document_types.edit', compact('document_type'));
    }

    /**
     * Update DocumentType in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentTypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentTypesRequest $request, $id)
    {
        if (! Gate::allows('document_type_edit')) {
            return abort(401);
        }
        $document_type = DocumentType::findOrFail($id);
        $document_type->update($request->all());



        return redirect()->route('admin.document_types.index');
    }


    /**
     * Display DocumentType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('document_type_view')) {
            return abort(401);
        }
        $document_type = DocumentType::findOrFail($id);

        return view('admin.document_types.show', compact('document_type'));
    }


    /**
     * Remove DocumentType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('document_type_delete')) {
            return abort(401);
        }
        $document_type = DocumentType::findOrFail($id);
        $document_type->delete();

        return redirect()->route('admin.document_types.index');
    }

    /**
     * Delete all selected DocumentType at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('document_type_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DocumentType::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
