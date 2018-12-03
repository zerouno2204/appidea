@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.speakers-congress.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.speakers-congress.fields.id-congress')</th>
                            <td field-key='id_congress'>{{ $speakers_congress->id_congress->nome ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.speakers-congress.fields.id-speaker')</th>
                            <td field-key='id_speaker'>{{ $speakers_congress->id_speaker->nome ?? '' }}</td>
<td field-key='cognome'>{{ isset($speakers_congress->id_speaker) ? $speakers_congress->id_speaker->cognome : '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.speakers_congresses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


