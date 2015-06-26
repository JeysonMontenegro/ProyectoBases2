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
                             <?php
                            if (!empty($_SESSION['id_usr']) && $_SESSION['tipo']==2) {
                               
                                if(isset($_POST['VerDocumentacion'])){
                                       $db = new Db();
                                       $var=$_POST['VerDocumentacion'];
                                $result = $db->query('CALL `servicioslegales`.`Ver_Documentos_Proceso`('.$var.');');
                                echo "<table class=\"table table-striped\">";
                                echo "<thead><th>idRequisito</th><th>Nombre</th><th>Fecha</th><th>Descargar</th></thead>";
                                while ($row = $result->fetch_assoc()) {
                                    
                                    $res ="<tr>";
                                    $res .="<td class=\"col-md-1\">" . $row['idRequisito'] . "</td>";
                                    $res .="<td class=\"col-md-1\">" . $row['Nombre'] . "</td>";
                                    $res .="<td class=\"col-md-1\">" . $row['Fecha'] . "</td>";
                                    $res .="<td class=\"col-md-1\"> <a href=\"".$row['Ruta_Imagen']."\">Descargar</a></td>";
                                     $res .='</tr>';
                                    echo $res;
                                }
                                echo "</table>";
                                    
                                }
                             
                            } else {
                                
                            }
                            ?>
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
