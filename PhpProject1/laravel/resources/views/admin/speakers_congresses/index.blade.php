@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.speakers-congress.title')</h3>
    @can('speakers_congress_create')
    <p>
        <a href="{{ route('admin.speakers_congresses.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($speakers_congresses) > 0 ? 'datatable' : '' }} @can('speakers_congress_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('speakers_congress_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.speakers-congress.fields.id-congress')</th>
                        <th>@lang('global.speakers-congress.fields.id-speaker')</th>
                        <th>@lang('global.speakers.fields.cognome')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($speakers_congresses) > 0)
                        @foreach ($speakers_congresses as $speakers_congress)
                            <tr data-entry-id="{{ $speakers_congress->id }}">
                                @can('speakers_congress_delete')
                                    <td></td>
                                @endcan

                                <td field-key='id_congress'>{{ $speakers_congress->id_congress->nome ?? '' }}</td>
                                <td field-key='id_speaker'>{{ $speakers_congress->id_speaker->nome ?? '' }}</td>
<td field-key='cognome'>{{ isset($speakers_congress->id_speaker) ? $speakers_congress->id_speaker->cognome : '' }}</td>
                                                                <td>
                                    @can('speakers_congress_view')
                                    <a href="{{ route('admin.speakers_congresses.show',[$speakers_congress->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('speakers_congress_edit')
                                    <a href="{{ route('admin.speakers_congresses.edit',[$speakers_congress->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('speakers_congress_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.speakers_congresses.destroy', $speakers_congress->id])) !!}
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
        @can('speakers_congress_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.speakers_congresses.mass_destroy') }}';
        @endcan

    </script>
@endsection