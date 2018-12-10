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
                height: 200px;  /* The height is 400 pixels */
                width: 100%;  /* The width is the width of the web page */
            }
        </style>
    </head>


    <body>

        <div class="mdl-layout__container">
            <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header has-drawer is-upgraded" data-upgraded=",MaterialLayout" >
              <!-- Content Wrapper. Contains page content -->
                <main class="mdl-layout__content mdl-color--grey-100">
                    <!-- Main content -->
                    <div class="mdl-grid page-content">
                       
                        @yield('content')                       

                    </div>
                </main>
                <div class="mdl-layout__obfuscator"></div>
            </div>
        </div>

        @include('partials.javascripts')
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>
    
</html>