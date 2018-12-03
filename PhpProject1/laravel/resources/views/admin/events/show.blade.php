@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.event.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.events.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
