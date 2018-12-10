@extends('layouts.app')

@section('content')


<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.hotels.title') {{ $hotel->nome }}</h2>
    </div>

    <div class="mdl-card__supporting-text">
         <table class="table table-bordered table-striped">                    
                    <tr>
                        <th>@lang('global.hotels.fields.lat')</th>
                        <td field-key='lat'>{{ $hotel->lat }}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.hotels.fields.lng')</th>
                        <td field-key='lng'>{{ $hotel->lng }}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.hotels.fields.indirizzo')</th>
                        <td field-key='indirizzo'>{{ $hotel->indirizzo }}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.hotels.fields.cap')</th>
                        <td field-key='cap'>{{ $hotel->cap }}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.hotels.fields.citta')</th>
                        <td field-key='citta'>{{ $hotel->citta->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.hotels.fields.provincia')</th>
                        <td field-key='provincia'>{{ $hotel->provincia->nome ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.hotels.fields.descrizione')</th>
                        <td field-key='descrizione'>{!! $hotel->descrizione !!}</td>
                    </tr>
                </table>
    </div>

    <p>&nbsp;</p>

    <a href="#" onclick="goBack()" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
