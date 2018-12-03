@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.congress.title')</h3>
    @can('congress_create')
    <p>
        <a href="{{ route('admin.congresses.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($congresses) > 0 ? 'datatable' : '' }} @can('congress_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('congress_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

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
                                @can('congress_delete')
                                    <td></td>
                                @endcan

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
@stop

@section('javascript') 
    <script>
        @can('congress_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.congresses.mass_destroy') }}';
        @endcan

    </script>
@endsection