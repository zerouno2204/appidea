@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.congress-entries.title')</h3>
    
    {!! Form::model($congress_entry, ['method' => 'PUT', 'route' => ['admin.congress_entries.update', $congress_entry->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_congress_id', trans('global.congress-entries.fields.id-congress').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('id_entry_id', trans('global.congress-entries.fields.id-entry').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_entry_id', $id_entries, old('id_entry_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_entry_id'))
                        <p class="help-block">
                            {{ $errors->first('id_entry_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

