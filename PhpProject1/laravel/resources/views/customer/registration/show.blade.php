@extends('layouts.app')

@section('content')
<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">{{ $registration->id_congress->nome }}</h2>
        <h3 class="mdl-card__subtitle-text">Registrazione</h3>
    </div>
    <div class="mdl-card__supporting-text">        
        <table class="table table-bordered table-striped">
            <tr>
                <th>Congresso</th>
                <th>Hotel</th>
                <th>Camera</th>
                <th>Iscrizione</th>
            </tr>
            <tr>
                <td >{{ $registration->id_congress->nome }}</td>
                <td >{{ $registration->id_hotel->nome }}</td>            
                <td >{{ $registration->id_camera->descrizione }} - {{ $registration->id_camera->prezzo }}€</td>   
                <td >{{ $registration->id_entry->nome }}</td>
            </tr>

        </table>
        {!! $registration->note !!}
        <div class="img-row">
            <div class="column">
                @foreach($images as $image)
                <img src="{{ asset('image/'. $image->nome) }}">
                @endforeach
            </div>
        </div>
    </div>
    <div class="mdl-card__actions">
        <a href="{{ url('/admin/customer-registration-index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
    </div>
</div>
@endsection
