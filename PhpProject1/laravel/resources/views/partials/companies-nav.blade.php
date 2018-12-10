<nav class="demo-navigation mdl-navigation mdl-color--white">
    <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{url('/')}}">
        <i class="mdl-color-text--black material-icons" role="presentation">home</i>Home
    </a>
    @if(Auth::user())
    <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{url('admin/calendar')}}">
        <i class="mdl-color-text--black material-icons" role="presentation">calendar_today</i>Calendario
    </a>

    <span class="mdl-navigation__link mdl-color-text--grey-900" >
        <a href="{{ url('admin/customer-registration-index') }}">
            <i class="fa fa-tags"></i>
            <span>@lang('global.registrations.title')</span>
        </a>
    </span>

    
    <span class="mdl-navigation__link mdl-color-text--grey-900" >
        <a href="{{ url('/admin/customer-index-congress') }}">
            <i class="mdl-color-text--black material-icons" role="presentation">business</i>
            @lang('global.congress.title')
        </a>
    </span>    

    
    <div class="mdl-layout-spacer"></div>
    <span class="mdl-navigation__link mdl-color-text--grey-900 {{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
        <i class="mdl-color-text--black material-icons">vpn_key</i>
        <a class="mdl-color-text--grey-900" href="{{ route('auth.change_password') }}">
            @lang('global.app_change_password')
        </a>
    </span>

    <span class="mdl-navigation__link mdl-color-text--grey-900">
        <a class="mdl-color-text--grey-900" href="#logout" onclick="$('#logout').submit();">
            <i class="mdl-color-text--black material-icons">exit_to_app</i>  @lang('global.app_logout')
        </a>
    </span>
    @endif
</nav>

<!-- FAQ system --->

<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="menu-faq">

    @can('faq_question_access')
    <li class="mdl-menu__item">
        <a href="{{ route('admin.faq_questions.index') }}">
            <i class="fa fa-question"></i>
            <span>@lang('global.faq-questions.title')</span>
        </a>
    </li>@endcan

</ul>