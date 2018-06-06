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
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'usuarios/users') ? 'active' : '' }}"><a href="{{ url('/usuarios/users') }}" >Listar</a></li>
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
                <a href="index.html"><i class="fa fa-globe" aria-hidden="true"></i> <span class="nav-label">Ubicaciones</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'ubicacion') ? 'active' : '' }}"><a href="{{ url('ubicacion') }}"><a href="{{ url('/ubicacion') }}">Lista</a></li>
                  
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'ubicacion/add') ? 'active' : '' }}"><a href="{{ url('ubicacion/add') }}"><a href="{{ url('/ubicacion/add') }}">Agregar</a></li>
                
                </ul>
            </li>
    @endrole  

    @role(['admin','inventario']) 
           <li class=" @if (Route::getCurrentRoute()->getPath() == 'articulos')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'articulos/add')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="nav-label">Articulos</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'articulos') ? 'active' : '' }}"><a href="{{ url('articulos') }}"><a href="{{ url('/articulos') }}">Lista</a></li>
                  
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'articulos/add') ? 'active' : '' }}"><a href="{{ url('articulos/add') }}"><a href="{{ url('/articulos/add') }}">Agregar</a></li>
                
                </ul>
            </li>
    @endrole 

        @role(['admin','inventario']) 
          <li class=" @if (Route::getCurrentRoute()->getPath() == 'cargo')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'cargo/add')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-briefcase" aria-hidden="true"></i> <span class="nav-label">Cargos</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'cargo') ? 'active' : '' }}"><a href="{{ url('cargo') }}"><a href="{{ url('/cargo') }}">Lista</a></li>
       
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'cargo/add') ? 'active' : '' }}"><a href="{{ url('cargo/add') }}"><a href="{{ url('/cargo/add') }}">Agregar</a></li>
     
                </ul>
            </li>
        @endrole  




 @role(['admin','inventario']) 
          <li class=" @if (Route::getCurrentRoute()->getPath() == 'departamento')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'departamento/add')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-building-o" aria-hidden="true"></i> <span class="nav-label">Departamentos</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'departamento') ? 'active' : '' }}"><a href="{{ url('cargo') }}"><a href="{{ url('/departamento') }}">Lista</a></li>       
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'departamento/add') ? 'active' : '' }}"><a href="{{ url('departamento/add') }}"><a href="{{ url('/departamento/add') }}">Agregar</a></li>      
                </ul>
            </li>
       @endrole 


        @role(['admin','inventario']) 
            <li class=" @if (Route::getCurrentRoute()->getPath() == 'personal')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'personal/add')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-users" aria-hidden="true"></i> <span class="nav-label">Personal</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'personal') ? 'active' : '' }}"><a href="{{ url('personal') }}"><a href="{{ url('/personal') }}">Listar</a></li>
                   

                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'personal/add') ? 'active' : '' }}"><a href="{{ url('personal/add') }}"><a href="{{ url('/personal/add') }}">Agregar</a></li>

                </ul>
            </li>
        @endrole 
 






            @role(['admin','informatica'])
            <li class=" @if (Route::getCurrentRoute()->getPath() == 'configuracion')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'configuracion/general')
                    active
                    @elseif (Route::getCurrentRoute()->getPath() == 'configuracion/diasferiados')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-university" aria-hidden="true"></i> <span class="nav-label">Configuraci&oacute;n</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'configuracion') ? 'active' : '' }}"><a href="{{ url('configuracion') }}"><a href="{{ url('/configuracion') }}">General</a></li>


                </ul>
            </li>
            @endrole



@role(['admin','seguridad'])
            <li class=" @if (Route::getCurrentRoute()->getPath() == 'logsistema')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-building-o" aria-hidden="true"></i> <span class="nav-label">Log del sistema</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'logsistema') ? 'active' : '' }}"><a href="{{ url('logsistema') }}"><a href="{{ url('/logsistema') }}">Listar</a></li>

                </ul>
            </li>
@endrole



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



            <li class=" @if (Route::getCurrentRoute()->getPath() == 'reportes')
                    active
                    @elseif (Route::getCurrentRoute()->getPath() == 'reportes/justificativos')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-university" aria-hidden="true"></i> <span class="nav-label">Reportes no</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'reportes') ? 'active' : '' }}"><a href="{{ url('reportes') }}"><a href="{{ url('/reportes') }}">General</a></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'reportes/justificativos') ? 'active' : '' }}"><a href="{{ url('reportes/justificativos') }}"><a href="{{ url('/reportes/justificativos') }}">Justificativos</a></li>

                </ul>
            </li>




            <li class=" @if (Route::getCurrentRoute()->getPath() == 'tiposjustificacion')
                    active
                 @elseif (Route::getCurrentRoute()->getPath() == 'tiposjustificacion/add')
                    active
                @endif ">
                <a href="index.html"><i class="fa fa-building-o" aria-hidden="true"></i> <span class="nav-label">Tipos de Justificaci&oacute;n no</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li></li>
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'tiposjustificacion') ? 'active' : '' }}"><a href="{{ url('tiposjustificacion') }}"><a href="{{ url('/tiposjustificacion') }}">Listar</a></li>
            @role(['admin','operador'])        
                    <li class="{{ (Route::getCurrentRoute()->getPath() == 'tiposjustificacion/add') ? 'active' : '' }}"><a href="{{ url('tiposjustificacion/add') }}"><a href="{{ url('/tiposjustificacion/add') }}">Agregar</a></li>
            @endrole       
                </ul>
            </li>












        </ul>

    </div>
</nav>