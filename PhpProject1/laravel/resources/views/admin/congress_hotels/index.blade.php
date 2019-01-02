@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.congress-hotel.title')</h3>
    @can('congress_hotel_create')
    <p>
        <a href="{{ route('admin.congress_hotels.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($congress_hotels) > 0 ? 'datatable' : '' }} @can('congress_hotel_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('congress_hotel_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.congress-hotel.fields.id-congress')</th>
                        <th>@lang('global.congress-hotel.fields.id-hotel')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($congress_hotels) > 0)
                        @foreach ($congress_hotels as $congress_hotel)
                            <tr data-entry-id="{{ $congress_hotel->id }}">
                                @can('congress_hotel_delete')
                                    <td></td>
                                @endcan

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('congress_hotel_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.congress_hotels.mass_destroy') }}';
        @endcan

    </script>
@endsection