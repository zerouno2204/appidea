@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.codes.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.codes.fields.code')</th>
                            <td field-key='code'>{{ $code->code }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.codes.fields.qrcode')</th>
                            <td field-key='qrcode'>{{ $code->qrcode }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.codes.fields.id-congress')</th>
                            <td field-key='id_congress'>{{ $code->id_congress->nome ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.codes.fields.id-user')</th>
                            <td field-key='id_user'>{{ $code->id_user->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.codes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


