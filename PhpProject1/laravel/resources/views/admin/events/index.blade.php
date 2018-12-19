@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

<div class="mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.event.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">
        <ul class="list-inline">
            <li><a href="{{ route('admin.events.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.events.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
        <div class="hidden-xs">   
            <table class="table table-bordered table-striped {{ count($events) > 0 ? 'datatable' : '' }} @can('event_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('event_delete')
                        @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.event.fields.intervallo-orario')</th>
                        <th>@lang('global.event.fields.nome')</th>
                        <th>@lang('global.event.fields.descrizione')</th>
                        <th>@lang('global.event.fields.id-sala')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @if (count($events) > 0)
                    @foreach ($events as $event)
                    <tr data-entry-id="{{ $event->id }}">
                        @can('event_delete')
                        @if ( request('show_deleted') != 1 )<td></td>@endif
                        @endcan

                        <td field-key='intervallo_orario'>{{ $event->intervallo_orario }}</td>
                        <td field-key='nome'>{{ $event->nome }}</td>
                        <td field-key='descrizione'>{!! $event->descrizione !!}</td>
                        <td field-key='id_sala'>{{ $event->id_sala->nome ?? '' }}</td>
                        @if( request('show_deleted') == 1 )
                        <td>
                            {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'POST',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.events.restore', $event->id])) !!}
                            {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                            {!! Form::close() !!}
                            {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.events.perma_del', $event->id])) !!}
                            {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                            {!! Form::close() !!}
                        </td>
                        @else
                        <td>
                            @can('event_view')
                            <a href="{{ route('admin.events.show',[$event->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                            @endcan
                            @can('event_edit')
                            <a href="{{ route('admin.events.edit',[$event->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                            @endcan
                            @can('event_delete')
                            {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.events.destroy', $event->id])) !!}
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
                 @if (count($events) > 0)
                 @foreach ($events as $event)
                <li>
                    <table class="table table-bordered table-striped table-responsive">
                        <tr>
                            <th>@lang('global.event.fields.intervallo-orario')</th>
                            <td field-key='intervallo_orario'>{{ $event->intervallo_orario }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.event.fields.nome')</th>
                            <td field-key='nome'>{{ $event->nome }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.event.fields.descrizione')</th>
                            <td field-key='descrizione'>{!! $event->descrizione !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.event.fields.id-sala')</th>
                            <td field-key='id_sala'>{{ $event->id_sala->nome ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <td>
                                @can('event_view')
                                <a href="{{ route('admin.events.show',[$event->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                @endcan
                                @can('event_edit')
                                <a href="{{ route('admin.events.edit',[$event->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                @endcan
                                @can('event_delete')
                                {!! Form::open(array(
                                'style' => 'display: inline-block;',
                                'method' => 'DELETE',
                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                'route' => ['admin.events.destroy', $event->id])) !!}
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
        @can('event_create')
        <p>
            <a href="{{ route('admin.events.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>

        </p>
        @endcan
    </div>
</div>
@stop

@section('javascript') 
<script>
    @can('event_delete')
            @if (request('show_deleted') != 1) window.route_mass_crud_entries_destroy = '{{ route('admin.events.mass_destroy') }}';
    @endif
            @endcan

</script>
@endsection