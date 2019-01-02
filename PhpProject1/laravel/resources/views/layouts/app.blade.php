<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.head')
        <style>
            ul#two-column {
                columns: 2;
                -webkit-columns: 2;
                -moz-columns: 2;
            }
            #map{
                height: 300px;
            }
            .mdl-card{
                width: 100% !important;
            }
            .mdl-card__title{
                font-size: 16pt; 
                max-height: 65px;
                overflow: hidden;
                height: 65px;
            }
            .mdl-menu__outline.mdl-menu--bottom-right {
                max-height: 300px;
            }
            ul.mdl-menu.mdl-menu--bottom-right.mdl-js-menu.mdl-js-ripple-effect.mdl-js-ripple-effect--ignore-events {
                max-height: 300px !important;
                overflow: auto;
            }
            .mdl-color--indigo-300 {
                background-color: #706eb3 !important;
            }
            .mdl-color--purple-300 {
                background-color: #b91c84 !important;
            }
            h1, h2 {
                font-family: "Roboto","Helvetica","Arial",sans-serif !important;
                font-weight: 300 !important;
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