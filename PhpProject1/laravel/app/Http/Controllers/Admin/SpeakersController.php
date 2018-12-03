<?php

namespace App\Http\Controllers\Admin;

use App\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSpeakersRequest;
use App\Http\Requests\Admin\UpdateSpeakersRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class SpeakersController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Speaker.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('speaker_access')) {
            return abort(401);
        }


                $speakers = Speaker::all();

        return view('admin.speakers.index', compact('speakers'));
    }

    /**
     * Show the form for creating new Speaker.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('speaker_create')) {
            return abort(401);
        }
        return view('admin.speakers.create');
    }

    /**
     * Store a newly created Speaker in storage.
     *
     * @param  \App\Http\Requests\StoreSpeakersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpeakersRequest $request)
    {
        if (! Gate::allows('speaker_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $speaker = Speaker::create($request->all());



        return redirect()->route('admin.speakers.index');
    }


    /**
     * Show the form for editing Speaker.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('speaker_edit')) {
            return abort(401);
        }
        $speaker = Speaker::findOrFail($id);

        return view('admin.speakers.edit', compact('speaker'));
    }

    /**
     * Update Speaker in storage.
     *
     * @param  \App\Http\Requests\UpdateSpeakersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpeakersRequest $request, $id)
    {
        if (! Gate::allows('speaker_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $speaker = Speaker::findOrFail($id);
        $speaker->update($request->all());



        return redirect()->route('admin.speakers.index');
    }


    /**
     * Display Speaker.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('speaker_view')) {
            return abort(401);
        }
        $speakers_congresses = \App\SpeakersCongress::where('id_speaker_id', $id)->get();$registrations = \App\Registration::where('id_speaker_id', $id)->get();

        $speaker = Speaker::findOrFail($id);

        return view('admin.speakers.show', compact('speaker', 'speakers_congresses', 'registrations'));
    }


    /**
     * Remove Speaker from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('speaker_delete')) {
            return abort(401);
        }
        $speaker = Speaker::findOrFail($id);
        $speaker->delete();

        return redirect()->route('admin.speakers.index');
    }

    /**
     * Delete all selected Speaker at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('speaker_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Speaker::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
