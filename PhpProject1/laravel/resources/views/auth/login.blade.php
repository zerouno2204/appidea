@extends('layouts.auth')

@section('content')
<style>
    .demo-card-wide.mdl-card {
        width: 100%;
    }
    .demo-card-wide > .mdl-card__title {
        color: #262626;
        /*height: 176px;*/
        background-color: #fff;
    }
    .demo-card-wide > .mdl-card__menu {
        color: #fff;
    }

    .is-focused{
        border-bottom-color: #ef5350;
    }
</style>

<div class="mdl-cell mdl-cell--4-col"></div>
<div class="mdl-cell mdl-cell--4-col">
    <div class="demo-card-wide mdl-card">
        <div class="mdl-card__title mdl-card--border">
            {{ ucfirst(config('app.name')) }} @lang('global.app_login')
        </div>

        <div class="mdl-card__supporting-text ">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>@lang('global.app_whoops')</strong> @lang('global.app_there_were_problems_with_input'):
                <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form role="form"
                  method="POST"
                  action="{{ url('login') }}">
                <input type="hidden"
                       name="_token"
                       value="{{ csrf_token() }}">

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <label class="mdl-textfield__label" for="email">@lang('global.app_email')</label>                    
                    <input type="email"                               
                           id="email"
                           class="mdl-textfield__input"
                           name="email"
                           value="{{ old('email') }}">
                </div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <label class="mdl-textfield__label" for="pass">@lang('global.app_password')</label>
                    <input type="password"
                           id="pass"
                           class="mdl-textfield__input"
                           name="password">
                </div>

                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                        <a href="{{ route('auth.password.reset') }}">@lang('global.app_forgot_password')</a>
                    
                        <label>
                            <input type="checkbox"
                                   name="remember"> @lang('global.app_remember_me')
                        </label>
                    </div>

                    <div class="mdl-cell mdl-cell--6-col">
                        <button type="submit"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" >
                            @lang('global.app_login')
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<div class="mdl-cell mdl-cell--4-col"></div>
@endsection