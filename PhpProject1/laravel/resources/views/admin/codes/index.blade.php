@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')


<div class="mdl-card">
    <div class="mdl-card__title mdl-card--border">
        <h2 class="mdl-card__title-text">@lang('global.codes.title')</h2>
    </div>
    <div class="mdl-card__supporting-text mdl-card--border">
        <div class="hidden-xs">
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp {{ count($codes) > 0 ? 'datatable' : '' }} @can('code_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('code_delete')
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th class="mdl-data-table__cell--non-numeric">@lang('global.codes.fields.code')</th>
                        <th class="mdl-data-table__cell--non-numeric">@lang('global.codes.fields.id-congress')</th>
                        <th class="mdl-data-table__cell--non-numeric">@lang('global.codes.fields.id-user')</th>
                        <th class="mdl-data-table__cell--non-numeric">@lang('global.codes.fields.sponsor')</th>
                        <th class="mdl-data-table__cell--non-numeric">&nbsp;</th>

                    </tr>
                </thead>

                <tbody>
                    @if (count($codes) > 0)
                    @foreach ($codes as $code)
                    <tr data-entry-id="{{ $code->id }}">
                        @can('code_delete')
                        <td></td>
                        @endcan

                        <td field-key='code'>{{ $code->code }}</td>
                        <td field-key='id_congress'>{{ $code->id_congress->nome ?? '' }}</td>
                        <td field-key='id_user'>{{ $code->id_user->name ?? '' }}</td>
                        <td>{{$code->sponsor->name ?? '' }}</td>
                        <td>
                            @can('code_view')
                            <a href="{{ route('admin.codes.show',[$code->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                            @endcan
                            @can('code_edit')
                            <a href="{{ route('admin.codes.edit',[$code->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                            @endcan
                            @can('code_delete')
                            {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.codes.destroy', $code->id])) !!}
                            {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                            {!! Form::close() !!}
                            @endcan
                        </td>

                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="visible-xs">
            <ul style="list-style: none; padding: 0 15px;">
                @if (count($codes) > 0)
                @foreach ($codes as $code)
                <li>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th >@lang('global.codes.fields.code')</th>
                            <td field-key='code'>{{ $code->code }}</td>
                        </tr>
                        <tr>
                            <th >@lang('global.codes.fields.id-congress')</th>
                            <td field-key='id_congress'>{{ $code->id_congress->nome ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.codes.fields.id-user')</th>
                            <td field-key='id_user'>{{ $code->id_user->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th >@lang('global.codes.fields.sponsor')</th>
                            <td>{{$code->sponsor->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th >&nbsp;</th>
                            <td>
                                @can('code_view')
                                <a href="{{ route('admin.codes.show',[$code->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                @endcan
                                @can('code_edit')
                                <a href="{{ route('admin.codes.edit',[$code->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                @endcan
                                @can('code_delete')
                                {!! Form::open(array(
                                'style' => 'display: inline-block;',
                                'method' => 'DELETE',
                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                'route' => ['admin.codes.destroy', $code->id])) !!}
                                {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    </table>

                </li>
                @endforeach
                @else
                <li>@lang('global.app_no_entries_in_table')</li>
                @endif
            </ul>
        </div>

    </div>
    <div class="mdl-card__actions">
        @can('code_create')
        <a href="{{ route('admin.codes.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        @endcan
    </div>
</div>
@stop

@section('javascript') 
<script>
    @can('code_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.codes.mass_destroy') }}';
    @endcan

</script>
@endsection