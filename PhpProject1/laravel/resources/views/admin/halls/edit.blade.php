@extends('layouts.app')

@section('content')


<div class="mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.hall.title') @lang('global.app_edit')</h2>
    </div>

    <div class="mdl-card__supporting-text">
            {!! Form::model($hall, ['method' => 'PUT', 'route' => ['admin.halls.update', $hall->id], 'files' => true,]) !!}
            <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('nome', trans('global.hall.fields.nome').'', ['class' => 'control-label']) !!}
                {!! Form::text('nome', old('nome'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('nome'))
                <p class="help-block">
                    {{ $errors->first('nome') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('descrizione', trans('global.hall.fields.descrizione').'', ['class' => 'control-label']) !!}
                {!! Form::textarea('descrizione', old('descrizione'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('descrizione'))
                <p class="help-block">
                    {{ $errors->first('descrizione') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('capienza', trans('global.hall.fields.capienza').'', ['class' => 'control-label']) !!}
                {!! Form::text('capienza', old('capienza'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('capienza'))
                <p class="help-block">
                    {{ $errors->first('capienza') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('planimetria', trans('global.hall.fields.planimetria').'', ['class' => 'control-label']) !!}
                {!! Form::file('planimetria[]', [
                'multiple',
                'class' => 'form-control file-upload',
                'data-url' => route('admin.media.upload'),
                'data-bucket' => 'planimetria',
                'data-filekey' => 'planimetria',
                ]) !!}
                <p class="help-block"></p>
                <div class="photo-block">
                    <div class="progress-bar form-group">&nbsp;</div>
                    <div class="files-list"></div>
                </div>
                @if($errors->has('planimetria'))
                <p class="help-block">
                    {{ $errors->first('planimetria') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('id_giorno_id', trans('global.hall.fields.id-giorno').'', ['class' => 'control-label']) !!}
                {!! Form::select('id_giorno_id', $id_giornos, old('id_giorno_id'), ['class' => 'form-control select2']) !!}
                <p class="help-block"></p>
                @if($errors->has('id_giorno_id'))
                <p class="help-block">
                    {{ $errors->first('id_giorno_id') }}
                </p>
                @endif
            </div>
        </div>
            {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
        </div>
    </div>

    
@stop

@section('javascript')
    @parent

    <script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
    <script>
        $(function () {
            $('.file-upload').each(function () {
                var $this = $(this);
                var $parent = $(this).parent();

                $(this).fileupload({
                    dataType: 'json',
                    formData: {
                        model_name: 'Hall',
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