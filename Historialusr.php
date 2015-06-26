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
                       if(!empty($_POST['idProcesoH'])){ 
                       
                               $db = new Db();    
    $result=$db->query("CALL `servicioslegales`.`Ver_Historial_Proceso`(".$_POST["idProcesoH"].");");
    echo "<table class=\"table table-striped\">";
    echo "<thead><th>Fecha</th><th>Comentario</th></thead>";
    while($row = $result->fetch_assoc()){
    $res ="<tr><td class=\"col-md-1\">".$row['Fecha_Hora']."</td>";
    $res .="<td class=\"col-md-1\">".$row['Comentario']."</td> </tr>";
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
