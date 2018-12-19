@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.registrations.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">
        <div class="hidden-xs">
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                <thead>
                    <tr>
                        @can('registration_delete')
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th class="mdl-data-table__cell--non-numeric">@lang('global.registrations.fields.nome-documento')</th>
                        <th class="mdl-data-table__cell--non-numeric">@lang('global.registrations.fields.luogo-rilascio')</th>
                        <th class="mdl-data-table__cell--non-numeric">@lang('global.registrations.fields.data-emissione')</th>
                        <th class="mdl-data-table__cell--non-numeric">@lang('global.registrations.fields.data-scadenza')</th>
                        <th class="mdl-data-table__cell--non-numeric">&nbsp;</th>

                    </tr>
                </thead>

                <tbody>
                    @if (count($registrations) > 0)
                    @foreach ($registrations as $registration)
                    <tr data-entry-id="{{ $registration->id }}">
                        @can('registration_delete')
                        <td></td>
                        @endcan

                        <td field-key='nome_documento'>{{ $registration->nome_documento }}</td>
                        <td field-key='luogo_rilascio'>{{ $registration->luogo_rilascio }}</td>
                        <td field-key='data_emissione'>{{ $registration->data_emissione }}</td>
                        <td field-key='data_scadenza'>{{ $registration->data_scadenza }}</td>
                        <td>
                            <a href="{{ url('/admin/customer-registration-show/'.$registration->id) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>       
                        </td>

                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="19">@lang('global.app_no_entries_in_table')</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="visible-xs">
            <ul style="list-style: none; padding: 0 15px;">
                @if (count($registrations) > 0)
                @foreach ($registrations as $registration)
                <li>
                    <table class="table table-bordered table-striped">                       
                        <tr>
                            <th>@lang('global.registrations.fields.nome-documento')</th>
                            <td field-key='nome_documento'>{{ $registration->nome_documento }}</td>
                        </tr>                         
                        <tr>
                            <th>@lang('global.registrations.fields.luogo-rilascio')</th>
                            <td field-key='luogo_rilascio'>{{ $registration->luogo_rilascio }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.registrations.fields.data-emissione')</th>
                            <td field-key='data_emissione'>{{ $registration->data_emissione }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.registrations.fields.data-scadenza')</th>
                            <td field-key='data_scadenza'>{{ $registration->data_scadenza }}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <a href="{{ url('/admin/customer-registration-show/'.$registration->id) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>       
                            </td>
                        </tr>
                    </table>

                </li>
                @endforeach
                @else
                <li>
                    <p>@lang('global.app_no_entries_in_table')</p>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@stop
