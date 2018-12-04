@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')


<div class="mdl-card" style="width: 100%;">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">@lang('global.hotels.title')</h2>
    </div>

    <div class="mdl-card__supporting-text">


        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp {{ count($hotels) > 0 ? 'datatable' : '' }} @can('hotel_delete') dt-select @endcan"
               style="width: 80%; margin-left: 0;">
            <thead>
                <tr>
                    @can('hotel_delete')
                    <th class="mdl-data-table__cell--non-numeric" style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    @endcan

                    <th class="mdl-data-table__cell--non-numeric">@lang('global.hotels.fields.nome')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.hotels.fields.indirizzo')</th>
                    <th class="mdl-data-table__cell--non-numeric">@lang('global.hotels.fields.citta')</th>
                    <th class="mdl-data-table__cell--non-numeric"></th>

                </tr>
            </thead>

            <tbody>
                @if (count($hotels) > 0)
                @foreach ($hotels as $hotel)
                <tr data-entry-id="{{ $hotel->id }}">
                    @can('hotel_delete')
                    <td></td>
                    @endcan

                    <td field-key='nome'>{{ $hotel->nome }}</td>
                    <td field-key='indirizzo'>{{ $hotel->indirizzo }}</td>
                    <td field-key='citta'>{{ $hotel->citta->name ?? '' }}</td>
                    <td>
                        @can('hotel_view')
                        <a href="{{ route('admin.hotels.show',[$hotel->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                        @endcan
                        @can('hotel_edit')
                        <a href="{{ route('admin.hotels.edit',[$hotel->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                        @endcan
                        @can('hotel_delete')
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                        'route' => ['admin.hotels.destroy', $hotel->id])) !!}
                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                        @endcan
                    </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="13">@lang('global.app_no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>


    </div>
    <div class="mdl-card__actions">
        @can('hotel_create')
        <a href="{{ route('admin.hotels.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>        
        @endcan
    </div>
</div>

@stop

@section('javascript') 
<script>
    @can('hotel_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.hotels.mass_destroy') }}';
    @endcan

</script>
@endsection