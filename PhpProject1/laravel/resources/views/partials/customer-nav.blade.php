<nav class="demo-navigation mdl-navigation mdl-color--white">
    <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{url('/')}}">
        <i class="mdl-color-text--black material-icons" role="presentation">home</i>Home
    </a>
    @if(Auth::user())
    <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{url('admin/calendar')}}">
        <i class="mdl-color-text--black material-icons" role="presentation">calendar_today</i>Calendario
    </a>

    <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{ url('admin/customer-registration-index') }}">
        <i class="mdl-color-text--black material-icons">verified_user</i>@lang('global.registrations.title')
    </a>


    <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{url('/admin/customer-index-congress')}}">
        <i class="mdl-color-text--black material-icons" role="presentation">business</i>
        @lang('global.congress.title')
    </a>

    @if(isset($congress))   
        @if(isset($congress->id))
        <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{url('/admin/congress-program/'.$congress->id)}}">
            <i class="mdl-color-text--black material-icons" role="presentation">assignment</i>
            Programma
        </a>
        
        <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{url('/admin/speaker-congress/'.$congress->id)}}">
            <i class="mdl-color-text--black material-icons" role="presentation">people</i>
            @lang('global.speakers.title')
        </a>
       
        <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{url('/admin/congress-hotels/'.$congress->id)}}">
            <i class="mdl-color-text--black material-icons" role="presentation">hotel</i>@lang('global.hotels.title')
        </a> 
        @endif
    @endif

    @can('faq_management_access')
    <span class="mdl-navigation__link mdl-color-text--grey-900" >
        <i class="mdl-color-text--black material-icons" role="presentation">question_answer</i>@lang('global.faq-management.title')
        <button id="menu-faq"
                class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">keyboard_arrow_right</i>
        </button>  
    </span>  
    @endcan

    @php ($unread = App\MessengerTopic::countUnread())
    <span class="mdl-navigation__link mdl-color-text--grey-900 {{ $request->segment(2) == 'messenger' ? 'active' : '' }} {{ ($unread > 0 ? 'unread' : '') }}">
        <a class="mdl-color-text--grey-900" href="{{ route('admin.messenger.index') }}">
            <i class="mdl-color-text--black material-icons">message</i>Messages
            @if($unread > 0)
            {{ ($unread > 0 ? '('.$unread.')' : '') }}
            @endif
        </a>
    </span>
    <style>
        .page-sidebar-menu .unread * {
            font-weight:bold !important;
        }
    </style>

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