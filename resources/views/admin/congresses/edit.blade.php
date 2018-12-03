@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.congress.title')</h3>
    
    {!! Form::model($congress, ['method' => 'PUT', 'route' => ['admin.congresses.update', $congress->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nome', trans('global.congress.fields.nome').'', ['class' => 'control-label']) !!}
                    {!! Form::text('nome', old('nome'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nome'))
                        <p class="help-block">
                            {{ $errors->first('nome') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('descrizione', trans('global.congress.fields.descrizione').'', ['class' => 'control-label']) !!}
                    {!! Form::text('descrizione', old('descrizione'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('descrizione'))
                        <p class="help-block">
                            {{ $errors->first('descrizione') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('data_inizio', trans('global.congress.fields.data-inizio').'', ['class' => 'control-label']) !!}
                    {!! Form::text('data_inizio', old('data_inizio'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('data_inizio'))
                        <p class="help-block">
                            {{ $errors->first('data_inizio') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('data_fine', trans('global.congress.fields.data-fine').'', ['class' => 'control-label']) !!}
                    {!! Form::text('data_fine', old('data_fine'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('data_fine'))
                        <p class="help-block">
                            {{ $errors->first('data_fine') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('img', trans('global.congress.fields.img').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('img', old('img')) !!}
                    @if ($congress->img)
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $congress->img) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('img', ['class' => 'form-control']) !!}
                    {!! Form::hidden('img_max_size', 20) !!}
                    <p class="help-block"></p>
                    @if($errors->has('img'))
                        <p class="help-block">
                            {{ $errors->first('img') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('descr_sede', trans('global.congress.fields.descr-sede').'', ['class' => 'control-label']) !!}
                    {!! Form::text('descr_sede', old('descr_sede'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('descr_sede'))
                        <p class="help-block">
                            {{ $errors->first('descr_sede') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ind_sede', trans('global.congress.fields.ind-sede').'', ['class' => 'control-label']) !!}
                    {!! Form::text('ind_sede', old('ind_sede'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ind_sede'))
                        <p class="help-block">
                            {{ $errors->first('ind_sede') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('lat', trans('global.congress.fields.lat').'', ['class' => 'control-label']) !!}
                    {!! Form::text('lat', old('lat'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('lat'))
                        <p class="help-block">
                            {{ $errors->first('lat') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('lng', trans('global.congress.fields.lng').'', ['class' => 'control-label']) !!}
                    {!! Form::text('lng', old('lng'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('lng'))
                        <p class="help-block">
                            {{ $errors->first('lng') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cap_sede', trans('global.congress.fields.cap-sede').'', ['class' => 'control-label']) !!}
                    {!! Form::text('cap_sede', old('cap_sede'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cap_sede'))
                        <p class="help-block">
                            {{ $errors->first('cap_sede') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_citta_sede_id', trans('global.congress.fields.id-citta-sede').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_citta_sede_id', $id_citta_sedes, old('id_citta_sede_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_citta_sede_id'))
                        <p class="help-block">
                            {{ $errors->first('id_citta_sede_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_prov_sede_id', trans('global.congress.fields.id-prov-sede').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_prov_sede_id', $id_prov_sedes, old('id_prov_sede_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_prov_sede_id'))
                        <p class="help-block">
                            {{ $errors->first('id_prov_sede_id') }}
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