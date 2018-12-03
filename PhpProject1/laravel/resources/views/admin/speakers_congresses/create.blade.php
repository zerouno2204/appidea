@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.speakers-congress.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.speakers_congresses.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_congress_id', trans('global.speakers-congress.fields.id-congress').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_congress_id', $id_congresses, old('id_congress_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_congress_id'))
                        <p class="help-block">
                            {{ $errors->first('id_congress_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_speaker_id', trans('global.speakers-congress.fields.id-speaker').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_speaker_id', $id_speakers, old('id_speaker_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_speaker_id'))
                        <p class="help-block">
                            {{ $errors->first('id_speaker_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

