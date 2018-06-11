<nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
<input type="hidden" value="{{URL::to('/')}}" id="url_base"> 

    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li>
            <span class="m-r-sm text-muted welcome-message">Bienvenido, {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</span>
        </li>


 <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary" id="count_notificaciones"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages" id="lista_notificaciones">
                        <!--<li>
                            <a href="mailbox.html" class="mensaje" data-mensaje="1">
                                <div class="dropdown-messages-box">
                                    
                                    <div class="media-body">
                                        Solicitud para editar o eliminar un Artículo. <br>
                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="mailbox.html">
                                <div class="dropdown-messages-box">
                                    
                                    <div class="media-body">
                                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="mailbox.html">
                                <div class="dropdown-messages-box">
                                    
                                    <div class="media-body">
                                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                       <!-- <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="{{ url('notificaciones') }}">
                                    <i class="fa fa-envelope"></i> <strong>Ver todos los mensajes</strong>
                                </a>
                            </div>
                        </li>-->
                    </ul>
                </li>



        <li>
            <a href="{{ url('/logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i>  Logout
            </a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>


        </li>
    </ul>

</nav>