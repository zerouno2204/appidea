@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

<div class="mdl-card" style="width: 100%;">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.congress.title')</h2>
    </div>   
    <div class="mdl-card__supporting-text">
        @if(Auth::user()->role_id == 6)
        <h3>Totale degli iscritti a congressi {{$iscrizioni}}</h3>
        @endif        
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"
               style="width: 80%; margin-left: 0;">
            <thead>
                <tr>
                    
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.congress.fields.nome')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.congress.fields.data-inizio')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.congress.fields.data-fine')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.congress.fields.ind-sede')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.congress.fields.id-citta-sede')</th>
                    <th class="mdl-data-table__cell--non-numeric"></th>

                </tr>
            </thead>

            <tbody>
                @if (count($congresses) > 0)
                @foreach ($congresses as $congress)
                <tr data-entry-id="{{ $congress->id }}">
                    
                    <td field-key='nome'>{{ $congress->nome }}</td>
                    <td field-key='data_inizio'>{{ $congress->data_inizio }}</td>
                    <td field-key='data_fine'>{{ $congress->data_fine }}</td>
                    <td field-key='ind_sede'>{{ $congress->ind_sede }}</td>
                    <td field-key='id_citta_sede'>{{ $congress->id_citta_sede->name ?? '' }}</td>
                    <td>
                        <a href="{{ url('/customer/congress/'.$congress->id) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="17">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>


    </div>
</div>
@stop
