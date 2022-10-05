<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <link rel="icon" type="image/x-icon" href="{{url('images/icon/logo-hospital.ico')}}">
    <!-- Title Page-->
    <title>@yield('title')</title>
    <style>
        img#logo {
            max-width:150px;
            width: auto;
        }
    </style>
    @stack('css')
    <!-- Fontfaces CSS-->
    <link href="{{url ('css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{url ('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{url ('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{url ('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    
    <!-- Toastr CSS-->
    <link href="/js/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    <!-- Bootstrap CSS-->
    <link href="{{url ('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <!-- Vendor CSS-->
    <link href="{{url ('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{url ('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{url ('vendor/css-hamburgers/hamburgers.min.cs') }}" rel="stylesheet" media="all">
    <link href="{{url ('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{url ('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{url ('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{url ('css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body>
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img id="logo"src="{{url('images/icon/logo-hospital.png')}}" alt="HCMR" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{route('refectory_request.requestsOfDay')}}">
                                <i class="fas fa-utensils"></i>Atender Solicitações</a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow">
                            <i class="far fa-check-square"></i>Relatórios</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{route('refectory_reports.monthReports')}}">Fechamento Mensal</a>
                                </li>
                                <li>
                                    <a href="{{route('refectory_reports.requestsToDay')}}">Solicitações</a>
                                </li>
                                <li>
                                    <a href="{{route('refectory_reports.employeeReports')}}">Solicitações por funcionario</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('refectory_employee.index')}}">
                                <i class="fas  fa-users"></i>Funcionários</a>
                        </li>
                        <li>
                            <a href="{{route('users.index')}}">
                                <i class="fas fa-user"></i>Usuarios</a>
                        </li>
                        <li>
                            <a href="{{route('types.index')}}">
                                <i class="fas fa-coffee"></i>Tipos</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <div class="header-wrap">
                        <h4>Sistema de Gestão de Refeições</h4>
                           <div class="header-button">
                               <div class="account-wrap">
                                   <div class="account-item clearfix js-item-menu">
                                       <div class="image">
                                           <img src="{{url('images/icon/user.png')}}" alt="John Doe" />
                                       </div>
                                       <div class="content">
                                           <a class="js-acc-btn" href="#"><?php
                                            $names = explode(' ', Auth::user()->name);
                                            $twoNames = (isset($names[1])) ? $names[0]. ' ' .$names[1] : $names[0];
                                            echo $twoNames;
                                            ?></a>
                                       </div>
                                       <div class="account-dropdown js-dropdown">
                                           <div class="info clearfix">
                                               <div class="image">
                                                   <a href="#">
                                                       <img src="{{url('images/icon/user.png')}}" alt="John Doe" />
                                                   </a>
                                               </div>
                                               <div class="content">
                                                   <h5 class="name">
                                                       <a href="#">{{$twoNames}}</a>
                                                   </h5>
                                                   <span class="email">{{Auth::user()->email}}</span>
                                               </div>
                                           </div>
                                           <div class="account-dropdown__body">
                                               <div class="account-dropdown__item">
                                                   <a href="#">
                                                       <i class="zmdi zmdi-account"></i>Minha Conta</a>
                                               </div>
                                               <div class="account-dropdown__item">
                                                   <a href="{{route('refectory_config.index')}}">
                                                       <i class="zmdi zmdi-settings"></i>Configurações</a>
                                               </div>
                                           </div>
                                           <div class="account-dropdown__footer">
                                               <a href="#">
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <button type="submit"><i class="zmdi zmdi-power"></i></i>Logout</button>
                                                    </form>
                                                   </a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
                @yield('content')
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

</body>
    <!-- Jquery JS-->
    <script src="{{url ('vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{url('/js/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('/js/app.min.js')}}"></script>
    <script src="{{url('/js/app-style-switcher.js')}}"></script>
    <script src="{{url('/js/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{url('/js/extra-libs/sparkline/sparkline.js')}}"></script>
    <!-- Datatables -->
    <script src="{{url('/js/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="{{url('/js/pages/datatable/datatable-advanced.init.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{url('/js/feather.min.js')}}"></script>
    <script src="{{url('/js/custom.min.js')}}"></script>
    <script src="{{url('/js/extra-libs/jqbootstrapvalidation/validation.js')}}"></script>
    <!-- Toast mensages -->
    <script src="{{url('/js/extra-libs/toastr/dist/build/toastr.min.js')}}"></script>
    <script src="{{url('/js/extra-libs/toastr/toastr-init.js')}}"></script>
    <script src="{{url('/js/notification-toast.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{url ('vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{url ('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{url ('vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{url ('vendor/wow/wow.min.js') }}"></script>
    <script src="{{url ('vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{url ('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{url ('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{url ('vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{url ('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{url ('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{url ('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{url ('vendor/select2/select2.min.js') }}">
    </script>
    
    <script>
        

    </script>

    <!-- Main JS-->
    <script src="{{url ('js/main.js') }}"></script>
    @stack('scripts')

</html>
<!-- end document-->
