@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.speakers.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.speakers.fields.nome')</th>
                            <td field-key='nome'>{{ $speaker->nome }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.speakers.fields.cognome')</th>
                            <td field-key='cognome'>{{ $speaker->cognome }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.speakers.fields.img-path')</th>
                            <td field-key='img_path'>@if($speaker->img_path)<a href="{{ asset(env('UPLOAD_PATH').'/' . $speaker->img_path) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.speakers.fields.contatti')</th>
                            <td field-key='contatti'>{{ $speaker->contatti }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.speakers.fields.ruolo')</th>
                            <td field-key='ruolo'>{{ $speaker->ruolo }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.speakers.fields.descrizione')</th>
                            <td field-key='descrizione'>{!! $speaker->descrizione !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.speakers.fields.curriculuum')</th>
                            <td field-key='curriculuum'>@if($speaker->curriculuum)<a href="{{ asset(env('UPLOAD_PATH').'/' . $speaker->curriculuum) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#speakers_congress" aria-controls="speakers_congress" role="tab" data-toggle="tab">Speakers congress</a></li>
<li role="presentation" class=""><a href="#registrations" aria-controls="registrations" role="tab" data-toggle="tab">Registrations</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="speakers_congress">
<table class="table table-bordered table-striped {{ count($speakers_congresses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.speakers-congress.fields.id-congress')</th>
                        <th>@lang('global.speakers-congress.fields.id-speaker')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($speakers_congresses) > 0)
            @foreach ($speakers_congresses as $speakers_congress)
                <tr data-entry-id="{{ $speakers_congress->id }}">
                    <td field-key='id_congress'>{{ $speakers_congress->id_congress->nome ?? '' }}</td>
                                <td field-key='id_speaker'>{{ $speakers_congress->id_speaker->nome ?? '' }}</td>
                                                                <td>
                                    @can('speakers_congress_view')
                                    <a href="{{ route('admin.speakers_congresses.show',[$speakers_congress->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('speakers_congress_edit')
                                    <a href="{{ route('admin.speakers_congresses.edit',[$speakers_congress->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('speakers_congress_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.speakers_congresses.destroy', $speakers_congress->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="registrations">
<table class="table table-bordered table-striped {{ count($registrations) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.registrations.fields.nome-documento')</th>
                        <th>@lang('global.registrations.fields.luogo-rilascio')</th>
                        <th>@lang('global.registrations.fields.data-emissione')</th>
                        <th>@lang('global.registrations.fields.data-scadenza')</th>
                        <th>@lang('global.registrations.fields.id-tipo-doc')</th>
                        <th>@lang('global.registrations.fields.path-img-doc')</th>
                        <th>@lang('global.registrations.fields.note')</th>
                        <th>@lang('global.registrations.fields.registrationscol')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($registrations) > 0)
            @foreach ($registrations as $registration)
                <tr data-entry-id="{{ $registration->id }}">
                    <td field-key='nome_documento'>{{ $registration->nome_documento }}</td>
                                <td field-key='luogo_rilascio'>{{ $registration->luogo_rilascio }}</td>
                                <td field-key='data_emissione'>{{ $registration->data_emissione }}</td>
                                <td field-key='data_scadenza'>{{ $registration->data_scadenza }}</td>
                                <td field-key='id_tipo_doc'>{{ $registration->id_tipo_doc }}</td>
                                <td field-key='path_img_doc'>{{ $registration->path_img_doc }}</td>
                                <td field-key='note'>{{ $registration->note }}</td>
                                <td field-key='registrationscol'>{{ $registration->registrationscol }}</td>
                                                                <td>
                                    @can('registration_view')
                                    <a href="{{ route('admin.registrations.show',[$registration->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('registration_edit')
                                    <a href="{{ route('admin.registrations.edit',[$registration->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('registration_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.registrations.destroy', $registration->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="19">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.speakers.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
