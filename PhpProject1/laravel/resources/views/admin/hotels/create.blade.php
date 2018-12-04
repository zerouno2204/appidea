@extends('layouts.app')

@section('content')
<div class="mdl-card" style="width: 100%;">
    <div class="mdl-card__title mdl-card--border">
        @lang('global.app_create')  @lang('global.hotels.title')
    </div>
    <div class="mdl-card__supporting-text">

        {!! Form::open(['method' => 'POST', 'route' => ['admin.hotels.store']]) !!}
        
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--6-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    {!! Form::label('nome', trans('global.hotels.fields.nome').'', ['class' => 'mdl-textfield__label']) !!}
                    {!! Form::text('nome', old('nome'), ['class' => 'mdl-textfield__input', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nome'))
                    <p class="help-block">
                        {{ $errors->first('nome') }}
                    </p>
                    @endif
                </div>
            </div>
            <div class="mdl-cell mdl-cell--6-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    {!! Form::label('indirizzo', trans('global.hotels.fields.indirizzo').'', ['class' => 'mdl-textfield__label']) !!}
                    {!! Form::text('indirizzo', old('indirizzo'), ['class' => 'mdl-textfield__input', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('indirizzo'))
                    <p class="help-block">
                        {{ $errors->first('indirizzo') }}
                    </p>
                    @endif
                </div>
            </div>
            <div class="mdl-cell mdl-cell--6-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    {!! Form::label('lat', trans('global.hotels.fields.lat').'', ['class' => 'mdl-textfield__label']) !!}
                    {!! Form::text('lat', old('lat'), ['class' => 'mdl-textfield__input', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('lat'))
                    <p class="help-block">
                        {{ $errors->first('lat') }}
                    </p>
                    @endif
                </div>
            </div>
            <div class="mdl-cell mdl-cell--6-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    {!! Form::label('lng', trans('global.hotels.fields.lng').'', ['class' => 'mdl-textfield__label']) !!}
                    {!! Form::text('lng', old('lng'), ['class' => 'mdl-textfield__input', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('lng'))
                    <p class="help-block">
                        {{ $errors->first('lng') }}
                    </p>
                    @endif
                </div>
            </div>            
            <div class="mdl-cell mdl-cell--4-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    {!! Form::label('cap', trans('global.hotels.fields.cap').'', ['class' => 'mdl-textfield__label']) !!}
                    {!! Form::text('cap', old('cap'), ['class' => 'mdl-textfield__input', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cap'))
                    <p class="help-block">
                        {{ $errors->first('cap') }}
                    </p>
                    @endif
                </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    {!! Form::label('citta_id', trans('global.hotels.fields.citta').'', ['class' => 'mdl-textfield__label']) !!}
                    {!! Form::select('citta_id', $cittas, old('citta_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('citta_id'))
                    <p class="help-block">
                        {{ $errors->first('citta_id') }}
                    </p>
                    @endif
                </div>
            </div>
           <div class="mdl-cell mdl-cell--4-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    {!! Form::label('provincia_id', trans('global.hotels.fields.provincia').'', ['class' => 'mdl-textfield__label']) !!}
                    {!! Form::select('provincia_id', $provincias, old('provincia_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('provincia_id'))
                    <p class="help-block">
                        {{ $errors->first('provincia_id') }}
                    </p>
                    @endif
                </div>
            </div>
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-textfield mdl-js-textfield">
                    {!! Form::label('descrizione', trans('global.hotels.fields.descrizione').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('descrizione', old('descrizione'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('descrizione'))
                    <p class="help-block">
                        {{ $errors->first('descrizione') }}
                    </p>
                    @endif
                </div>
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
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    });
});
</script>

@stop