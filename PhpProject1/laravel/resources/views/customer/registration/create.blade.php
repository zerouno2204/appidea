@extends('layouts.app')

@section('content')
<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.registrations.title') @lang('global.app_create')</h2>
    </div>
    <div class="mdl-card__supporting-text">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.registrations.store']]) !!}
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
                <input type="text" name="codice" class="form-control">
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
                {!! Form::label('path_img_doc', trans('global.registrations.fields.path-img-doc').'', ['class' => 'control-label']) !!}
                {!! Form::file('path_img_doc[]', [
                'multiple',
                'class' => 'form-control file-upload',
                'data-url' => route('admin.media.upload'),
                'data-bucket' => 'path_img_doc',
                'data-filekey' => 'path_img_doc',
                ]) !!}
                <p class="help-block"></p>
                <div class="photo-block">
                    <div class="progress-bar form-group">&nbsp;</div>
                    <div class="files-list"></div>
                </div>
                @if($errors->has('path_img_doc'))
                <p class="help-block">
                    {{ $errors->first('path_img_doc') }}
                </p>
                @endif
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
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    });
});
</script>
<script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
<script>
$(function () {
    $('.file-upload').each(function () {
        var $this = $(this);
        var $parent = $(this).parent();

        $(this).fileupload({
            dataType: 'json',
            formData: {
                model_name: 'Product',
                bucket: $this.data('bucket'),
                file_key: $this.data('filekey'),
                _token: '{{ csrf_token() }}'
            },
            add: function (e, data) {
                data.submit();
            },
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    var $line = $($('<p/>', {class: "form-group"}).html(file.name + ' (' + file.size + ' bytes)').appendTo($parent.find('.files-list')));
                    $line.append('<a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>');
                    $line.append('<input type="hidden" name="' + $this.data('bucket') + '_id[]" value="' + file.id + '"/>');
                    if ($parent.find('.' + $this.data('bucket') + '-ids').val() != '') {
                        $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + ',');
                    }
                    $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + file.id);
                });
                $parent.find('.progress-bar').hide().css(
                        'width',
                        '0%'
                        );
            }
        }).on('fileuploadprogressall', function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $parent.find('.progress-bar').show().css(
                    'width',
                    progress + '%'
                    );
        });
    });
    $(document).on('click', '.remove-file', function () {
        var $parent = $(this).parent();
        $parent.remove();
        return false;
    });
});
</script>
<script>
    $(document).ready(function () {

        $('#codice').hide();
        $('#id_entry_id').change(function () {
            var entries = <?php echo json_encode($id_entries) ?>;
            var entry_id = $('#id_entry_id').val();

            $.each(entries, function (entries, entry) {
                if (entry_id == entry.id) {
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
        $('#codice').change(function () {

        });

        $('#id_hotel_id').change(function () {
            var i = 0;
            var hotel_id = $('#id_hotel_id').val();
            var congress_id = $('#id_congress_id').val();
            $.ajax({
                url: "{{url('/admin/ajax-registration-rooms')}}",
                method: "POST",
                data: {_token: '{{csrf_token()}}', hotel_id: hotel_id, congress_id: congress_id},
                success: function (data)
                {
                    console.log(data);
                    $('#id_camera_id').html('');
                    $.each(data, function (data, item) {
                        $('#id_camera_id').append("<option value='" + item.id + "'>" + item.descrizione + " " + item.prezzo + "€ " + item.p_letto + " P.Letto </option>");
                    });

                },
                error: function (data) {
                    console.log(data);
                }

            });
        });
    });
</script>
@stop