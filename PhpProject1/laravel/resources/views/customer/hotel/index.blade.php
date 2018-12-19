@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')


<div class="mdl-card" style="width: 100%;">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.hotels.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">

        <div class="hidden-xs">
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
                            <a href="{{ url('admin/congress-hotels-show/'. $hotel->id) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
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
        <div class="visible-xs">
            <ul style="list-style: none; padding: 0 15px;">            
                @foreach ($hotels as $hotel)
                <li>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th >@lang('global.hotels.fields.nome')</th>
                            <td field-key='nome'>{{ $hotel->nome }}</td>
                        </tr>
                        <tr>
                            <th >@lang('global.hotels.fields.indirizzo')</th>
                            <td field-key='indirizzo'>{{ $hotel->indirizzo }}</td>
                        </tr>
                        <tr>
                            <th >@lang('global.hotels.fields.citta')</th>
                            <td field-key='citta'>{{ $hotel->citta->name ?? '' }}</td>

                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <a href="{{ url('admin/congress-hotels-show/'. $hotel->id) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                            </td>
                        </tr>
                    </table>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@stop

