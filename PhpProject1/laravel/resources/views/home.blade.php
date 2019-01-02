@extends('layouts.app')

@section('content')
@if(isset($congressi))
@foreach($congressi as $item)
<div class="mdl-cell mdl-cell--4-col">
    <div class="mdl-card">
        <div class="mdl-card__title" style="max-width: 94%;">
            {{$item->nome}}
        </div>
        <div class="mdl-card__media">
            <img src="{{ asset($item->img)}}" >
        </div>
        <div class="mdl-card__supporting-text">
            {!! $item->descrizione !!}
        </div>
        <div class="mdl-card__actions">
            <a href="{{url('/customer/congress/'.$item->id)}}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" >Vedi</a>
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
