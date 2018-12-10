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


    @if(Auth::user())
    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
        @include('partials.admin-nav')
    @else

        @include('partials.customer-nav')

    @endif
    @else
    <nav class="demo-navigation mdl-navigation mdl-color--white">
        <a class="mdl-navigation__link mdl-color-text--grey-900" href="{{url('/')}}">
            <i class="mdl-color-text--black material-icons" role="presentation">home</i>Home
        </a>
         <span class="mdl-navigation__link mdl-color-text--grey-900">
            <a class="mdl-color-text--grey-900" href="{{url('/login')}}">
                <i class="mdl-color-text--black material-icons">lock</i>  Login
            </a>
        </span>
    </nav>
    @endif
</div>

