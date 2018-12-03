@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.registrations.title')</h3>
    
    {!! Form::model($registration, ['method' => 'PUT', 'route' => ['admin.registrations.update', $registration->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nome_documento', trans('global.registrations.fields.nome-documento').'', ['class' => 'control-label']) !!}
                    {!! Form::text('nome_documento', old('nome_documento'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nome_documento'))
                        <p class="help-block">
                            {{ $errors->first('nome_documento') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('luogo_rilascio', trans('global.registrations.fields.luogo-rilascio').'', ['class' => 'control-label']) !!}
                    {!! Form::text('luogo_rilascio', old('luogo_rilascio'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('luogo_rilascio'))
                        <p class="help-block">
                            {{ $errors->first('luogo_rilascio') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('data_emissione', trans('global.registrations.fields.data-emissione').'', ['class' => 'control-label']) !!}
                    {!! Form::text('data_emissione', old('data_emissione'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('data_emissione'))
                        <p class="help-block">
                            {{ $errors->first('data_emissione') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('data_scadenza', trans('global.registrations.fields.data-scadenza').'', ['class' => 'control-label']) !!}
                    {!! Form::text('data_scadenza', old('data_scadenza'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('data_scadenza'))
                        <p class="help-block">
                            {{ $errors->first('data_scadenza') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_tipo_doc', trans('global.registrations.fields.id-tipo-doc').'', ['class' => 'control-label']) !!}
                    {!! Form::number('id_tipo_doc', old('id_tipo_doc'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_tipo_doc'))
                        <p class="help-block">
                            {{ $errors->first('id_tipo_doc') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('path_img_doc', trans('global.registrations.fields.path-img-doc').'', ['class' => 'control-label']) !!}
                    {!! Form::text('path_img_doc', old('path_img_doc'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('path_img_doc'))
                        <p class="help-block">
                            {{ $errors->first('path_img_doc') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('note', trans('global.registrations.fields.note').'', ['class' => 'control-label']) !!}
                    {!! Form::text('note', old('note'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('note'))
                        <p class="help-block">
                            {{ $errors->first('note') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('registrationscol', trans('global.registrations.fields.registrationscol').'', ['class' => 'control-label']) !!}
                    {!! Form::text('registrationscol', old('registrationscol'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('registrationscol'))
                        <p class="help-block">
                            {{ $errors->first('registrationscol') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_entry_id', trans('global.registrations.fields.id-entry').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_entry_id', $id_entries, old('id_entry_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_entry_id'))
                        <p class="help-block">
                            {{ $errors->first('id_entry_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_congress_id', trans('global.registrations.fields.id-congress').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('id_speaker_id', trans('global.registrations.fields.id-speaker').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_speaker_id', $id_speakers, old('id_speaker_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_speaker_id'))
                        <p class="help-block">
                            {{ $errors->first('id_speaker_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_hotel_id', trans('global.registrations.fields.id-hotel').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_hotel_id', $id_hotels, old('id_hotel_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_hotel_id'))
                        <p class="help-block">
                            {{ $errors->first('id_hotel_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_user_id', trans('global.registrations.fields.id-user').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_user_id', $id_users, old('id_user_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_user_id'))
                        <p class="help-block">
                            {{ $errors->first('id_user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_camera_id', trans('global.registrations.fields.id-camera').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_camera_id', $id_cameras, old('id_camera_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_camera_id'))
                        <p class="help-block">
                            {{ $errors->first('id_camera_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop