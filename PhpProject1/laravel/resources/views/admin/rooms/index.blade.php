@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.rooms.title')</h3>
    @can('room_create')
    <p>
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($rooms) > 0 ? 'datatable' : '' }} @can('room_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('room_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.rooms.fields.descrizione')</th>
                        <th>@lang('global.rooms.fields.prezzo')</th>
                        <th>@lang('global.rooms.fields.p-letto')</th>
                        <th>@lang('global.rooms.fields.id-hotel')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($rooms) > 0)
                        @foreach ($rooms as $room)
                            <tr data-entry-id="{{ $room->id }}">
                                @can('room_delete')
                                    <td></td>
                                @endcan

                                <td field-key='descrizione'>{{ $room->descrizione }}</td>
                                <td field-key='prezzo'>{{ $room->prezzo }}</td>
                                <td field-key='p_letto'>{{ $room->p_letto }}</td>
                                <td field-key='id_hotel'>{{ $room->id_hotel->nome ?? '' }}</td>
                                                                <td>
                                    @can('room_view')
                                    <a href="{{ route('admin.rooms.show',[$room->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('room_edit')
                                    <a href="{{ route('admin.rooms.edit',[$room->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('room_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rooms.destroy', $room->id])) !!}
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
    </div>
@stop

@section('javascript') 
    <script>
        @can('room_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.rooms.mass_destroy') }}';
        @endcan

    </script>
@endsection