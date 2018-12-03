@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.document-type.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.document-type.fields.nome')</th>
                            <td field-key='nome'>{{ $document_type->nome }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.document-type.fields.slug')</th>
                            <td field-key='slug'>{{ $document_type->slug }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.document_types.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


