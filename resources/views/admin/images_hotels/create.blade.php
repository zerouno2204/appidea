@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.images-hotel.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.images_hotels.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('img_id', trans('global.images-hotel.fields.img').'', ['class' => 'control-label']) !!}
                    {!! Form::select('img_id', $imgs, old('img_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('img_id'))
                        <p class="help-block">
                            {{ $errors->first('img_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('hotel_id', trans('global.images-hotel.fields.hotel').'', ['class' => 'control-label']) !!}
                    {!! Form::select('hotel_id', $hotels, old('hotel_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('hotel_id'))
                        <p class="help-block">
                            {{ $errors->first('hotel_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

