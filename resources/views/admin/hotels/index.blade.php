@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.hotels.title')</h3>
    @can('hotel_create')
    <p>
        <a href="{{ route('admin.hotels.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($hotels) > 0 ? 'datatable' : '' }} @can('hotel_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('hotel_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

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
                                @can('hotel_delete')
                                    <td></td>
                                @endcan

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('hotel_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.hotels.mass_destroy') }}';
        @endcan

    </script>
@endsection