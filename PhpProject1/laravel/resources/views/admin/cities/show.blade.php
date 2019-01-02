@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.cities.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.cities.fields.name')</th>
                            <td field-key='name'>{{ $city->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.cities.fields.province')</th>
                            <td field-key='province'>{{ $city->province->nome ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#hotels" aria-controls="hotels" role="tab" data-toggle="tab">Hotel</a></li>
<li role="presentation" class=""><a href="#congress" aria-controls="congress" role="tab" data-toggle="tab">Congress</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="hotels">
<table class="table table-bordered table-striped {{ count($hotels) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.hotels.fields.nome')</th>
                        <th>@lang('global.hotels.fields.lat')</th>
                        <th>@lang('global.hotels.fields.lng')</th>
                        <th>@lang('global.hotels.fields.indirizzo')</th>
                        <th>@lang('global.hotels.fields.cap')</th>
                        <th>@lang('global.hotels.fields.citta')</th>
                        <th>@lang('global.hotels.fields.provincia')</th>
                        <th>@lang('global.hotels.fields.descrizione')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($hotels) > 0)
            @foreach ($hotels as $hotel)
                <tr data-entry-id="{{ $hotel->id }}">
                    <td field-key='nome'>{{ $hotel->nome }}</td>
                                <td field-key='lat'>{{ $hotel->lat }}</td>
                                <td field-key='lng'>{{ $hotel->lng }}</td>
                                <td field-key='indirizzo'>{{ $hotel->indirizzo }}</td>
                                <td field-key='cap'>{{ $hotel->cap }}</td>
                                <td field-key='citta'>{{ $hotel->citta->name ?? '' }}</td>
                                <td field-key='provincia'>{{ $hotel->provincia->nome ?? '' }}</td>
                                <td field-key='descrizione'>{!! $hotel->descrizione !!}</td>
                                                                <td>
                                    @can('hotel_view')
                                    <a href="{{ route('admin.hotels.show',[$hotel->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('hotel_edit')
                                    <a href="{{ route('admin.hotels.edit',[$hotel->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('hotel_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.hotels.destroy', $hotel->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
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
<div role="tabpanel" class="tab-pane " id="congress">
<table class="table table-bordered table-striped {{ count($congresses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.congress.fields.nome')</th>
                        <th>@lang('global.congress.fields.descrizione')</th>
                        <th>@lang('global.congress.fields.data-inizio')</th>
                        <th>@lang('global.congress.fields.data-fine')</th>
                        <th>@lang('global.congress.fields.img')</th>
                        <th>@lang('global.congress.fields.descr-sede')</th>
                        <th>@lang('global.congress.fields.ind-sede')</th>
                        <th>@lang('global.congress.fields.lat')</th>
                        <th>@lang('global.congress.fields.lng')</th>
                        <th>@lang('global.congress.fields.cap-sede')</th>
                        <th>@lang('global.congress.fields.id-citta-sede')</th>
                        <th>@lang('global.congress.fields.id-prov-sede')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($congresses) > 0)
            @foreach ($congresses as $congress)
                <tr data-entry-id="{{ $congress->id }}">
                    <td field-key='nome'>{{ $congress->nome }}</td>
                                <td field-key='descrizione'>{{ $congress->descrizione }}</td>
                                <td field-key='data_inizio'>{{ $congress->data_inizio }}</td>
                                <td field-key='data_fine'>{{ $congress->data_fine }}</td>
                                <td field-key='img'>@if($congress->img)<a href="{{ asset(env('UPLOAD_PATH').'/' . $congress->img) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='descr_sede'>{{ $congress->descr_sede }}</td>
                                <td field-key='ind_sede'>{{ $congress->ind_sede }}</td>
                                <td field-key='lat'>{{ $congress->lat }}</td>
                                <td field-key='lng'>{{ $congress->lng }}</td>
                                <td field-key='cap_sede'>{{ $congress->cap_sede }}</td>
                                <td field-key='id_citta_sede'>{{ $congress->id_citta_sede->name ?? '' }}</td>
                                <td field-key='id_prov_sede'>{{ $congress->id_prov_sede->nome ?? '' }}</td>
                                                                <td>
                                    @can('congress_view')
                                    <a href="{{ route('admin.congresses.show',[$congress->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('congress_edit')
                                    <a href="{{ route('admin.congresses.edit',[$congress->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('congress_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.congresses.destroy', $congress->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.cities.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


