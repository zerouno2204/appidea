<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" />

        <style>
            ul#two-column {
                columns: 2;
                -webkit-columns: 2;
                -moz-columns: 2;
            }

            .mdl-menu__outline.mdl-menu--bottom-right {
                max-height: 300px;
            }
            ul.mdl-menu.mdl-menu--bottom-right.mdl-js-menu.mdl-js-ripple-effect.mdl-js-ripple-effect--ignore-events {
                max-height: 300px !important;
                overflow: auto;
            }
            .mdl-card{
                width: 100%;
            }
            .mdl-tabs__panel{
                padding-top: 20px;
            }
            #map {
                height: 400px;  /* The height is 400 pixels */
                width: 100%;  /* The width is the width of the web page */
            }
        </style>
    </head>


    <body>

        <div class="mdl-layout__container">
            <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header has-drawer is-upgraded" data-upgraded=",MaterialLayout" >
                @include('partials.topbar')
                @include('partials.sidebar')
                <!-- Content Wrapper. Contains page content -->
                <main class="mdl-layout__content mdl-color--grey-100">
                    <!-- Main content -->
                    <div class="mdl-grid page-content">
                        @if(isset($siteTitle))
                        <h3 class="page-title">
                            {{ $siteTitle }}
                        </h3>
                        @endif                       

                        @if (Session::has('message'))
                        <div class="alert alert-info">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                        @endif
                        @if ($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @yield('content')                       

                    </div>
                </main>
                <div class="mdl-layout__obfuscator"></div>
            </div>
        </div>

        {!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
        <button type="submit">Logout</button>
        {!! Form::close() !!}

        @include('partials.javascripts')
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>
    <script>
    $(document).ready(function () {
        $(".mdl-layout__drawer-button").click(function () {
            $(".mdl-layout__drawer").addClass('is-visible');
            $(".mdl-layout__obfuscator").addClass('is-visible');
        });
        $(".mdl-layout__obfuscator").click(function () {
            $(".mdl-layout__drawer").removeClass('is-visible');
            $(".mdl-layout__obfuscator").removeClass('is-visible');
        });
    });
    </script>
</html>