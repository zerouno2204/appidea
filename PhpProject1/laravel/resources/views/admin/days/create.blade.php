@extends('layouts.app')

@section('content')



<div class="mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.day.title') @lang('global.app_create')</h2>
    </div>

    <div class="mdl-card__supporting-text">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.days.store']]) !!}
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('nome', trans('global.day.fields.nome').'', ['class' => 'control-label']) !!}
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
                {!! Form::label('descrizione', trans('global.day.fields.descrizione').'', ['class' => 'control-label']) !!}
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
                {!! Form::label('id_congresso_id', trans('global.day.fields.id-congresso').'', ['class' => 'control-label']) !!}
                {!! Form::select('id_congresso_id', $id_congressos, old('id_congresso_id'), ['class' => 'form-control select2']) !!}
                <p class="help-block"></p>
                @if($errors->has('id_congresso_id'))
                <p class="help-block">
                    {{ $errors->first('id_congresso_id') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('data', trans('global.day.fields.data').'', ['class' => 'control-label']) !!}
                {!! Form::text('data', old('data'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('data'))
                <p class="help-block">
                    {{ $errors->first('data') }}
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