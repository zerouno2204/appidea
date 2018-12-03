@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.cities.title')</h3>
    @can('city_create')
    <p>
        <a href="{{ route('admin.cities.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($cities) > 0 ? 'datatable' : '' }} @can('city_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('city_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.cities.fields.name')</th>
                        <th>@lang('global.cities.fields.province')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($cities) > 0)
                        @foreach ($cities as $city)
                            <tr data-entry-id="{{ $city->id }}">
                                @can('city_delete')
                                    <td></td>
                                @endcan

                                <td field-key='name'>{{ $city->name }}</td>
                                <td field-key='province'>{{ $city->province->nome ?? '' }}</td>
                                                                <td>
                                    @can('city_view')
                                    <a href="{{ route('admin.cities.show',[$city->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('city_edit')
                                    <a href="{{ route('admin.cities.edit',[$city->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('city_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.cities.destroy', $city->id])) !!}
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
        @can('city_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.cities.mass_destroy') }}';
        @endcan

    </script>
@endsection