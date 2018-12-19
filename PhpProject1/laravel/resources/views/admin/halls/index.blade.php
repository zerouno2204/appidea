@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')


<div class="mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.hall.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">
        <ul class="list-inline">
            <li><a href="{{ route('admin.halls.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.halls.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
        <div class="hidden-xs">
            <table class="table table-bordered table-striped {{ count($halls) > 0 ? 'datatable' : '' }} @can('hall_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('hall_delete')
                        @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.hall.fields.nome')</th>
                        <th>@lang('global.hall.fields.descrizione')</th>
                        <th>@lang('global.hall.fields.capienza')</th>
                        <th>@lang('global.hall.fields.id-giorno')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @if (count($halls) > 0)
                    @foreach ($halls as $hall)
                    <tr data-entry-id="{{ $hall->id }}">
                        @can('hall_delete')
                        @if ( request('show_deleted') != 1 )<td></td>@endif
                        @endcan

                        <td field-key='nome'>{{ $hall->nome }}</td>
                        <td field-key='descrizione'>{{ $hall->descrizione }}</td>
                        <td field-key='capienza'>{{ $hall->capienza }}</td>
                        <td field-key='id_giorno'>{{ $hall->id_giorno->nome ?? '' }}</td>
                        @if( request('show_deleted') == 1 )
                        <td>
                            {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'POST',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.halls.restore', $hall->id])) !!}
                            {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                            {!! Form::close() !!}
                            {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.halls.perma_del', $hall->id])) !!}
                            {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                            {!! Form::close() !!}
                        </td>
                        @else
                        <td>
                            @can('hall_view')
                            <a href="{{ route('admin.halls.show',[$hall->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                            @endcan
                            @can('hall_edit')
                            <a href="{{ route('admin.halls.edit',[$hall->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                            @endcan
                            @can('hall_delete')
                            {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.halls.destroy', $hall->id])) !!}
                            {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                            {!! Form::close() !!}
                            @endcan
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="10">@lang('global.app_no_entries_in_table')</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="visible-xs">
            <ul style="list-style: none; padding: 0 15px;">
                @if (count($halls) > 0)
                @foreach ($halls as $hall)
                <li>
                    <table class="table table-bordered table-striped table-responsive">
                        <tr>
                            <th>@lang('global.hall.fields.nome')</th>
                            <td field-key='nome'>{{ $hall->nome }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.hall.fields.descrizione')</th>
                            <td field-key='descrizione'>{{ $hall->descrizione }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.hall.fields.capienza')</th>
                            <td field-key='capienza'>{{ $hall->capienza }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.hall.fields.id-giorno')</th>
                            <td field-key='id_giorno'>{{ $hall->id_giorno->nome ?? '' }}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                @can('hall_view')
                                <a href="{{ route('admin.halls.show',[$hall->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                @endcan
                                @can('hall_edit')
                                <a href="{{ route('admin.halls.edit',[$hall->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                @endcan
                                @can('hall_delete')
                                {!! Form::open(array(
                                'style' => 'display: inline-block;',
                                'method' => 'DELETE',
                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                'route' => ['admin.halls.destroy', $hall->id])) !!}
                                {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    </table>
                </li>
                @endforeach
                @else
                <li>@lang('global.app_no_entries_in_table')</li>
                @endif
            </ul>
        </div>
    </div>
    <div class="mdl-card__actions">
        @can('hall_create')
        <a href="{{ route('admin.halls.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        @endcan
    </div>
</div>
@stop

@section('javascript') 
<script>
    @can('hall_delete')
            @if (request('show_deleted') != 1) window.route_mass_crud_entries_destroy = '{{ route('admin.halls.mass_destroy') }}';
    @endif
            @endcan

</script>
@endsection