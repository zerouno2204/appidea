@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')


<div class="mdl-card" style="width: 100%;">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.hotels.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">


        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"
               style="width: 80%; margin-left: 0;">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.hotels.fields.nome')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.hotels.fields.indirizzo')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.hotels.fields.citta')</th>
                    <th class="mdl-data-table__cell--non-numeric"></th>

                </tr>
            </thead>

            <tbody>
                @if (count($hotels) > 0)
                @foreach ($hotels as $hotel)
                <tr data-entry-id="{{ $hotel->id }}">

                    <td field-key='nome'>{{ $hotel->nome }}</td>
                    <td field-key='indirizzo'>{{ $hotel->indirizzo }}</td>
                    <td field-key='citta'>{{ $hotel->citta->name ?? '' }}</td>
                    <td>
                        @can('hotel_view')
                        <a href="{{ url('admin/congress-hotels-show/'. $hotel->id) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                        @endcan                        
                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="13">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>


    </div>
</div>

@stop

