<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="js/jquery.js"></script>
    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
 <?php
    include 'Style.php';
    include 'Funciones.php';
    ?>
    <script>      
    </script>
</head>

<body onload=''>
   <!-- Navigation -->
        <?php
    CabeceraPaginaUsuario();
    session_start();
    ?>
    <div id="wrapper">

        <!-- Sidebar -->
        <?php SideBar(); ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                       <?php 
                       if(!empty($_SESSION['id_usr'])){ 
                       
                               $db = new Db();    
    $result=$db->query("call Ver_Procesos_Usuario(".$_SESSION['id_usr'].")");
    echo "<table class=\"table table-striped\">";
    echo "<thead><th>ID Proceso</th><th>IdServicio</th><th>Nombre</th><th>Fecha</th><th>Descripcion</th><th>Ver Historial</th></thead>";
    while($row = $result->fetch_assoc()){
    $res  ='<form action="Historialusr.php" method="POST">';
    $res .="<tr>";
    $res .="<td class=\"col-md-1\">".$row['idProceso']."</td>";
    $res .="<td class=\"col-md-1\">".$row['idServicio']."</td>";
    $res .="<td class=\"col-md-1\">".$row['Nombre']."</td>";
    $res .="<td class=\"col-md-1\">".$row['Fecha_Inicio']."</td>";
    $res .="<td class=\"col-md-1\">".$row['Descripcion']."</td>";
    $res .='<td class=\"col-md-1\"> 
    <button type="submit" name="verHistorial" class="btn btn-default btn-sm" />verHistorial</button>
    <input type="hidden" name="idProcesoH" value='.$row['idProceso'].'>
    <input type="hidden" name="idServicioH" value='.$row['idServicio'].'>
    <input type="hidden" name="idFechaH" value='.$row['Fecha_Inicio'].'>
    </form></td>
    </tr>';
    echo $res;
}
  echo "</table>";
                       }else{
                          
                           
                       }
                       ?>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->


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
