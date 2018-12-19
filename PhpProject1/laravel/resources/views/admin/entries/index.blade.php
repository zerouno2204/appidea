@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

<div class="mdl-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.entry.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">
        <div class="hidden-xs">
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
        <div class="visible-xs">
            <ul style="list-style: none; padding: 0 15px;">
                @if (count($entries) > 0)
                @foreach ($entries as $entry)
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>@lang('global.entry.fields.nome')</th>
                        <td field-key='nome'>{{ $entry->nome }}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.entry.fields.data-inizio')</th>
                        <td field-key='data_inizio'>{{ $entry->data_inizio }}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.entry.fields.data-fine')</th>
                        <td field-key='data_fine'>{{ $entry->data_fine }}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.entry.fields.prezzo')</th>
                        <td field-key='prezzo'>{{ $entry->prezzo }}</td>
                    </tr>
                    <tr>
                        <th>@lang('global.entry.fields.ab-codice')</th>
                        <td field-key='ab_codice'>{{ $entry->ab_codice }}</td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
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
                </table>
                @endforeach
                @else
                <li>@lang('global.app_no_entries_in_table')</li>
                @endif
            </ul>
        </div>

    </div>
    <div class="mdl-card__actions">
        @can('entry_create')
        <a href="{{ route('admin.entries.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        @endcan
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