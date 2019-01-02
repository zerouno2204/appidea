@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.images-hotel.title')</h3>
    @can('images_hotel_create')
    <p>
        <a href="{{ route('admin.images_hotels.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($images_hotels) > 0 ? 'datatable' : '' }} @can('images_hotel_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('images_hotel_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.images-hotel.fields.img')</th>
                        <th>@lang('global.images-hotel.fields.hotel')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($images_hotels) > 0)
                        @foreach ($images_hotels as $images_hotel)
                            <tr data-entry-id="{{ $images_hotel->id }}">
                                @can('images_hotel_delete')
                                    <td></td>
                                @endcan

                                <td field-key='img'>{{ $images_hotel->img->nome ?? '' }}</td>
                                <td field-key='hotel'>{{ $images_hotel->hotel->nome ?? '' }}</td>
                                                                <td>
                                    @can('images_hotel_view')
                                    <a href="{{ route('admin.images_hotels.show',[$images_hotel->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('images_hotel_edit')
                                    <a href="{{ route('admin.images_hotels.edit',[$images_hotel->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('images_hotel_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.images_hotels.destroy', $images_hotel->id])) !!}
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
        @can('images_hotel_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.images_hotels.mass_destroy') }}';
        @endcan

    </script>
@endsection