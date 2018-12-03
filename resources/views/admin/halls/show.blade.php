@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.hall.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
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
                            <th>@lang('global.hall.fields.planimetria')</th>
                            <td field-key='planimetria'> @foreach($hall->getMedia('planimetria') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('global.hall.fields.id-giorno')</th>
                            <td field-key='id_giorno'>{{ $hall->id_giorno->nome ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#event" aria-controls="event" role="tab" data-toggle="tab">Appuntamento</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="event">
<table class="table table-bordered table-striped {{ count($events) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.halls.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


