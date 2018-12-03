@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.document-type.title')</h3>
    @can('document_type_create')
    <p>
        <a href="{{ route('admin.document_types.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($document_types) > 0 ? 'datatable' : '' }} @can('document_type_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('document_type_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.document-type.fields.nome')</th>
                        <th>@lang('global.document-type.fields.slug')</th>
                                                <th>&nbsp;</th>

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('document_type_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.document_types.mass_destroy') }}';
        @endcan

    </script>
@endsection