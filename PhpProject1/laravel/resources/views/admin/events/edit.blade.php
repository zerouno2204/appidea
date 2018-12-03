@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.event.title')</h3>
    
    {!! Form::model($event, ['method' => 'PUT', 'route' => ['admin.events.update', $event->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('intervallo_orario', trans('global.event.fields.intervallo-orario').'', ['class' => 'control-label']) !!}
                    {!! Form::text('intervallo_orario', old('intervallo_orario'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('intervallo_orario'))
                        <p class="help-block">
                            {{ $errors->first('intervallo_orario') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nome', trans('global.event.fields.nome').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('descrizione', trans('global.event.fields.descrizione').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('id_sala_id', trans('global.event.fields.id-sala').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_sala_id', $id_salas, old('id_sala_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_sala_id'))
                        <p class="help-block">
                            {{ $errors->first('id_sala_id') }}
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