@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')


<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.roles.title')</h2>
    </div>
    <div class="mdl-card__supporting-text" >
        <table style="max-width: 50%; margin-left: 0;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp {{ count($roles) > 0 ? 'datatable' : '' }} @can('role_delete') dt-select @endcan">
            <thead>
                <tr>
                    @can('role_delete')
                    <th class="mdl-data-table__cell--non-numeric" style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    @endcan

                    <th class="mdl-data-table__cell--non-numeric">@lang('global.roles.fields.title')</th>                        
                    <th class="mdl-data-table__cell--non-numeric">&nbsp;</th>

                </tr>
            </thead>

            <tbody>
                @if (count($roles) > 0)
                @foreach ($roles as $role)
                <tr data-entry-id="{{ $role->id }}">
                    @can('role_delete')
                    <td></td>
                    @endcan
                    <td field-key='title'>{{ $role->title }}</td>                                
                    <td>
                        @can('role_view')
                        <a href="{{ route('admin.roles.show',[$role->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                        @endcan
                        @can('role_edit')
                        <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                        @endcan
                        @can('role_delete')
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.roles.destroy', $role->id])) !!}
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
        @can('role_create')
        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        @endcan
    </div>
</div>
@stop

@section('javascript') 
<script>
    @can('role_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.roles.mass_destroy') }}';
    @endcan

</script>
@endsection