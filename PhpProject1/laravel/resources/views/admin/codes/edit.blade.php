@extends('layouts.app')

@section('content')
<div class="mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.codes.title') @lang('global.app_edit')</h2>
    </div>

    {!! Form::model($code, ['method' => 'PUT', 'route' => ['admin.codes.update', $code->id]]) !!}

    <div class="mdl-card__supporting-text">
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('code', trans('global.codes.fields.code').'', ['class' => 'control-label']) !!}
                {!! Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('code'))
                <p class="help-block">
                    {{ $errors->first('code') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('qrcode', trans('global.codes.fields.qrcode').'', ['class' => 'control-label']) !!}
                {!! Form::text('qrcode', old('qrcode'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('qrcode'))
                <p class="help-block">
                    {{ $errors->first('qrcode') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('id_congress_id', trans('global.codes.fields.id-congress').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('sponsor', trans('global.codes.fields.sponsor').'', ['class' => 'control-label']) !!}
                    {!! Form::text('sponsor', old('sponsor'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('sponsor'))
                    <p class="help-block">
                        {{ $errors->first('sponsor') }}
                    </p>
                    @endif
                </div>
            </div>
    </div>
</div>
{!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
@stop

