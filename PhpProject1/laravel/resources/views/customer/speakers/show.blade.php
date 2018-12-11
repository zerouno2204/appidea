@extends('layouts.app')

@section('content')
<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">{{ $speaker->nome }} { $speaker->cognome }}</h2>
    </div>
    <div class="mdl-card__media">
        <img src="{{ asset(env('UPLOAD_PATH').'/' . $speaker->img_path) }}">
    </div>
    <div class="mdl-card__supporting-text mdl-card--border">
        <table class="table table-bordered table-striped"> 
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
    <div class="mdl-card__actions">
        <a href="{{url('admin/speaker-congress/'.$congress->id)}}" class="btn btn-default">@lang('global.app_back_to_list')</a>
    </div>
</div>
@stop

@section('javascript')
@parent
<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
<script>
$('.editor').each(function () {
CKEDITOR.replace($(this).attr('id'), {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
});
});
</script>

@stop
