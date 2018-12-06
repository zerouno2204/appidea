@extends('layouts.app')

@section('content')


<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h3 class="mdl-card__title ">@lang('global.entry.title')  @lang('global.app_create')</h3>
    </div>
    <div class="mdl-card__supporting-text">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.entries.store']]) !!}

        <div class="row">
            <div class="col-sm-4 form-group">
                {!! Form::label('nome', trans('global.entry.fields.nome').'', ['class' => 'control-label']) !!}
                {!! Form::text('nome', old('nome'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('nome'))
                <p class="help-block">
                    {{ $errors->first('nome') }}
                </p>
                @endif
            </div>

            <div class="col-sm-4 form-group">
                {!! Form::label('data_inizio', trans('global.entry.fields.data-inizio').'', ['class' => 'control-label']) !!}
                {!! Form::text('data_inizio', old('data_inizio'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('data_inizio'))
                <p class="help-block">
                    {{ $errors->first('data_inizio') }}
                </p>
                @endif
            </div>

            <div class="col-sm-4 form-group">
                {!! Form::label('data_fine', trans('global.entry.fields.data-fine').'', ['class' => 'control-label']) !!}
                {!! Form::text('data_fine', old('data_fine'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('data_fine'))
                <p class="help-block">
                    {{ $errors->first('data_fine') }}
                </p>
                @endif
            </div>
        </div>            
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('descrizione', trans('global.entry.fields.descrizione').'', ['class' => 'control-label']) !!}
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
            <div class="col-sm-4 form-group">
                {!! Form::label('prezzo', trans('global.entry.fields.prezzo').'', ['class' => 'control-label']) !!}
                {!! Form::text('prezzo', old('prezzo'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('prezzo'))
                <p class="help-block">
                    {{ $errors->first('prezzo') }}
                </p>
                @endif
            </div>
            <div class="col-sm-4 form-group">
                <label class="control-label">Congresso</label>
                <select name="congresso" class="form-control select2">
                    @foreach($congresses as $congress)
                    <option value="{{$congress->id}}">{{$congress->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 form-group">
                {!! Form::label('ab_codice', trans('global.entry.fields.ab-codice').'', ['class' => 'control-label']) !!}
                {!! Form::hidden('ab_codice', 0) !!}
                {!! Form::checkbox('ab_codice', 1, old('ab_codice', false), []) !!}                    
                <p class="help-block"></p>
                @if($errors->has('ab_codice'))
                <p class="help-block">
                    {{ $errors->first('ab_codice') }}
                </p>
                @endif
            </div>
        </div>

        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
    <div class="mdl-card__actions">
        ...
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