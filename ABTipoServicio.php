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
    function Eliminar(id){
        
              var val ='EliminarTS='+id;
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
                                    echo '<div class="panel panel-default">
                                            <!-- Default panel contents -->
                                            <div class="panel-heading">Tipo Servicios</div>
                                            <div class="panel-body">
                                             <a type="button" class="btn btn-primary btn-lg pull-right" href="AgregarTipo.php">Agregar Nuevo</a>
                                            </div>';
                                $db = new Db();
                                $result = $db->query("CALL `servicioslegales`.`Get_Tipo_Servicio`();");
                                echo "<table class=\"table table-striped\">";
                                echo "<thead><th>ID Tipo Servicio</th><th>Nombre</th><th></th></thead>";
                                while ($row = $result->fetch_assoc()) {
                                    
                                    $res ="<tr>";
                                    $res .="<td class=\"col-md-2\">" . $row['idTipo_Servicio'] . "</td>";
                                    $res .="<td class=\"col-md-2\">" . $row['Nombre'] . "</td>";
                                    $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"EndP\" class=\"btn btn-default btn-xs\" onclick=\"Eliminar(".$row['idTipo_Servicio'].")\"> Eliminar</button></td>";
                                    $res .='</tr>';
                                    echo $res;
                                }
                                echo "</table></div>";
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
