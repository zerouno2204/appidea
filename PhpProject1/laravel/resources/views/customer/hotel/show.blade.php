@extends('layouts.app')

@section('content')


<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.hotels.title') {{ $hotel->nome }}</h2>
    </div>

    <div class="mdl-card__supporting-text">
        <div class="container">
            <div class="col-sm-4">
                <table class="table table-bordered table-striped">                    
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

                </table>
            </div>
            <div class="col-sm-8">
                {!! $hotel->descrizione !!}
            </div>
        </div>
    </div>
    <div class="mdl-card__actions">
        <a href="{{url('admin/congress-hotels/'.$congress->id)}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">@lang('global.app_back_to_list')</a>
    </div>


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
