@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.congress-entries.title')</h3>
    @can('congress_entry_create')
    <p>
        <a href="{{ route('admin.congress_entries.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($congress_entries) > 0 ? 'datatable' : '' }} @can('congress_entry_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('congress_entry_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.congress-entries.fields.id-congress')</th>
                        <th>@lang('global.congress-entries.fields.id-entry')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($congress_entries) > 0)
                        @foreach ($congress_entries as $congress_entry)
                            <tr data-entry-id="{{ $congress_entry->id }}">
                                @can('congress_entry_delete')
                                    <td></td>
                                @endcan

                                <td field-key='id_congress'>{{ $congress_entry->id_congress->nome ?? '' }}</td>
                                <td field-key='id_entry'>{{ $congress_entry->id_entry->nome ?? '' }}</td>
                                                                <td>
                                    @can('congress_entry_view')
                                    <a href="{{ route('admin.congress_entries.show',[$congress_entry->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('congress_entry_edit')
                                    <a href="{{ route('admin.congress_entries.edit',[$congress_entry->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('congress_entry_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.congress_entries.destroy', $congress_entry->id])) !!}
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
        @can('congress_entry_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.congress_entries.mass_destroy') }}';
        @endcan

    </script>
@endsection