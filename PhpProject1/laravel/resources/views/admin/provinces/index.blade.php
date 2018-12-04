@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

<div class="mdl-card" style="width: 100%;">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.provinces.title')</h2> 
    </div>

    <div class="mdl-card__supporting-text">

        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp {{ count($provinces) > 0 ? 'datatable' : '' }} @can('province_delete') dt-select @endcan"
               style="width: 50%; margin-left: 0;">
            <thead>
                <tr>
                    @can('province_delete')
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    @endcan

                    <th class="mdl-data-table__cell--non-numeric">@lang('global.provinces.fields.nome')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.provinces.fields.slug')</th>
                    <th class="mdl-data-table__cell--non-numeric"></th>

                </tr>
            </thead>

            <tbody>
                @if (count($provinces) > 0)
                @foreach ($provinces as $province)
                <tr data-entry-id="{{ $province->id }}">
                    @can('province_delete')
                    <td></td>
                    @endcan

                    <td field-key='nome'>{{ $province->nome }}</td>
                    <td field-key='slug'>{{ $province->slug }}</td>
                    <td>
                        @can('province_view')
                        <a href="{{ route('admin.provinces.show',[$province->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                        @endcan
                        @can('province_edit')
                        <a href="{{ route('admin.provinces.edit',[$province->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                        @endcan
                        @can('province_delete')
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.provinces.destroy', $province->id])) !!}
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
    <div class="mdl-card__actions">
        @can('province_create')   
        <a href="{{ route('admin.provinces.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>

        @endcan
    </div>
</div>

@stop

@section('javascript') 
<script>
    @can('province_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.provinces.mass_destroy') }}';
    @endcan

</script>
@endsection