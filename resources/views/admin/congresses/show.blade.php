@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.congress.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.congress.fields.nome')</th>
                            <td field-key='nome'>{{ $congress->nome }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.congress.fields.descrizione')</th>
                            <td field-key='descrizione'>{{ $congress->descrizione }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.congress.fields.data-inizio')</th>
                            <td field-key='data_inizio'>{{ $congress->data_inizio }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.congress.fields.data-fine')</th>
                            <td field-key='data_fine'>{{ $congress->data_fine }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.congress.fields.img')</th>
                            <td field-key='img'>@if($congress->img)<a href="{{ asset(env('UPLOAD_PATH').'/' . $congress->img) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.congress.fields.descr-sede')</th>
                            <td field-key='descr_sede'>{{ $congress->descr_sede }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.congress.fields.ind-sede')</th>
                            <td field-key='ind_sede'>{{ $congress->ind_sede }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.congress.fields.lat')</th>
                            <td field-key='lat'>{{ $congress->lat }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.congress.fields.lng')</th>
                            <td field-key='lng'>{{ $congress->lng }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.congress.fields.cap-sede')</th>
                            <td field-key='cap_sede'>{{ $congress->cap_sede }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.congress.fields.id-citta-sede')</th>
                            <td field-key='id_citta_sede'>{{ $congress->id_citta_sede->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.congress.fields.id-prov-sede')</th>
                            <td field-key='id_prov_sede'>{{ $congress->id_prov_sede->nome ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#congress_entries" aria-controls="congress_entries" role="tab" data-toggle="tab">Congress entries</a></li>
<li role="presentation" class=""><a href="#congress_hotel" aria-controls="congress_hotel" role="tab" data-toggle="tab">Congress hotel</a></li>
<li role="presentation" class=""><a href="#speakers_congress" aria-controls="speakers_congress" role="tab" data-toggle="tab">Speakers congress</a></li>
<li role="presentation" class=""><a href="#day" aria-controls="day" role="tab" data-toggle="tab">Day</a></li>
<li role="presentation" class=""><a href="#codes" aria-controls="codes" role="tab" data-toggle="tab">Codes</a></li>
<li role="presentation" class=""><a href="#registrations" aria-controls="registrations" role="tab" data-toggle="tab">Registrations</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="congress_entries">
<table class="table table-bordered table-striped {{ count($congress_entries) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.congress-entries.fields.id-congress')</th>
                        <th>@lang('global.congress-entries.fields.id-entry')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($congress_entries) > 0)
            @foreach ($congress_entries as $congress_entry)
                <tr data-entry-id="{{ $congress_entry->id }}">
                    <td field-key='id_congress'>{{ $congress_entry->id_congress->nome ?? '' }}</td>
                                <td field-key='id_entry'>{{ $congress_entry->id_entry->nome ?? '' }}</td>
                                                                <td>
                                    @can('congress_entry_view')
                                    <a href="{{ route('admin.congress_entries.show',[$congress_entry->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('congress_entry_edit')
                                    <a href="{{ route('admin.congress_entries.edit',[$congress_entry->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('congress_entry_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.congress_entries.destroy', $congress_entry->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="congress_hotel">
<table class="table table-bordered table-striped {{ count($congress_hotels) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.congress-hotel.fields.id-congress')</th>
                        <th>@lang('global.congress-hotel.fields.id-hotel')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($congress_hotels) > 0)
            @foreach ($congress_hotels as $congress_hotel)
                <tr data-entry-id="{{ $congress_hotel->id }}">
                    <td field-key='id_congress'>{{ $congress_hotel->id_congress->nome ?? '' }}</td>
                                <td field-key='id_hotel'>{{ $congress_hotel->id_hotel->nome ?? '' }}</td>
                                                                <td>
                                    @can('congress_hotel_view')
                                    <a href="{{ route('admin.congress_hotels.show',[$congress_hotel->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('congress_hotel_edit')
                                    <a href="{{ route('admin.congress_hotels.edit',[$congress_hotel->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('congress_hotel_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.congress_hotels.destroy', $congress_hotel->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="speakers_congress">
<table class="table table-bordered table-striped {{ count($speakers_congresses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.speakers-congress.fields.id-congress')</th>
                        <th>@lang('global.speakers-congress.fields.id-speaker')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($speakers_congresses) > 0)
            @foreach ($speakers_congresses as $speakers_congress)
                <tr data-entry-id="{{ $speakers_congress->id }}">
                    <td field-key='id_congress'>{{ $speakers_congress->id_congress->nome ?? '' }}</td>
                                <td field-key='id_speaker'>{{ $speakers_congress->id_speaker->nome ?? '' }}</td>
                                                                <td>
                                    @can('speakers_congress_view')
                                    <a href="{{ route('admin.speakers_congresses.show',[$speakers_congress->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('speakers_congress_edit')
                                    <a href="{{ route('admin.speakers_congresses.edit',[$speakers_congress->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('speakers_congress_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.speakers_congresses.destroy', $speakers_congress->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="day">
<table class="table table-bordered table-striped {{ count($days) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.day.fields.nome')</th>
                        <th>@lang('global.day.fields.descrizione')</th>
                        <th>@lang('global.day.fields.id-congresso')</th>
                        <th>@lang('global.day.fields.data')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($days) > 0)
            @foreach ($days as $day)
                <tr data-entry-id="{{ $day->id }}">
                    <td field-key='nome'>{{ $day->nome }}</td>
                                <td field-key='descrizione'>{!! $day->descrizione !!}</td>
                                <td field-key='id_congresso'>{{ $day->id_congresso->nome ?? '' }}</td>
                                <td field-key='data'>{{ $day->data }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.days.restore', $day->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.days.perma_del', $day->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('day_view')
                                    <a href="{{ route('admin.days.show',[$day->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('day_edit')
                                    <a href="{{ route('admin.days.edit',[$day->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('day_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.days.destroy', $day->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="codes">
<table class="table table-bordered table-striped {{ count($codes) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.codes.fields.code')</th>
                        <th>@lang('global.codes.fields.qrcode')</th>
                        <th>@lang('global.codes.fields.id-congress')</th>
                        <th>@lang('global.codes.fields.id-user')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($codes) > 0)
            @foreach ($codes as $code)
                <tr data-entry-id="{{ $code->id }}">
                    <td field-key='code'>{{ $code->code }}</td>
                                <td field-key='qrcode'>{{ $code->qrcode }}</td>
                                <td field-key='id_congress'>{{ $code->id_congress->nome ?? '' }}</td>
                                <td field-key='id_user'>{{ $code->id_user->name ?? '' }}</td>
                                                                <td>
                                    @can('code_view')
                                    <a href="{{ route('admin.codes.show',[$code->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('code_edit')
                                    <a href="{{ route('admin.codes.edit',[$code->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('code_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.codes.destroy', $code->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="registrations">
<table class="table table-bordered table-striped {{ count($registrations) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.registrations.fields.nome-documento')</th>
                        <th>@lang('global.registrations.fields.luogo-rilascio')</th>
                        <th>@lang('global.registrations.fields.data-emissione')</th>
                        <th>@lang('global.registrations.fields.data-scadenza')</th>
                        <th>@lang('global.registrations.fields.id-tipo-doc')</th>
                        <th>@lang('global.registrations.fields.path-img-doc')</th>
                        <th>@lang('global.registrations.fields.note')</th>
                        <th>@lang('global.registrations.fields.registrationscol')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($registrations) > 0)
            @foreach ($registrations as $registration)
                <tr data-entry-id="{{ $registration->id }}">
                    <td field-key='nome_documento'>{{ $registration->nome_documento }}</td>
                                <td field-key='luogo_rilascio'>{{ $registration->luogo_rilascio }}</td>
                                <td field-key='data_emissione'>{{ $registration->data_emissione }}</td>
                                <td field-key='data_scadenza'>{{ $registration->data_scadenza }}</td>
                                <td field-key='id_tipo_doc'>{{ $registration->id_tipo_doc }}</td>
                                <td field-key='path_img_doc'>{{ $registration->path_img_doc }}</td>
                                <td field-key='note'>{{ $registration->note }}</td>
                                <td field-key='registrationscol'>{{ $registration->registrationscol }}</td>
                                                                <td>
                                    @can('registration_view')
                                    <a href="{{ route('admin.registrations.show',[$registration->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('registration_edit')
                                    <a href="{{ route('admin.registrations.edit',[$registration->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('registration_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.registrations.destroy', $registration->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.congresses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
