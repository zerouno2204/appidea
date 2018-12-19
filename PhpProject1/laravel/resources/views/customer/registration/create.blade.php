@extends('layouts.app')

@section('content')
<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.registrations.title') @lang('global.app_create')</h2>
    </div>
    <div class="mdl-card__supporting-text">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.registrations.store'], 'files' => true, 'enctype' => 'multipart/form-data']) !!}
        <input type="hidden" id="id_congress_id" name="id_congress_id" value="{{$congress->id}}">
        <input type="hidden" name="id_user_id" value="{{Auth::user()->id}}">
        
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="id_entry_id" class="control-label">@lang('global.registrations.fields.id-entry')</label>
                    <select id="id_entry_id" name="id_entry_id" class="form-control">
                        @foreach($id_entries as $entry)
                        <option selected value="{{$entry->id}}" >{{$entry->nome}}</option>
                        @endforeach
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('id_entry_id'))
                    <p class="help-block">
                        {{ $errors->first('id_entry_id') }}
                    </p>
                    @endif
                </div>     
                <div class="col-sm-6 form-group" id="codice">
                    <label class="control-label">Inserisci Codice</label>
                    <input type="text" id="str-codice" name="codice" class="form-control">
                    <p id="code-error" class="help-block">

                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label class="control-label">Nome</label>
                    <input type="text" name="nome" class="form-control">
                </div>
                <div class="col-sm-6 form-group">
                    <label class="control-label">Cognome</label>
                    <input type="text" name="cognome" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 form-group">
                    {!! Form::label('nome_documento', trans('global.registrations.fields.nome-documento').'', ['class' => 'control-label']) !!}
                    {!! Form::text('nome_documento', old('nome_documento'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nome_documento'))
                    <p class="help-block">
                        {{ $errors->first('nome_documento') }}
                    </p>
                    @endif
                </div>

                <div class="col-sm-4 form-group">
                    {!! Form::label('luogo_rilascio', trans('global.registrations.fields.luogo-rilascio').'', ['class' => 'control-label']) !!}
                    {!! Form::text('luogo_rilascio', old('luogo_rilascio'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('luogo_rilascio'))
                    <p class="help-block">
                        {{ $errors->first('luogo_rilascio') }}
                    </p>
                    @endif
                </div>

                <div class="col-sm-4 form-group">
                    {!! Form::label('data_emissione', trans('global.registrations.fields.data-emissione').'', ['class' => 'control-label']) !!}
                    {!! Form::text('data_emissione', old('data_emissione'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('data_emissione'))
                    <p class="help-block">
                        {{ $errors->first('data_emissione') }}
                    </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 form-group">
                    {!! Form::label('data_scadenza', trans('global.registrations.fields.data-scadenza').'', ['class' => 'control-label']) !!}
                    {!! Form::text('data_scadenza', old('data_scadenza'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('data_scadenza'))
                    <p class="help-block">
                        {{ $errors->first('data_scadenza') }}
                    </p>
                    @endif
                </div>

                <div class="col-sm-4 form-group">
                    {!! Form::label('id_tipo_doc', trans('global.registrations.fields.id-tipo-doc').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_tipo_doc', $id_tipo_doc, old('id_tipo_doc'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_tipo_doc'))
                    <p class="help-block">
                        {{ $errors->first('id_tipo_doc') }}
                    </p>
                    @endif
                </div>

                <div class="col-sm-4 form-group">
                    <label class="control-label">Caricamento documenti</label>
                    <input required type="file" class="form-control" name="images[]" placeholder="carica" multiple>
                    <p class="help-block"></p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 form-group">
                    {!! Form::label('id_hotel_id', trans('global.registrations.fields.id-hotel').'', ['class' => 'control-label']) !!}
                    {!! Form::select('id_hotel_id', $id_hotels, old('id_hotel_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_hotel_id'))
                    <p class="help-block">
                        {{ $errors->first('id_hotel_id') }}
                    </p>
                    @endif
                </div>

                <div class="col-sm-6 form-group">                
                    <label for="id_camera_id" class="control-label">@lang('global.registrations.fields.id-camera')</label>
                    <select name="id_camera_id" id="id_camera_id" class="form-control">

                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('id_camera_id'))
                    <p class="help-block">
                        {{ $errors->first('id_camera_id') }}
                    </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('note', trans('global.registrations.fields.note').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('note', old('note'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('note'))
                    <p class="help-block">
                        {{ $errors->first('note') }}
                    </p>
                    @endif
                </div>
            </div>  

        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('javascript')
@parent
<script>
    $(document).ready(function () {
        $('#codice').hide();
        $('#id_entry_id').change(function () {
            var entries = <?php echo json_encode($id_entries); ?>;
            var val = $('#id_entry_id').val();
            $.each(entries, function (entries, entry) {
                console.log(entry.ab_codice);
                if (entry.id == val) {
                    if (entry.ab_codice == 1) {
                        $('#codice').show();
                        $('.btn-danger').prop('disabled', true);
                    } else {
                        $('#codice').hide();
                        $('.btn-danger').prop('disabled', false);
                    }
                }

            });
        });

        $('#str-codice').on('input', function () {
            var code = $('#str-codice').val();
            var congress_id = $('#id_congress_id').val();
            $('.btn-danger').prop('disabled', true);
            $('#code-error').html('');
            $.ajax({
                url: "{{ route('admin.checkCode') }}",
                method: "POST",
                data: {_token: '{{csrf_token()}}', code: code, congress: congress_id},
                success: function (data)
                {
                    console.log(data);
                    if (data == 'True') {
                        $('#code-error').append('Codice Valido');
                        $('.btn-danger').prop('disabled', false);
                    } else {
                        $('#code-error').append('Codice Inesistente');
                    }

                },
                error: function (data) {
                    console.log(data);
                }

            });

        });

        $('#id_hotel_id').change(function () {
            var hotel_id = $('#id_hotel_id').val();
            var congress_id = $('#id_congress_id').val();
            $.ajax({
                url: "{{url('/admin/ajax-registration-rooms')}}",
                method: "POST",
                data: {_token: '{{csrf_token()}}', hotel_id: hotel_id, congress_id: congress_id},
                success: function (data)
                {
                    //console.log(data);
                    $('#room-column').html('');
                    $.each(data, function (data, item) {
                        $('#id_camera_id').append("<option value='" + item.id + "'>" + item.descrizione + "</option>");

                    });

                },
                error: function (data) {
                    console.log(data);
                }

            });
        });

    });
</script>
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
<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
<script>
    $('.editor').each(function () {
        CKEDITOR.replace($(this).attr('id'), {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',

            toolbarGroups: [
                {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
                {name: 'paragraph', groups: ['list', 'indent', 'block', 'align']},
            ]
        });
    });
</script>
@stop