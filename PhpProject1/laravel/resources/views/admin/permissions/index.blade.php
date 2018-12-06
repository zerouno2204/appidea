@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')


<div class="mdl-card mdl-card--border">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.permissions.title')</h2>
    </div>
    <div class="mdl-card__supporting-text mdl-card--border">
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp {{ count($permissions) > 0 ? 'datatable' : '' }} @can('permission_delete') dt-select @endcan">
            <thead>
                <tr>
                    @can('permission_delete')
                    <th class="mdl-data-table__cell--non-numeric" style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    @endcan
                    <th >@lang('global.permissions.fields.title')</th>
                    <th class="mdl-data-table__cell--non-numeric">&nbsp;</th>

                </tr>
            </thead>

            <tbody>
                @if (count($permissions) > 0)
                @foreach ($permissions as $permission)
                <tr data-entry-id="{{ $permission->id }}">
                    @can('permission_delete')
                    <td></td>
                    @endcan

                    <td field-key='title'>{{ $permission->title }}</td>
                    <td>
                        @can('permission_view')
                        <a href="{{ route('admin.permissions.show',[$permission->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                        @endcan
                        @can('permission_edit')
                        <a href="{{ route('admin.permissions.edit',[$permission->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                        @endcan
                        @can('permission_delete')
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.permissions.destroy', $permission->id])) !!}
                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                        @endcan
                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="mdl-card__actions">
        @can('permission_create')
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>        
        @endcan
    </div>
</div>
@stop

@section('javascript') 
<script>
    @can('permission_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.permissions.mass_destroy') }}';
    @endcan

</script>
@endsection