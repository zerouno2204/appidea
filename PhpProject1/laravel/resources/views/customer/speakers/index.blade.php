@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

<div class="mdl-card" style="width: 100%;">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.speakers.title')</h2>
    </div>
    <div class="mdl-card__supporting-text">
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp ">
            <thead>
                <tr>
                   

                    <th class="mdl-data-table__cell--non-numeric">@lang('global.speakers.fields.nome')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.speakers.fields.cognome')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.speakers.fields.img-path')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.speakers.fields.contatti')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.speakers.fields.ruolo')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.speakers.fields.descrizione')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.speakers.fields.curriculuum')</th>
                    <th class="mdl-data-table__cell--non-numeric">&nbsp;</th>

                </tr>
            </thead>

            <tbody>
                @if (count($speakers) > 0)
                @foreach ($speakers as $speaker)
                <tr data-entry-id="{{ $speaker->id }}">
                   

                    <td field-key='nome'>{{ $speaker->nome }}</td>
                    <td field-key='cognome'>{{ $speaker->cognome }}</td>
                    <td field-key='img_path'>@if($speaker->img_path)<a href="{{ asset(env('UPLOAD_PATH').'/' . $speaker->img_path) }}" target="_blank">Download file</a>@endif</td>
                    <td field-key='contatti'>{{ $speaker->contatti }}</td>
                    <td field-key='ruolo'>{{ $speaker->ruolo }}</td>
                    <td field-key='descrizione'>{!! $speaker->descrizione !!}</td>
                    <td field-key='curriculuum'>@if($speaker->curriculuum)<a href="{{ asset(env('UPLOAD_PATH').'/' . $speaker->curriculuum) }}" target="_blank">Download file</a>@endif</td>
                    <td>
                        @can('speaker_view')
                        <a href="{{ url('admin/speaker-congress-show/'. $speaker->id) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                        @endcan
                       
                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="12">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="mdl-card__actions">
        @can('speaker_create')
        <a href="{{ route('admin.speakers.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        @endcan
    </div>
</div>
@stop
