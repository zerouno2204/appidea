@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            <li>
                <a href="{{url('admin/calendar')}}">
                  <i class="fa fa-calendar"></i>
                  <span class="title">
                    Calendar
                  </span>
                </a>
            </li>
        
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.permissions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('global.users.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_action_access')
                    <li>
                        <a href="{{ route('admin.user_actions.index') }}">
                            <i class="fa fa-th-list"></i>
                            <span>@lang('global.user-actions.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>
            @endcan
            
            @can('city_access')
            <li>
                <a href="{{ route('admin.cities.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.cities.title')</span>
                </a>
            </li>@endcan
            
            @can('code_access')
            <li>
                <a href="{{ route('admin.codes.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.codes.title')</span>
                </a>
            </li>@endcan
            
            @can('congress_access')
            <li>
                <a href="{{ route('admin.congresses.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.congress.title')</span>
                </a>
            </li>@endcan
            
            @can('congress_entry_access')
            <li>
                <a href="{{ route('admin.congress_entries.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.congress-entries.title')</span>
                </a>
            </li>@endcan
            
            @can('congress_hotel_access')
            <li>
                <a href="{{ route('admin.congress_hotels.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.congress-hotel.title')</span>
                </a>
            </li>@endcan
            
            @can('document_type_access')
            <li>
                <a href="{{ route('admin.document_types.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.document-type.title')</span>
                </a>
            </li>@endcan
            
            @can('entry_access')
            <li>
                <a href="{{ route('admin.entries.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.entry.title')</span>
                </a>
            </li>
            @endcan
            
            @can('hotel_access')
            <li>
                <a href="{{ route('admin.hotels.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.hotels.title')</span>
                </a>
            </li>
            @endcan
            
            @can('image_access')
            <li>
                <a href="{{ route('admin.images.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.images.title')</span>
                </a>
            </li>@endcan
            
            @can('images_hotel_access')
            <li>
                <a href="{{ route('admin.images_hotels.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.images-hotel.title')</span>
                </a>
            </li>@endcan
            
            @can('province_access')
            <li>
                <a href="{{ route('admin.provinces.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.provinces.title')</span>
                </a>
            </li>@endcan
            
            @can('registration_access')
            <li>
                <a href="{{ route('admin.registrations.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.registrations.title')</span>
                </a>
            </li>@endcan
            
            @can('room_access')
            <li>
                <a href="{{ route('admin.rooms.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.rooms.title')</span>
                </a>
            </li>@endcan
            
            @can('speaker_access')
            <li>
                <a href="{{ route('admin.speakers.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.speakers.title')</span>
                </a>
            </li>@endcan
            
            @can('speakers_congress_access')
            <li>
                <a href="{{ route('admin.speakers_congresses.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.speakers-congress.title')</span>
                </a>
            </li>@endcan
            
            @can('faq_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-question"></i>
                    <span>@lang('global.faq-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('faq_category_access')
                    <li>
                        <a href="{{ route('admin.faq_categories.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.faq-categories.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('faq_question_access')
                    <li>
                        <a href="{{ route('admin.faq_questions.index') }}">
                            <i class="fa fa-question"></i>
                            <span>@lang('global.faq-questions.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('day_access')
            <li>
                <a href="{{ route('admin.days.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.day.title')</span>
                </a>
            </li>@endcan
            
            @can('hall_access')
            <li>
                <a href="{{ route('admin.halls.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.hall.title')</span>
                </a>
            </li>@endcan
            
            @can('event_access')
            <li>
                <a href="{{ route('admin.events.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.event.title')</span>
                </a>
            </li>@endcan
            

            

            
            @php ($unread = App\MessengerTopic::countUnread())
            <li class="{{ $request->segment(2) == 'messenger' ? 'active' : '' }} {{ ($unread > 0 ? 'unread' : '') }}">
                <a href="{{ route('admin.messenger.index') }}">
                    <i class="fa fa-envelope"></i>

                    <span>Messages</span>
                    @if($unread > 0)
                        {{ ($unread > 0 ? '('.$unread.')' : '') }}
                    @endif
                </a>
            </li>
            <style>
                .page-sidebar-menu .unread * {
                    font-weight:bold !important;
                }
            </style>



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

