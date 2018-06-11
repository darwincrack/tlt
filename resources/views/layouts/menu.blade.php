<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header ">

                <div class=" profile-element">
                    <a href="{{ url('/') }}" alt="Ir a Inicio">
                        <h1 class="text-uppercase">

        @if (Session::has('prioridad')) 

            @if (Session::get('prioridad')==1) 
             {{Session::get('nombre_corto_sistema')}} 

            @elseif (Session::get('prioridad')==2) 
                <img alt="image"  src="{{ URL::asset('assets/img/'.Session::get('logo')) }}" height="56px">
            @endif

        @endif
                        </h1>

                    </a>
                </div>
                <div class="logo-element">
                    @if (Session::has('nombre_corto_sistema')) 
                           {{Session::get('nombre_corto_sistema')}} 
                    @endif       

                </div>
            </li>


     
    @role(['admin','informatica']) 
            <li class=" @if (Route::getCurrentRoute()->getPath() == 'usuarios/users')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'usuarios/roles')
                    active

                @endif ">

                <a href="index.html"><i class="fa fa-user" aria-hidden="true"></i> <span class="nav-label">Usuarios de sistema</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'usuarios/users') ? 'active' : '' }}"><a href="{{ url('/usuarios/users') }}" >Usuarios</a></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'usuarios/roles') ? 'active' : '' }}"><a href="{{ url('/usuarios/roles') }}"  >Roles</a></li>

                </ul>
            </li>
        @endrole

    @role(['admin','inventario']) 
           <li class=" @if (Route::getCurrentRoute()->getPath() == 'ubicacion')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'ubicacion/add')
                    active
                @endif ">
                <a href="{{ url('ubicacion') }}"><i class="fa fa-globe" aria-hidden="true"></i> <span class="nav-label">Ubicaciones</span></a>

            </li>
    @endrole  

    @role(['admin','inventario']) 
           <li class=" @if (Route::getCurrentRoute()->getPath() == 'articulos')
                    active
                @endif ">
                <a href="{{ url('articulos') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="nav-label">Articulos</span> </a>

            </li>
    @endrole 
 
     @role(['admin','inventario','informatica']) 
           <li class=" @if (Route::getCurrentRoute()->getPath() == 'solicitudesarticulos')
                    active

                @endif ">
                <a href="{{ url('solicitudesarticulos') }}"><i class="fa fa-desktop" aria-hidden="true"></i> <span class="nav-label">Solicitudes Artículos</a>

            </li>
    @endrole  


        @role(['admin','inventario']) 
            <li class=" @if (Route::getCurrentRoute()->getPath() == 'personal')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'personal/add')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'departamento')
                    active   
                     @elseif (Route::getCurrentRoute()->getPath() == 'departamento/add')
                    active 
                 @elseif (Route::getCurrentRoute()->getPath() == 'cargo')
                    active 
                @elseif (Route::getCurrentRoute()->getPath() == 'cargo/add')
                    active 
                @endif ">
                <a href="index.html"><i class="fa fa-users" aria-hidden="true"></i> <span class="nav-label">Personal</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'personal') ? 'active' : '' }}"><a href="{{ url('personal') }}"><a href="{{ url('/personal') }}">Lista de Personal</a></li>

                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'departamento') ? 'active' : '' }}"><a href="{{ url('departamento') }}"><a href="{{ url('/departamento') }}">Departamentos</a></li> 


                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'cargo') ? 'active' : '' }}"><a href="{{ url('cargo') }}"><a href="{{ url('/cargo') }}">Cargos</a></li>
                   

                </ul>
            </li>
        @endrole 
 






            @role(['admin','informatica'])
            <li class=" @if (Route::getCurrentRoute()->getPath() == 'configuracion')
                    active
                @endif ">
                <a href="{{ url('configuracion') }}"><i class="fa fa-university" aria-hidden="true"></i> <span class="nav-label">Configuraci&oacute;n</span></a>

            </li>
            @endrole


    @role(['admin','inventario','seguridad','informatica']) 
           <li class=" @if (Route::getCurrentRoute()->getPath() == 'notificaciones')
                    active
                @endif ">
                <a href="{{ url('notificaciones') }}"><i class="fa fa-bell" aria-hidden="true"></i> <span class="nav-label">notificaciones</span> </a>

            </li>
    @endrole 




@role(['admin','seguridad'])
            <li class=" @if (Route::getCurrentRoute()->getPath() == 'logsistema')
                    active
                @endif ">
                <a href="{{ url('logsistema') }}"><i class="fa fa-building-o" aria-hidden="true"></i> <span class="nav-label">Log del sistema</span></a>
            </li>
@endrole










<!--

@role(['admin','seguridad'])
            <li class=" @if (Route::getCurrentRoute()->getPath() == 'reportes')
                    active
                    @elseif (Route::getCurrentRoute()->getPath() == 'reportes/justificativos')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-university" aria-hidden="true"></i> <span class="nav-label">Seguridad</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'reportes') ? 'active' : '' }}"><a href="{{ url('reportes') }}"><a href="{{ url('/reportes') }}">General</a></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'reportes/justificativos') ? 'active' : '' }}"><a href="{{ url('reportes/justificativos') }}"><a href="{{ url('/reportes/justificativos') }}">Justificativos</a></li>

                </ul>
            </li>
 @endrole





-->













        </ul>

    </div>
</nav>