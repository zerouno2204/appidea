@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.entry.title')</h3>
    @can('entry_create')
    <p>
        <a href="{{ route('admin.entries.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($entries) > 0 ? 'datatable' : '' }} @can('entry_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('entry_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.entry.fields.nome')</th>
                        <th>@lang('global.entry.fields.data-inizio')</th>
                        <th>@lang('global.entry.fields.data-fine')</th>
                        <th>@lang('global.entry.fields.prezzo')</th>
                        <th>@lang('global.entry.fields.ab-codice')</th>
                        <th>@lang('global.entry.fields.descrizione')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($entries) > 0)
                        @foreach ($entries as $entry)
                            <tr data-entry-id="{{ $entry->id }}">
                                @can('entry_delete')
                                    <td></td>
                                @endcan

                                <td field-key='nome'>{{ $entry->nome }}</td>
                                <td field-key='data_inizio'>{{ $entry->data_inizio }}</td>
                                <td field-key='data_fine'>{{ $entry->data_fine }}</td>
                                <td field-key='prezzo'>{{ $entry->prezzo }}</td>
                                <td field-key='ab_codice'>{{ $entry->ab_codice }}</td>
                                <td field-key='descrizione'>{!! $entry->descrizione !!}</td>
                                                                <td>
                                    @can('entry_view')
                                    <a href="{{ route('admin.entries.show',[$entry->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('entry_edit')
                                    <a href="{{ route('admin.entries.edit',[$entry->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('entry_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.entries.destroy', $entry->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('entry_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.entries.mass_destroy') }}';
        @endcan

    </script>
@endsection