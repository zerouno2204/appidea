@extends('layouts.app')

@section('content')   

    <div class="mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">{{ $day->nome }}</h2>
    </div>

        <div class="mdl-card__supporting-text">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">                       
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
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#hall" aria-controls="hall" role="tab" data-toggle="tab">Sala</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="hall">
<table class="table table-bordered table-striped {{ count($halls) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
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
                    <td field-key='nome'>{{ $hall->nome }}</td>
                                <td field-key='descrizione'>{{ $hall->descrizione }}</td>
                                <td field-key='capienza'>{{ $hall->capienza }}</td>
                                <td field-key='planimetria'>@if($hall->planimetria)<a href="{{ asset(env('UPLOAD_PATH').'/' . $hall->planimetria) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $hall->planimetria) }}"/></a>@endif</td>
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.days.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

@stop
