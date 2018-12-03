@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.hotels.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.hotels.fields.nome')</th>
                            <td field-key='nome'>{{ $hotel->nome }}</td>
                        </tr>
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
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#congress_hotel" aria-controls="congress_hotel" role="tab" data-toggle="tab">Congress hotel</a></li>
<li role="presentation" class=""><a href="#images_hotel" aria-controls="images_hotel" role="tab" data-toggle="tab">Images hotel</a></li>
<li role="presentation" class=""><a href="#rooms" aria-controls="rooms" role="tab" data-toggle="tab">Rooms</a></li>
<li role="presentation" class=""><a href="#registrations" aria-controls="registrations" role="tab" data-toggle="tab">Registrations</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="congress_hotel">
<table class="table table-bordered table-striped {{ count($congress_hotels) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.congress-hotel.fields.id-congress')</th>
                        <th>@lang('global.congress-hotel.fields.id-hotel')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($congress_hotels) > 0)
            @foreach ($congress_hotels as $congress_hotel)
                <tr data-entry-id="{{ $congress_hotel->id }}">
                    <td field-key='id_congress'>{{ $congress_hotel->id_congress->nome ?? '' }}</td>
                                <td field-key='id_hotel'>{{ $congress_hotel->id_hotel->nome ?? '' }}</td>
                                                                <td>
                                    @can('congress_hotel_view')
                                    <a href="{{ route('admin.congress_hotels.show',[$congress_hotel->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('congress_hotel_edit')
                                    <a href="{{ route('admin.congress_hotels.edit',[$congress_hotel->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('congress_hotel_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.congress_hotels.destroy', $congress_hotel->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="images_hotel">
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
<div role="tabpanel" class="tab-pane " id="rooms">
<table class="table table-bordered table-striped {{ count($rooms) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.rooms.fields.descrizione')</th>
                        <th>@lang('global.rooms.fields.prezzo')</th>
                        <th>@lang('global.rooms.fields.p-letto')</th>
                        <th>@lang('global.rooms.fields.id-hotel')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($rooms) > 0)
            @foreach ($rooms as $room)
                <tr data-entry-id="{{ $room->id }}">
                    <td field-key='descrizione'>{{ $room->descrizione }}</td>
                                <td field-key='prezzo'>{{ $room->prezzo }}</td>
                                <td field-key='p_letto'>{{ $room->p_letto }}</td>
                                <td field-key='id_hotel'>{{ $room->id_hotel->nome ?? '' }}</td>
                                                                <td>
                                    @can('room_view')
                                    <a href="{{ route('admin.rooms.show',[$room->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('room_edit')
                                    <a href="{{ route('admin.rooms.edit',[$room->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('room_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rooms.destroy', $room->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="registrations">
<table class="table table-bordered table-striped {{ count($registrations) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.registrations.fields.nome-documento')</th>
                        <th>@lang('global.registrations.fields.luogo-rilascio')</th>
                        <th>@lang('global.registrations.fields.data-emissione')</th>
                        <th>@lang('global.registrations.fields.data-scadenza')</th>
                        <th>@lang('global.registrations.fields.id-tipo-doc')</th>
                        <th>@lang('global.registrations.fields.path-img-doc')</th>
                        <th>@lang('global.registrations.fields.note')</th>
                        <th>@lang('global.registrations.fields.registrationscol')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($registrations) > 0)
            @foreach ($registrations as $registration)
                <tr data-entry-id="{{ $registration->id }}">
                    <td field-key='nome_documento'>{{ $registration->nome_documento }}</td>
                                <td field-key='luogo_rilascio'>{{ $registration->luogo_rilascio }}</td>
                                <td field-key='data_emissione'>{{ $registration->data_emissione }}</td>
                                <td field-key='data_scadenza'>{{ $registration->data_scadenza }}</td>
                                <td field-key='id_tipo_doc'>{{ $registration->id_tipo_doc }}</td>
                                <td field-key='path_img_doc'>{{ $registration->path_img_doc }}</td>
                                <td field-key='note'>{{ $registration->note }}</td>
                                <td field-key='registrationscol'>{{ $registration->registrationscol }}</td>
                                                                <td>
                                    @can('registration_view')
                                    <a href="{{ route('admin.registrations.show',[$registration->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('registration_edit')
                                    <a href="{{ route('admin.registrations.edit',[$registration->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('registration_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.registrations.destroy', $registration->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="19">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.hotels.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
