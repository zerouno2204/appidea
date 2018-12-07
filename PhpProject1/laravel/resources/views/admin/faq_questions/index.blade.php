@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')



<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.faq-questions.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp {{ count($faq_questions) > 0 ? 'datatable' : '' }} @can('faq_question_delete') dt-select @endcan">
            <thead>
                <tr>
                    @can('faq_question_delete')
                    <th mdl-data-table__cell--non-numeric style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    @endcan

                    <th mdl-data-table__cell--non-numeric>@lang('global.faq-questions.fields.category')</th>
                    <th mdl-data-table__cell--non-numeric>@lang('global.faq-questions.fields.question-text')</th>
                    <th mdl-data-table__cell--non-numeric>@lang('global.faq-questions.fields.answer-text')</th>
                    <th mdl-data-table__cell--non-numeric>&nbsp;</th>

                </tr>
            </thead>

            <tbody>
                @if (count($faq_questions) > 0)
                @foreach ($faq_questions as $faq_question)
                <tr data-entry-id="{{ $faq_question->id }}">
                    @can('faq_question_delete')
                    <td></td>
                    @endcan

                    <td field-key='category'>{{ $faq_question->category->title ?? '' }}</td>
                    <td field-key='question_text'>{!! $faq_question->question_text !!}</td>
                    <td field-key='answer_text'>{!! $faq_question->answer_text !!}</td>
                    <td>
                        @can('faq_question_view')
                        <a href="{{ route('admin.faq_questions.show',[$faq_question->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                        @endcan
                        @can('faq_question_edit')
                        <a href="{{ route('admin.faq_questions.edit',[$faq_question->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                        @endcan
                        @can('faq_question_delete')
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.faq_questions.destroy', $faq_question->id])) !!}
                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                        @endcan
                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="mdl-card__actions">
        @can('faq_question_create')
        <a href="{{ route('admin.faq_questions.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>

        @endcan 
    </div>
</div>
@stop

@section('javascript') 
<script>
    @can('faq_question_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.faq_questions.mass_destroy') }}';
    @endcan

</script>
@endsection