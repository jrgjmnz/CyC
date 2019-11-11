<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Practicante">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        <!-- Plantilla -->
        <!-- Bootstrap core CSS-->
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Custom fonts for this template-->
        <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Page level plugin CSS-->
        <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ asset('assets/frontend/css/sb-admin.css') }}" rel="stylesheet">
        
        <!-- Css selectize selectpicker-->
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/normalize.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/selectize.default.css') }}" rel="stylesheet">
        
    </head>

    <body id="page-top">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark static-top">
            <a class="navbar-brand mr-1" href="{{ route('home') }}">Bienvenido</a>
            
            <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
                <i class="fas fa-bars"></i>
            </button>
            
            <!-- Navbar -->
            <ul class="navbar-nav form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    
                @else
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user-circle fa-fw"></i>
                            {{ Auth::user()->nombre }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                            </form>
                        </div>
                    </li>
                    
                @endguest
            </ul>
        </nav>

        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="sidebar navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-file-signature"></i>
                            <span>Contratos</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                            <a class="dropdown-item" href="{{ route('contratos.index') }}">Buscar</a>
                            <div class="dropdown-divider"></div> 
                            <a class="dropdown-item" href="{{ route('contratos.new') }}">Agregar</a>
                        </div>
                    </li>

               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-file-signature"></i>
                        <span>Órdenes de Compra</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item" href="{{ route('ordenCompra.index') }}">Buscar</a>
                        <div class="dropdown-divider"></div> 
                        <a class="dropdown-item" href="{{ route('ordenCompra.form') }}">Agregar</a>
                    </div>
                </li>


                @hasanyrole('SuperAdmin|Admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('convenios.index') }}">
                    <i class="fas fa-file-signature"></i>
                        <span>Convenios</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Alertas</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item" href="{{ route('alertaContrato.index') }}">Contratos</a>
                        <div class="dropdown-divider"></div> 
                        <a class="dropdown-item" href="{{ route('alertaConvenio.index') }}">Convenios</a>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="fas fa-fw fa-user-circle"></i>
                        <span>Usuarios</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Mantenedores</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item" href="{{ route('licitaciones.index')}}">Licitaciones</a>
                        <div class="dropdown-divider"></div>  
                        <a class="dropdown-item" href="{{ route('cargos.index') }}">Cargos</a>
                        <a class="dropdown-item" href="{{ route('monedas.index') }}">Monedas</a>
                        <div class="dropdown-divider"></div>    
                        <a class="dropdown-item" href="{{ route('prestaciones.index') }}">Prestaciones</a>
                        <a class="dropdown-item" href="{{ route('proveedores.index') }}">Proveedores</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-fw fa-book"></i>
                        <span>Reportes</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item" href="{{ route('creportes.index') }}">Contrato</a>
                        <div class="dropdown-divider"></div> 
                        <a class="dropdown-item" href="{{ route('cvreportes.index') }}">Convenio</a>
                    </div>
                </li>  
                @endrole
            </ul>
            <div id="content-wrapper">
                <div class="container-fluid">
                    <!-- Breadcrumbs-->
                    @if (session()->has('success'))
                        <div class="container col">
                            <div class="alert alert-success">{{ session('success') }}</div>
                        </div>
                        @endif
                    @if (session()->has('error'))
                        <div class="container col">
                            <div class="help-block text-danger">Error al guardar los datos</div>
                        </div>  
                    @endif

                    @yield('content')
                </div>
                <!-- /.container-fluid -->

                <!-- Sticky Footer -->
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright © Contratos y Convenios 2019</span>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- /.content-wrapper -->   
        </div>
        <!-- /#wrapper -->
        
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
                        
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-primary" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}    
                        </a>
                    </div>
                </div>
            </div>
        </div>

        
        <!--  Bootstrap core JavaScript -->
        <script src="{{ asset('assets/frontend/js/popper.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        
        <!-- Core plugin JavaScript -->
        <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!--   Custom scripts for all pages -->
        <script src="{{ asset('assets/frontend/js/sb-admin.min.js') }}"></script>
    </body>
</html>
