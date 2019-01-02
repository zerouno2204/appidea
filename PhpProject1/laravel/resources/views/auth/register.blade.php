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
            {{ __('Registrati') }}
        </div>
            <div class="mdl-card__supporting-text ">
                
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                
            </div>
    </div>
</div>
<div class="mdl-cell mdl-cell--4-col"></div>
@endsection
