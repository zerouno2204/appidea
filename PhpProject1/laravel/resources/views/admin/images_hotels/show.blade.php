@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.images-hotel.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.images-hotel.fields.img')</th>
                            <td field-key='img'>{{ $images_hotel->img->nome ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.images-hotel.fields.hotel')</th>
                            <td field-key='hotel'>{{ $images_hotel->hotel->nome ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.images_hotels.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


