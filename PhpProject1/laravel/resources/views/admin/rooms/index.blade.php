@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')


<div class="mdl-card" style="width: 100%;">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text mdl-card--border">@lang('global.rooms.title')</h2>
    </div>
    <div class="mdl-card__supporting-text">




        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp {{ count($rooms) > 0 ? 'datatable' : '' }} @can('room_delete') dt-select @endcan"
               style="width: 80%; margin-left: 0;">
            <thead>
                <tr>
                    @can('room_delete')
                    <th class="mdl-data-table__cell--non-numeric" style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    @endcan

                    <th class="mdl-data-table__cell--non-numeric">@lang('global.rooms.fields.descrizione')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.rooms.fields.prezzo')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.rooms.fields.p-letto')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.rooms.fields.id-hotel')</th>
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
    <div class="mdl-card__actions">
        @can('room_create')
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>        
        @endcan
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