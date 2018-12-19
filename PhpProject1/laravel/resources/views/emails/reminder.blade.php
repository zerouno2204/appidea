<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>
            {{ trans('global.global_title') }}
        </title>

        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0"
              name="viewport"/>
        <meta http-equiv="Content-type"
              content="text/html; charset=utf-8">

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link href="{{ url('adminlte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet"
              href="{{ url('adminlte/css') }}/select2.min.css"/>
        <link href="{{ url('adminlte/css/AdminLTE.min.css') }}" rel="stylesheet">
        <link href="{{ url('adminlte/css/custom.css') }}" rel="stylesheet">
        <!-- <link href="{{ url('adminlte/css/skins/skin-blue.min.css') }}" rel="stylesheet"> -->
        <link rel="stylesheet"
              href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet"
              href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
        <link rel="stylesheet"
              href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
        <link rel="stylesheet"
              href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>

        <link href="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"/>

        <link rel="stylesheet" href="/appidea/node_modules/material-design-lite/material.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="{{url('css/custom.css')}}">
        <link rel="stylesheet" href="{{url('css/material.min.css')}}">
        <link rel="stylesheet" href="{{url('mdl-template-dashboard/styles.css')}}">
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

                        <div class="mdl-card" style="background-color: #fff; text-align: center;">
                            <div class="mdl-card__title mdl-card--border">
                                <h2 class="mdl-card__title-text">Nuova Iscrizione</h2>
                            </div>
                            <div class="mdl-card__media">
                                <img src="{{asset('/img/1454431149.jpg')}}" alt=""/>
                            </div>
                            <div class="mdl-card__supporting-text" style=" text-align: left; ">
                                <div class="card">
                                    <div class="card-body">
                                        Iscrizione al congresso: {{ $registration->id_congress->nome }}
                                        che si terra dal {{$registration->id_congress->data_inizio}} al {{$registration->id_congress->data_fine}}
                                        <p style="text-transform: capitalize;">{{$registration->id_congress->ind_sede}}</p>
                                        <p style="text-transform: capitalize;">{{$registration->id_congress->id_citta_sede_id}}</p>

                                        <strong>Periodo Iscrizione </strong> {{ $registration->id_entry->data_inizio }} - {{ $registration->id_entry->data_fine }}
                                    </div>
                                </div>


                                <ul class="product-list list-group" style="padding-left: 0; list-style: none;">
                                    <li class="list-group-item"><strong>Nome </strong> {{ $registration->nome }}</li>
                                    <li class="list-group-item"><strong>Cognome </strong> {{ $registration->cognome }}</li>
                                    <li class="list-group-item"><strong>Congresso </strong> {{ $registration->id_congress->nome }}</li>
                                    <li class="list-group-item"><strong>Iscrizione </strong> {{ $registration->id_entry->nome }}</li>
                                    <li class="list-group-item"><strong>Hotel </strong> {{ $registration->id_hotel->nome }}</li>
                                    <li class="list-group-item"><strong>Camera </strong> {{ $registration->id_camera->descrizione }}</li>
                                    <li class="list-group-item"><strong>Totale </strong> {{ $registration->id_camera->prezzo }}€</li>
                                </ul>
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Note</h5>
                                        {!! $registration->note !!}
                                    </div>
                                </div>
                            </div>

                        </div>                      

                    </div>
                </main>
                <div class="mdl-layout__obfuscator"></div>
            </div>
        </div>

        <script>
            window.deleteButtonTrans = '{{ trans("global.app_delete_selected") }}';
            window.copyButtonTrans = '{{ trans("global.app_copy") }}';
            window.csvButtonTrans = '{{ trans("global.app_csv") }}';
            window.excelButtonTrans = '{{ trans("global.app_excel") }}';
            window.pdfButtonTrans = '{{ trans("global.app_pdf") }}';
            window.printButtonTrans = '{{ trans("global.app_print") }}';
            window.colvisButtonTrans = '{{ trans("global.app_colvis") }}';
        </script>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
        <script src="{{ url('adminlte/js') }}/bootstrap.min.js"></script>
        <script src="{{ url('adminlte/js') }}/select2.full.min.js"></script>
        <script src="{{ url('adminlte/js') }}/main.js"></script>

        <script src="{{ url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ url('adminlte/plugins/fastclick/fastclick.js') }}"></script>
        <script src="{{ url('adminlte/js/app.min.js') }}"></script>
        <script src="/appidea/node_modules/material-design-lite/material.min.js"></script>
        <script>
            window._token = '{{ csrf_token() }}';
        </script>
        <script>
            $.extend(true, $.fn.dataTable.defaults, {
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/{{ array_key_exists(app()->getLocale(), config('app.languages')) ? config('app.languages')[app()->getLocale()] : 'Italian' }}.json"
                }
            });



        </script>

        <script>
            $(function () {
                /** add active class and stay opened when selected */
                var url = window.location;

                // for sidebar menu entirely but not cover treeview
                $('ul.sidebar-menu a').filter(function () {
                    return this.href == url;
                }).parent().addClass('active');

                $('ul.treeview-menu a').filter(function () {
                    return this.href == url;
                }).parent().addClass('active');

                // for treeview
                $('ul.treeview-menu a').filter(function () {
                    return this.href == url;
                }).parentsUntil('.sidebar-menu > .treeview-menu').addClass('menu-open').css('display', 'block');
            });
        </script>

    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>

</html>