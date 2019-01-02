@extends('layouts.app')

@section('content')
<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">Registrazione Valida</h2> 
    </div>
    <div class="mdl-card__supporting-text">        
        <p>
            Utente Regirstato:
        <ul>
            <li>{{$user->nome}}</li>
            <li>{{$user->email}}</li>            
        </ul>
        </p>
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
    </div>
    <div class="mdl-card__actions">
        <a href="{{ url('/admin/customer-registration-index') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">@lang('global.app_back_to_list')</a>
    </div>
</div>
@endsection
