@extends('layouts.app')

@section('content')

<div class="mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.event.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-striped">
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
                </table>
            </div>
        </div>
    </div>
    <div class="mdl-card__actions">
        <a href="{{ route('admin.events.index') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">@lang('global.app_back_to_list')</a>
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
