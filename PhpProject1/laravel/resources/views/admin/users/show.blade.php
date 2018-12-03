@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.role')</th>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#user_actions" aria-controls="user_actions" role="tab" data-toggle="tab">User actions</a></li>
<li role="presentation" class=""><a href="#codes" aria-controls="codes" role="tab" data-toggle="tab">Codes</a></li>
<li role="presentation" class=""><a href="#registrations" aria-controls="registrations" role="tab" data-toggle="tab">Registrations</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="user_actions">
<table class="table table-bordered table-striped {{ count($user_actions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.user-actions.created_at')</th>
                        <th>@lang('global.user-actions.fields.user')</th>
                        <th>@lang('global.user-actions.fields.action')</th>
                        <th>@lang('global.user-actions.fields.action-model')</th>
                        <th>@lang('global.user-actions.fields.action-id')</th>
                        
        </tr>
    </thead>

    <tbody>
        @if (count($user_actions) > 0)
            @foreach ($user_actions as $user_action)
                <tr data-entry-id="{{ $user_action->id }}">
                    <td>{{ $user_action->created_at ?? '' }}</td>
                                <td field-key='user'>{{ $user_action->user->name ?? '' }}</td>
                                <td field-key='action'>{{ $user_action->action }}</td>
                                <td field-key='action_model'>{{ $user_action->action_model }}</td>
                                <td field-key='action_id'>{{ $user_action->action_id }}</td>
                                
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
<div role="tabpanel" class="tab-pane " id="codes">
<table class="table table-bordered table-striped {{ count($codes) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.codes.fields.code')</th>
                        <th>@lang('global.codes.fields.qrcode')</th>
                        <th>@lang('global.codes.fields.id-congress')</th>
                        <th>@lang('global.codes.fields.id-user')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($codes) > 0)
            @foreach ($codes as $code)
                <tr data-entry-id="{{ $code->id }}">
                    <td field-key='code'>{{ $code->code }}</td>
                                <td field-key='qrcode'>{{ $code->qrcode }}</td>
                                <td field-key='id_congress'>{{ $code->id_congress->nome ?? '' }}</td>
                                <td field-key='id_user'>{{ $code->id_user->name ?? '' }}</td>
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
<div role="tabpanel" class="tab-pane " id="registrations">
<table class="table table-bordered table-striped {{ count($registrations) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.registrations.fields.nome-documento')</th>
                        <th>@lang('global.registrations.fields.luogo-rilascio')</th>
                        <th>@lang('global.registrations.fields.data-emissione')</th>
                        <th>@lang('global.registrations.fields.data-scadenza')</th>
                        <th>@lang('global.registrations.fields.id-tipo-doc')</th>
                        <th>@lang('global.registrations.fields.path-img-doc')</th>
                        <th>@lang('global.registrations.fields.note')</th>
                        <th>@lang('global.registrations.fields.registrationscol')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($registrations) > 0)
            @foreach ($registrations as $registration)
                <tr data-entry-id="{{ $registration->id }}">
                    <td field-key='nome_documento'>{{ $registration->nome_documento }}</td>
                                <td field-key='luogo_rilascio'>{{ $registration->luogo_rilascio }}</td>
                                <td field-key='data_emissione'>{{ $registration->data_emissione }}</td>
                                <td field-key='data_scadenza'>{{ $registration->data_scadenza }}</td>
                                <td field-key='id_tipo_doc'>{{ $registration->id_tipo_doc }}</td>
                                <td field-key='path_img_doc'>{{ $registration->path_img_doc }}</td>
                                <td field-key='note'>{{ $registration->note }}</td>
                                <td field-key='registrationscol'>{{ $registration->registrationscol }}</td>
                                                                <td>
                                    @can('registration_view')
                                    <a href="{{ route('admin.registrations.show',[$registration->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('registration_edit')
                                    <a href="{{ route('admin.registrations.edit',[$registration->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('registration_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.registrations.destroy', $registration->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="19">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


