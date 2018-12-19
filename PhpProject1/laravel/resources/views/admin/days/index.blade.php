@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

<div class="mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.day.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">
        <ul class="list-inline">
            <li><a href="{{ route('admin.days.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.days.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>

        <div class="hidden-xs">
            <table class="table table-bordered table-striped {{ count($days) > 0 ? 'datatable' : '' }} @can('day_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('day_delete')
                        @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                        @can('day_delete')
                        @if ( request('show_deleted') != 1 )<td></td>@endif
                        @endcan

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

        <div class="visible-xs">
            <ul style="list-style: none; padding: 0 15px;">
                @if (count($days) > 0)
                @foreach ($days as $day)
                <li>
                    <table class="table table-striped table-bordered table-responsive">
                        <tr>
                            <th>@lang('global.day.fields.nome')</th>
                            <td field-key='nome'>{{ $day->nome }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.day.fields.descrizione')</th>
                            <td field-key='descrizione'>{!! $day->descrizione !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.day.fields.id-congresso')</th>
                            <td field-key='id_congresso'>{{ $day->id_congresso->nome ?? '' }}</td>

                        </tr>
                        <tr>
                            <th>@lang('global.day.fields.data')</th>
                            <td field-key='data'>{{ $day->data }}</td>
                        </tr>
                        <tr>
                            <th></th>
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
        @can('day_create')
        <a href="{{ route('admin.days.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        @endcan
    </div>
</div>
@stop

@section('javascript') 
<script>
    @can('day_delete')
            @if (request('show_deleted') != 1) window.route_mass_crud_entries_destroy = '{{ route('admin.days.mass_destroy') }}';
    @endif
            @endcan

</script>
@endsection