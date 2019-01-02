@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.images.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.images.fields.nome')</th>
                            <td field-key='nome'>{{ $image->nome }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.images.fields.path')</th>
                            <td field-key='path'> @foreach($image->getMedia('path') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#images_hotel" aria-controls="images_hotel" role="tab" data-toggle="tab">Images hotel</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="images_hotel">
<table class="table table-bordered table-striped {{ count($images_hotels) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.images-hotel.fields.img')</th>
                        <th>@lang('global.images-hotel.fields.hotel')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($images_hotels) > 0)
            @foreach ($images_hotels as $images_hotel)
                <tr data-entry-id="{{ $images_hotel->id }}">
                    <td field-key='img'>{{ $images_hotel->img->nome ?? '' }}</td>
                                <td field-key='hotel'>{{ $images_hotel->hotel->nome ?? '' }}</td>
                                                                <td>
                                    @can('images_hotel_view')
                                    <a href="{{ route('admin.images_hotels.show',[$images_hotel->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('images_hotel_edit')
                                    <a href="{{ route('admin.images_hotels.edit',[$images_hotel->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('images_hotel_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.images_hotels.destroy', $images_hotel->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.images.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


