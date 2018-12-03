@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.images.title')</h3>
    @can('image_create')
    <p>
        <a href="{{ route('admin.images.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($images) > 0 ? 'datatable' : '' }} @can('image_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('image_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.images.fields.nome')</th>
                        <th>@lang('global.images.fields.path')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($images) > 0)
                        @foreach ($images as $image)
                            <tr data-entry-id="{{ $image->id }}">
                                @can('image_delete')
                                    <td></td>
                                @endcan

                                <td field-key='nome'>{{ $image->nome }}</td>
                                <td field-key='path'> @foreach($image->getMedia('path') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                                                                <td>
                                    @can('image_view')
                                    <a href="{{ route('admin.images.show',[$image->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('image_edit')
                                    <a href="{{ route('admin.images.edit',[$image->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('image_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.images.destroy', $image->id])) !!}
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
        @can('image_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.images.mass_destroy') }}';
        @endcan

    </script>
@endsection