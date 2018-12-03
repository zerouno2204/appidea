@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.congress-hotel.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.congress-hotel.fields.id-congress')</th>
                            <td field-key='id_congress'>{{ $congress_hotel->id_congress->nome ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.congress-hotel.fields.id-hotel')</th>
                            <td field-key='id_hotel'>{{ $congress_hotel->id_hotel->nome ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.congress_hotels.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


