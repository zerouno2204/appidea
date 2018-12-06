@extends('layouts.app')

@section('content')


<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.registrations.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">

        <table class="table table-bordered table-striped">
            <tr>
                <th>@lang('global.registrations.fields.nome-documento')</th>
                <th>@lang('global.registrations.fields.luogo-rilascio')</th>
                <th>@lang('global.registrations.fields.data-emissione')</th>
                <th>@lang('global.registrations.fields.data-scadenza')</th>
                <th>@lang('global.registrations.fields.id-tipo-doc')</th>
                <th>@lang('global.registrations.fields.path-img-doc')</th>
            </tr>
            <tr>
                <td field-key='nome_documento'>{{ $registration->nome_documento }}</td>
                <td field-key='luogo_rilascio'>{{ $registration->luogo_rilascio }}</td>            
                <td field-key='data_emissione'>{{ $registration->data_emissione }}</td>   
                <td field-key='data_scadenza'>{{ $registration->data_scadenza }}</td>
                <td field-key='id_tipo_doc'>{{ $registration->id_tipo_doc }}</td>
                <td field-key='path_img_doc'>{{ $registration->path_img_doc }}</td>  
            </tr>
            
        </table>
        <div>
            {{ $registration->note }}
        </div>
    </div>
    <div class="mdl-card__actions">
        <a href="{{ route('admin.registrations.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
    </div>
</div>
@stop

@section('javascript')
@parent

<script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script>
$(function () {
moment.updateLocale('{{ App::getLocale() }}', {
    week: {dow: 1} // Monday is the first day of the week
});

$('.date').datetimepicker({
    format: "{{ config('app.date_format_moment') }}",
    locale: "{{ App::getLocale() }}",
});

});
</script>

@stop
