<?php

namespace App\Http\Controllers\Admin;

use App\SpeakersCongress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSpeakersCongressesRequest;
use App\Http\Requests\Admin\UpdateSpeakersCongressesRequest;
use App\Speaker;

class SpeakersCongressesController extends Controller {

    /**
     * Display a listing of SpeakersCongress.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!Gate::allows('speakers_congress_access')) {
            return abort(401);
        }


        $speakers_congresses = SpeakersCongress::all();

        return view('admin.speakers_congresses.index', compact('speakers_congresses'));
    }

    public function speakersCongress($id) {
        
        $congress = \App\Congress::find($id);
        $speakers = Speaker::whereIn('id', function($q) use ($id) {
                    $q->select('id_speaker_id')
                            ->from('speakers_congresses')
                            ->where('id_congress_id', $id);
                })->get();

        return view('customer.speakers.index', compact('speakers','congress'));
    }
    
    public function showSpeakersCongress($id) {
        
        $speaker = Speaker::find($id);
        $congress = \App\Congress::whereIn('id', function($q) use ($id) {
                    $q->select('id_congress_id')
                            ->from('speakers_congresses')
                            ->where('id_speaker_id', $id);
                })->first();
        
        return view('customer.speakers.show', compact('speaker', 'congress'));
    }

    /**
     * Show the form for creating new SpeakersCongress.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (!Gate::allows('speakers_congress_create')) {
            return abort(401);
        }

        $id_congresses = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_speakers = \App\Speaker::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.speakers_congresses.create', compact('id_congresses', 'id_speakers'));
    }

    /**
     * Store a newly created SpeakersCongress in storage.
     *
     * @param  \App\Http\Requests\StoreSpeakersCongressesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpeakersCongressesRequest $request) {
        if (!Gate::allows('speakers_congress_create')) {
            return abort(401);
        }
        $speakers_congress = SpeakersCongress::create($request->all());



        return redirect()->route('admin.speakers_congresses.index');
    }

    /**
     * Show the form for editing SpeakersCongress.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (!Gate::allows('speakers_congress_edit')) {
            return abort(401);
        }

        $id_congresses = \App\Congress::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');
        $id_speakers = \App\Speaker::get()->pluck('nome', 'id')->prepend(trans('global.app_please_select'), '');

        $speakers_congress = SpeakersCongress::findOrFail($id);

        return view('admin.speakers_congresses.edit', compact('speakers_congress', 'id_congresses', 'id_speakers'));
    }

    /**
     * Update SpeakersCongress in storage.
     *
     * @param  \App\Http\Requests\UpdateSpeakersCongressesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpeakersCongressesRequest $request, $id) {
        if (!Gate::allows('speakers_congress_edit')) {
            return abort(401);
        }
        $speakers_congress = SpeakersCongress::findOrFail($id);
        $speakers_congress->update($request->all());



        return redirect()->route('admin.speakers_congresses.index');
    }

    /**
     * Display SpeakersCongress.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if (!Gate::allows('speakers_congress_view')) {
            return abort(401);
        }
        $speakers_congress = SpeakersCongress::findOrFail($id);

        return view('admin.speakers_congresses.show', compact('speakers_congress'));
    }

    /**
     * Remove SpeakersCongress from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if (!Gate::allows('speakers_congress_delete')) {
            return abort(401);
        }
        $speakers_congress = SpeakersCongress::findOrFail($id);
        $speakers_congress->delete();

        return redirect()->route('admin.speakers_congresses.index');
    }

    /**
     * Delete all selected SpeakersCongress at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request) {
        if (!Gate::allows('speakers_congress_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = SpeakersCongress::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
