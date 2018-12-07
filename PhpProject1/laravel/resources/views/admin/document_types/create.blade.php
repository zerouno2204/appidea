@extends('layouts.app')

@section('content')

<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.document-type.title') @lang('global.app_create')</h2>
    </div>
    <div class="mdl-card__supporting-text">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.document_types.store']]) !!}

        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('nome', trans('global.document-type.fields.nome').'', ['class' => 'control-label']) !!}
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
                {!! Form::label('slug', trans('global.document-type.fields.slug').'', ['class' => 'control-label']) !!}
                {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('slug'))
                <p class="help-block">
                    {{ $errors->first('slug') }}
                </p>
                @endif
            </div>
        </div>

        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
    <div class="mdl-card__actions">
        ...
    </div>
</div>
@stop

