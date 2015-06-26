<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Simple Sidebar - Start Bootstrap Template</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/simple-sidebar.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php
        include 'Style.php';
        include 'Funciones.php';
        ?>
        <script >
        function Eliminar(id,id2){
         var val ='EliminarH='+id+"&idPro="+id2;
      $.ajax({
                type:"POST",
                url:"Funciones.php",
                data: val,
                cache: false,
                success: function(html)
                {
                   $('#salida').html(html);
                }
            });
        
        }
        </script>
    </head>

    <body>
        <!-- Navigation -->
        <?php
        CabeceraPaginaUsuario();
        session_start();
        ?>
        <div id="wrapper">

            <!-- Sidebar -->
            <?php SideBarAdmin(); ?>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div name='salida' id='salida'>
                            <?php
                            if (!empty($_SESSION['id_usr']) && $_SESSION['tipo'] == 2) {
                                if (isset($_POST['AgregarHistorial'])) {
                                    $db = new Db();
                                    $var1=$_POST['AgregarHistorial'];
                                    echo '<div class="panel panel-default">
                                            <!-- Default panel contents -->
                                            <div class="panel-heading">Historial</div>
                                            <div class="panel-body">
                                             <a type="button" class="btn btn-primary btn-lg pull-right" href="AgregarHistorial.php?IDP='.$_POST['AgregarHistorial'].'">Agregar Nuevo</a>
                                            </div>';
                                    $result = $db->query("CALL `servicioslegales`.`Ver_Historial_Proceso`(" . $_POST["AgregarHistorial"] . ");");
                                    echo "<table class=\"table table-striped\">";
                                    echo "<thead><th>Fecha</th><th>Comentario</th><th></th><th></th></thead>";
                                    while ($row = $result->fetch_assoc()) {
                                        $res = "<tr><td class=\"col-md-2\">" . $row['Fecha_Hora'] . "</td>";
                                        $res .="<td class=\"col-md-4\">" . $row['Comentario'] . "</td>";
                                        $res .= '<form action="Funciones.php" method="POST">';
                                        $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"Edit\" class=\"btn btn-default btn-xs\"> Editar</button><input type=\"hidden\" name=\"EditarH\" value='" . $row['idHistorial'] . "'></td></form>";
                                        $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"DeleteHistorial\" class=\"btn btn-default btn-xs\" onclick=\"Eliminar(".$row['idHistorial'].",".$var1." )\"> Eliminar</button>";
                                        $res .='</tr>';
                                        echo $res;
                                    }
                                    echo "</table></div>";
                                }
                            } else {
                                
                            }
                            ?>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Menu Toggle Script -->
        <script>
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>

    </body>

</html>
