@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.registrations.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.registrations.fields.nome-documento')</th>
                            <td field-key='nome_documento'>{{ $registration->nome_documento }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.registrations.fields.luogo-rilascio')</th>
                            <td field-key='luogo_rilascio'>{{ $registration->luogo_rilascio }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.registrations.fields.data-emissione')</th>
                            <td field-key='data_emissione'>{{ $registration->data_emissione }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.registrations.fields.data-scadenza')</th>
                            <td field-key='data_scadenza'>{{ $registration->data_scadenza }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.registrations.fields.id-tipo-doc')</th>
                            <td field-key='id_tipo_doc'>{{ $registration->id_tipo_doc }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.registrations.fields.path-img-doc')</th>
                            <td field-key='path_img_doc'>{{ $registration->path_img_doc }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.registrations.fields.note')</th>
                            <td field-key='note'>{{ $registration->note }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.registrations.fields.registrationscol')</th>
                            <td field-key='registrationscol'>{{ $registration->registrationscol }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.registrations.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

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
