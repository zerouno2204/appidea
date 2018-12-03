@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.entry.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.entry.fields.nome')</th>
                            <td field-key='nome'>{{ $entry->nome }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.entry.fields.data-inizio')</th>
                            <td field-key='data_inizio'>{{ $entry->data_inizio }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.entry.fields.data-fine')</th>
                            <td field-key='data_fine'>{{ $entry->data_fine }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.entry.fields.prezzo')</th>
                            <td field-key='prezzo'>{{ $entry->prezzo }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.entry.fields.ab-codice')</th>
                            <td field-key='ab_codice'>{{ $entry->ab_codice }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.entry.fields.descrizione')</th>
                            <td field-key='descrizione'>{!! $entry->descrizione !!}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#congress_entries" aria-controls="congress_entries" role="tab" data-toggle="tab">Congress entries</a></li>
<li role="presentation" class=""><a href="#registrations" aria-controls="registrations" role="tab" data-toggle="tab">Registrations</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="congress_entries">
<table class="table table-bordered table-striped {{ count($congress_entries) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.congress-entries.fields.id-congress')</th>
                        <th>@lang('global.congress-entries.fields.id-entry')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($congress_entries) > 0)
            @foreach ($congress_entries as $congress_entry)
                <tr data-entry-id="{{ $congress_entry->id }}">
                    <td field-key='id_congress'>{{ $congress_entry->id_congress->nome ?? '' }}</td>
                                <td field-key='id_entry'>{{ $congress_entry->id_entry->nome ?? '' }}</td>
                                                                <td>
                                    @can('congress_entry_view')
                                    <a href="{{ route('admin.congress_entries.show',[$congress_entry->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('congress_entry_edit')
                                    <a href="{{ route('admin.congress_entries.edit',[$congress_entry->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('congress_entry_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.congress_entries.destroy', $congress_entry->id])) !!}
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

            <a href="{{ route('admin.entries.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
