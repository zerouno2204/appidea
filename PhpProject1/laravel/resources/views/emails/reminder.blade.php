
@extends('emails.head')

@section('content')


<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.registrations.title')</h2>
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
                <td field-key='nome_documento'>{{ $registration->id_congress->nome }}</td>
                <td field-key='luogo_rilascio'>{{ $registration->id_hotel->nome }}</td>            
                <td field-key='data_emissione'>{{ $registration->id_camera->descrizione }} - {{ $registration->id_camera->prezzo }}€</td>   
                <td field-key='data_scadenza'>{{ $registration->id_entry->nome }}</td>
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
   
</div>
@stop

@section('javascript')

