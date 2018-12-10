<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.head')
    </head>

    <body>

        <div class="mdl-layout__container mdl-color--grey-200">
            <div class="mdl-grid page-content">
                @yield('content')
            </div>
        </div>

        <div class="scroll-to-top"
             style="display: none;">
            <i class="fa fa-arrow-up"></i>
        </div>

        @include('partials.javascripts')

    </body>
</html>