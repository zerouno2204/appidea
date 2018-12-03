@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.rooms.title')</h3>
    
    {!! Form::model($room, ['method' => 'PUT', 'route' => ['admin.rooms.update', $room->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('descrizione', trans('global.rooms.fields.descrizione').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('prezzo', trans('global.rooms.fields.prezzo').'', ['class' => 'control-label']) !!}
                    {!! Form::text('prezzo', old('prezzo'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('prezzo'))
                        <p class="help-block">
                            {{ $errors->first('prezzo') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('p_letto', trans('global.rooms.fields.p-letto').'', ['class' => 'control-label']) !!}
                    {!! Form::number('p_letto', old('p_letto'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('p_letto'))
                        <p class="help-block">
                            {{ $errors->first('p_letto') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id_hotel_id', trans('global.rooms.fields.id-hotel').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_hotel_id', $id_hotels, old('id_hotel_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_hotel_id'))
                        <p class="help-block">
                            {{ $errors->first('id_hotel_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

