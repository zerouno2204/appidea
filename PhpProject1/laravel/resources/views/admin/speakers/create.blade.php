@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.speakers.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.speakers.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nome', trans('global.speakers.fields.nome').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('cognome', trans('global.speakers.fields.cognome').'', ['class' => 'control-label']) !!}
                    {!! Form::text('cognome', old('cognome'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cognome'))
                        <p class="help-block">
                            {{ $errors->first('cognome') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('img_path', trans('global.speakers.fields.img-path').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('img_path', old('img_path')) !!}
                    {!! Form::file('img_path', ['class' => 'form-control']) !!}
                    {!! Form::hidden('img_path_max_size', 20) !!}
                    <p class="help-block"></p>
                    @if($errors->has('img_path'))
                        <p class="help-block">
                            {{ $errors->first('img_path') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('contatti', trans('global.speakers.fields.contatti').'', ['class' => 'control-label']) !!}
                    {!! Form::text('contatti', old('contatti'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contatti'))
                        <p class="help-block">
                            {{ $errors->first('contatti') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ruolo', trans('global.speakers.fields.ruolo').'', ['class' => 'control-label']) !!}
                    {!! Form::text('ruolo', old('ruolo'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ruolo'))
                        <p class="help-block">
                            {{ $errors->first('ruolo') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('descrizione', trans('global.speakers.fields.descrizione').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('descrizione', old('descrizione'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
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
                    {!! Form::label('curriculuum', trans('global.speakers.fields.curriculuum').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('curriculuum', old('curriculuum')) !!}
                    {!! Form::file('curriculuum', ['class' => 'form-control']) !!}
                    {!! Form::hidden('curriculuum_max_size', 5) !!}
                    <p class="help-block"></p>
                    @if($errors->has('curriculuum'))
                        <p class="help-block">
                            {{ $errors->first('curriculuum') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

@stop