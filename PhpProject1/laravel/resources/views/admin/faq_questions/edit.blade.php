@extends('layouts.app')

@section('content')

<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.faq-questions.title') @lang('global.app_edit')</h2>
    </div>

    <div class="mdl-card__supporting-text">
        {!! Form::model($faq_question, ['method' => 'PUT', 'route' => ['admin.faq_questions.update', $faq_question->id]]) !!}
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('category_id', trans('global.faq-questions.fields.category').'*', ['class' => 'control-label']) !!}
                {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('category_id'))
                <p class="help-block">
                    {{ $errors->first('category_id') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('question_text', trans('global.faq-questions.fields.question-text').'*', ['class' => 'control-label']) !!}
                {!! Form::textarea('question_text', old('question_text'), ['class' => 'form-control ', 'placeholder' => '', 'required' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('question_text'))
                <p class="help-block">
                    {{ $errors->first('question_text') }}
                </p>
                @endif
            </div>
        </div>
        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('answer_text', trans('global.faq-questions.fields.answer-text').'*', ['class' => 'control-label']) !!}
                {!! Form::textarea('answer_text', old('answer_text'), ['class' => 'form-control ', 'placeholder' => '', 'required' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('answer_text'))
                <p class="help-block">
                    {{ $errors->first('answer_text') }}
                </p>
                @endif
            </div>
        </div>
        @endif
        {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
</div>


@stop

