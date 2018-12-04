@extends('layouts.app')

@section('content')
<div class="mdl-card">
  <div class="mdl-card__title mdl-card--border">
  <h2 class="mdl-card__title-text">@lang('global.cities.title') @lang('global.app_create')</h2>
  </div>
  
  <div class="mdl-card__supporting-text"> 
    
    {!! Form::open(['method' => 'POST', 'route' => ['admin.cities.store']]) !!}
                    
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.cities.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('province_id', trans('global.cities.fields.province').'', ['class' => 'control-label']) !!}
                    {!! Form::select('province_id', $provinces, old('province_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('province_id'))
                        <p class="help-block">
                            {{ $errors->first('province_id') }}
                        </p>
                    @endif
                </div>
            </div>
 
    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
     </div>
  
</div>
@stop

