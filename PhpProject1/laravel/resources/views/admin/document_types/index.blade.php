@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')





<div class="mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.document-type.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp {{ count($document_types) > 0 ? 'datatable' : '' }} @can('document_type_delete') dt-select @endcan">
            <thead>
                <tr>
                    @can('document_type_delete')
                    <th class="mdl-data-table__cell--non-numeric" style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    @endcan

                    <th class="mdl-data-table__cell--non-numeric">@lang('global.document-type.fields.nome')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.document-type.fields.slug')</th>
                    <th class="mdl-data-table__cell--non-numeric">&nbsp;</th>

                </tr>
            </thead>

            <tbody>
                @if (count($document_types) > 0)
                @foreach ($document_types as $document_type)
                <tr data-entry-id="{{ $document_type->id }}">
                    @can('document_type_delete')
                    <td></td>
                    @endcan

                    <td field-key='nome'>{{ $document_type->nome }}</td>
                    <td field-key='slug'>{{ $document_type->slug }}</td>
                    <td>
                        @can('document_type_view')
                        <a href="{{ route('admin.document_types.show',[$document_type->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                        @endcan
                        @can('document_type_edit')
                        <a href="{{ route('admin.document_types.edit',[$document_type->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                        @endcan
                        @can('document_type_delete')
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.document_types.destroy', $document_type->id])) !!}
                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                        @endcan
                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="mdl-card__actions mdl-card--border">
        @can('document_type_create')
        <a href="{{ route('admin.document_types.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>

        @endcan
    </div>
</div>
@stop

@section('javascript') 
<script>
    @can('document_type_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.document_types.mass_destroy') }}';
    @endcan

</script>
@endsection