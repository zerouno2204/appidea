@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<div class="demo-drawer mdl-layout__drawer mdl-color--grey-600 mdl-color-text--grey-50">
    <header class="demo-drawer-header">
        @if(Auth::user())
        <img src="http://www.spazioeventicastiglione.com/wp-content/uploads/2018/11/icona_SPAZIO_EVENTI.png" class="demo-avatar">
        <div class="demo-avatar-dropdown">
            <span>{{Auth::user()->name}} {{Auth::user()->surname}}</span>
            <div class="mdl-layout-spacer"></div>

        </div>
        @else
        <img src="" class="demo-avatar">
        <div class="demo-avatar-dropdown">
            <span>App Idea</span>
            <div class="mdl-layout-spacer"></div>
        </div>
        @endif
    </header>
    <nav class="demo-navigation mdl-navigation mdl-color--white">
        <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{url('/')}}">
            <i class="mdl-color-text--black material-icons" role="presentation">home</i>Home
        </a>
        @if(Auth::user())
        <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{url('admin/calendar')}}">
            <i class="mdl-color-text--black material-icons" role="presentation">calendar_today</i>Calendario
        </a>
        @can('user_management_access')
        <span class="mdl-navigation__link mdl-color-text--grey-900" >
            <i class="mdl-color-text--black material-icons" role="presentation">people</i>@lang('global.user-management.title')
            <button id="demo-menu-lower-right"
                    class="mdl-button mdl-js-button mdl-button--icon">
                <i class="material-icons">keyboard_arrow_right</i>
            </button>  
        </span>         
        @endcan
        @can('city_access')           
        <span class="mdl-navigation__link mdl-color-text--grey-900" >
            <i class="mdl-color-text--black material-icons" >location_city</i>@lang('global.cities.title')
            <button id="menu-citta"
                    class="mdl-button mdl-js-button mdl-button--icon">
                <i class="material-icons">keyboard_arrow_right</i>
            </button>  
        </span>
        @endcan

        @can('code_access')
        <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{ route('admin.codes.index') }}">
            <i class="mdl-color-text--black material-icons" role="presentation">label</i>@lang('global.codes.title')
        </a>
        @endcan

        @can('user_management_access')
        <span class="mdl-navigation__link mdl-color-text--grey-900" >
            <i class="mdl-color-text--black material-icons" role="presentation">business</i>@lang('global.congress.title')
            <button id="menu-congress"
                    class="mdl-button mdl-js-button mdl-button--icon">
                <i class="material-icons">keyboard_arrow_right</i>
            </button>  
        </span>         
        @endcan

        @can('hotel_access')
        <span class="mdl-navigation__link mdl-color-text--grey-900" >
            <i class="mdl-color-text--black material-icons" role="presentation">hotel</i>@lang('global.hotels.title')
            <button id="menu-hotel"
                    class="mdl-button mdl-js-button mdl-button--icon">
                <i class="material-icons">keyboard_arrow_right</i>
            </button>  
        </span>         
        @endcan
        
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
        @if(empty(Auth::user()->id))
        <span class="mdl-navigation__link mdl-color-text--grey-900">
                <a class="mdl-color-text--grey-900" href="{{url('/login')}}">
                    <i class="mdl-color-text--black material-icons">lock</i>  Login
                </a>
        </span>
        @endif
    </nav>

    <!--- Menu User Panel --->

    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
        for="demo-menu-lower-right">
        @can('permission_access')
        <li class="mdl-menu__item">
            <a href="{{ route('admin.permissions.index') }}">
                <i class="fa fa-briefcase"></i>
                <span>@lang('global.permissions.title')</span>
            </a>
        </li>@endcan

        @can('role_access')
        <li class="mdl-menu__item mdl-navigation__link">
            <a href="{{ route('admin.roles.index') }}">
                <i class="fa fa-briefcase"></i>
                <span>@lang('global.roles.title')</span>
            </a>
        </li>@endcan

        @can('user_access')
        <li class="mdl-menu__item">
            <a href="{{ route('admin.users.index') }}">
                <i class="fa fa-user"></i>
                <span>@lang('global.users.title')</span>
            </a>
        </li>@endcan

        @can('user_action_access')
        <li class="mdl-menu__item">
            <a href="{{ route('admin.user_actions.index') }}">
                <i class="fa fa-th-list"></i>
                <span>@lang('global.user-actions.title')</span>
            </a>
        </li>@endcan
    </ul>

    <!--- Menu cities and provinces --->

    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="menu-citta">
        @can('province_access')
        <li class="mdl-menu__item">
            <a href="{{ route('admin.provinces.index') }}">
                <i class="fa fa-gears"></i>
                <span>@lang('global.provinces.title')</span>
            </a>
        </li>
        @endcan
        @can('city_access')
        <li class="mdl-menu__item">
            <a href="{{ route('admin.cities.index') }}">
                <i class="fa fa-gears"></i>
                <span>@lang('global.cities.title')</span>
            </a>
        </li>
        @endcan
    </ul>

    <!-- Menu congress --->

    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="menu-congress">
        @can('congress_access')
        <li class="mdl-menu__item">
            <a href="{{ route('admin.congresses.index') }}">
                <i class="fa fa-gears"></i>
                <span>@lang('global.congress.title')</span>
            </a>
        </li>
        @endcan        
        @can('speaker_access')
            <li class="mdl-menu__item">
                <a href="{{ route('admin.speakers.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.speakers.title')</span>
                </a>
            </li>
            @endcan

        @can('entry_access')
        <li class="mdl-menu__item">
            <a href="{{ route('admin.entries.index') }}">
                <i class="fa fa-tags"></i>
                <span>@lang('global.entry.title')</span>
            </a>
        </li>
        @endcan

        @can('registration_access')
        <li class="mdl-menu__item">
            <a href="{{ route('admin.registrations.index') }}">
                <i class="fa fa-tags"></i>
                <span>@lang('global.registrations.title')</span>
            </a>
        </li>
        @endcan
        @can('day_access')
            <li class="mdl-menu__item">
                <a href="{{ route('admin.days.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.day.title')</span>
                </a>
            </li>@endcan
            
            @can('hall_access')
            <li class="mdl-menu__item">
                <a href="{{ route('admin.halls.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.hall.title')</span>
                </a>
            </li>@endcan
            
            @can('event_access')
            <li class="mdl-menu__item">
                <a href="{{ route('admin.events.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.event.title')</span>
                </a>
            </li>@endcan
    </ul>

    <!--- Menu Hotel and Rooms --->

    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="menu-hotel">
        @can('hotel_access')
        <li class="mdl-menu__item">
            <a href="{{ route('admin.hotels.index') }}">
                <i class="fa fa-gears"></i>
                <span>@lang('global.hotels.title')</span>
            </a>
        </li>
        @endcan
        @can('room_access')
        <li class="mdl-menu__item">
            <a href="{{ route('admin.rooms.index') }}">
                <i class="fa fa-gears"></i>
                <span>@lang('global.rooms.title')</span>
            </a>
        </li>
        @endcan
    </ul>
    
    <!-- FAQ system --->
    
    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="menu-faq">
                    @can('faq_category_access')
                    <li class="mdl-menu__item">
                        <a href="{{ route('admin.faq_categories.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.faq-categories.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('faq_question_access')
                    <li class="mdl-menu__item">
                        <a href="{{ route('admin.faq_questions.index') }}">
                            <i class="fa fa-question"></i>
                            <span>@lang('global.faq-questions.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>

</div>

