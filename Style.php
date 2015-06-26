<?php
function CabeceraPagina()
{
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Servicios Legales</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="services.php">Services</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="Login.php">Login</a>
                            </li>
                            <li>
                                <a href="register.php">Register</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<?php
}

function PiePagina()
{
?>
<footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
 </footer>
<?php
}
?>

<?php
function CabeceraPaginaUsuario()
{
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Servicios Legales</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#menu-toggle" id="menu-toggle">Ver/Ocultar Menu</a>
                    </li>
                    <li>
                        <a href="cerrar.php?cerrar">LogOut</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<?php
}
?>


<?php
function SideBar()
{
?>
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li>
                    <a href="AddProceso.php">Nuevo Proceso</a>
                </li>
                <li>
                    <a href="historial_proceso.php">Ver Historial Proceso</a>
                </li>
            </ul>
        </div>
<?php
}

?>

<?php
function SideBarAdmin()
{
?>
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li>
                    <a href="ProcesosActivos.php">Procesos Activos</a>
                </li>
                <li>
                    <a href="ABTipoServicio.php">Crear/Eliminar Tipo Servicio</a>
                </li>
                  <li>
                    <a href="ABServicio.php">Crear/Eliminar Servicio</a>
                </li>
                <li>
                    <a href="ABRequisito.php">Crear/Eliminar Requisitos</a>
                </li>
                 <li>
                    <a href="AddReqSer.php">Agregar/Quitar Req-Serv</a>
                </li>
                
            </ul>
        </div>
<?php
}

?>