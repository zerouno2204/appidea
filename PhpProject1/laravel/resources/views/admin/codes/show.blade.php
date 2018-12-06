@extends('layouts.app')

@section('content')


<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.codes.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">
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

    </div>
    <div class="mdl-card__actions">

        <a href="{{ route('admin.codes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
    </div>
</div>
@stop


