@extends('layouts.app')

@section('content')
@if($congress->isNotEmpty())
@foreach($congress as $item)
<div class="mdl-cell mdl-cell--4-col">
    <div class="mdl-card">
        <div class="mdl-card__title">
            {{$item->nome}}
        </div>
        <div class="mdl-card__media">
            <img src="{{$item->img}}" >
        </div>
        <div class="mdl-card__supporting-text">
            {{$item->descrizione}}
        </div>
        <div class="mdl-card__actions">
            <a href="{{route('admin.congress.show',[$item->id])}}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" >Vedi</a>
        </div>
    </div>
</div>
@endforeach
@else
<div class="demo-card-wide mdl-card">
    <div class="mdl-card__title">
        @lang('global.app_dashboard')
    </div>
    <div class="mdl-card__supporting-text">
        Not found any Events
    </div>
</div>
@endif
@endsection
