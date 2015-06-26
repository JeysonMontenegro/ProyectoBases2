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
    <script>
    function Finalizar(id){
        
              var val ='Finalizarp='+id;
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
                        <div id='salida' name='salida'>
                             <?php
                            if (!empty($_SESSION['id_usr']) && $_SESSION['tipo']==2) {

                                $db = new Db();
                                $result = $db->query("CALL `servicioslegales`.`Ver_Procesos_Activos`()");
                                echo "<table class=\"table table-striped\">";
                                echo "<thead><th>ID Proceso</th><th>Usuario</th><th>Fecha Creacion</th><th>Servicio</th><th>Agregar Historial</th><th>Ver Documentos Adjuntos</th><th>Finalizar Proceso</th></thead>";
                                while ($row = $result->fetch_assoc()) {
                                    
                                    $res ="<tr>";
                                    $res .="<td class=\"col-md-1\">" . $row['idProceso'] . "</td>";
                                    $res .="<td class=\"col-md-1\">" . $row['Usuario'] . "</td>";
                                    $res .="<td class=\"col-md-1\">" . $row['Fecha_Inicio'] . "</td>";
                                    $res .="<td class=\"col-md-1\">" . $row['Servicio'] . "</td>";
                                    $res .= '<form action="HistorialAdmin.php" method="POST">';
                                    $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"AddHistorial\" class=\"btn btn-default btn-sm\"> Historial</button><input type=\"hidden\" name=\"AgregarHistorial\" value='".$row['idProceso']."'></td></form>";
                                    $res .= '<form action="DocumentosAdmin.php" method="POST">';
                                    $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"VerDocs\" class=\"btn btn-default btn-sm\"> Documentos</button><input type=\"hidden\" name=\"VerDocumentacion\" value='".$row['idProceso']."'></td></form>";
                                    $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"EndP\" class=\"btn btn-default btn-sm\" onclick=\"Finalizar(".$row['idProceso'].")\"> Finalizar</button></td>";
                                    $res .='</tr>';
                                    echo $res;
                                }
                                echo "</table>";
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
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
