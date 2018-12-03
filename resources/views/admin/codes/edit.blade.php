@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.codes.title')</h3>
    
    {!! Form::model($code, ['method' => 'PUT', 'route' => ['admin.codes.update', $code->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
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
                    {!! Form::label('id_user_id', trans('global.codes.fields.id-user').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_user_id', $id_users, old('id_user_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_user_id'))
                        <p class="help-block">
                            {{ $errors->first('id_user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

