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
   $(function(){

    }); 
    
      
    
      
    </script>
</head>

<body onload='loadCategories()'>
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
                           <?php  if(isset($_GET['idProceso'])){
       $db = new Db();    
    $result=$db->query("CALL `servicioslegales`.`Requisitos_Servicio`(".$_GET['idProceso'].")");
    if(mysqli_num_rows($result)==0){
        echo 'error';
    }
    else{
    echo '<form action="requisitos.php" method="POST" enctype="multipart/form-data">';
    echo "<table class=\"table table-striped\">";
    
    echo "<thead><th>ID</th><th>Nombre</th><th>Descripcion</th><th>Subir Archivo</th></thead>";
    echo "<input type=\"hidden\" name=\"Procesoid\" value=\"".$_GET['idProceso']."\" />";
    while($row = $result->fetch_assoc()){
    $res="<tr>";
    $res .="<td class=\"col-md-1\">".$row['idRequisito']." <input type=\"hidden\" name=\"idRequisitos[]\" value=\"".$row['idRequisito']."\" /></td>";
    $res .="<td class=\"col-md-1\">".$row['nombre']."</td>";
    $res .="<td class=\"col-md-1\">".$row['Descripcion']."</td>";
    $res .='<td class=\"col-md-1\"> 
    <input id="file" type="file" name="upload_file[]" /> </td>';
    $res .='</tr>';
    echo $res;
    }
    
    echo "</table>";
    echo '<input type="submit" value="Cargar Archivos"/>'
    . '<input type="hidden" name="archivo" value=1> </form>';
    }
}?>
                        <?php
                        
                     
                        if(isset($_POST['archivo'])){
                        
                            //echo "<script type='text/javascript'>alert('".$_POST["idRequisitos"][1]."');</script>";
     $db = new Db();    
    $result=$db->query("CALL `servicioslegales`.`Agregar_Proceso`('".$_SESSION["id_usr"]."','".$_POST["Procesoid"]."')");
    $result=$db->query("select GetIDP('".$_SESSION["id_usr"]."','".$_POST["Procesoid"]."') as idP;");
    $idProceso=$_POST["Procesoid"];
    while ($row = $result->fetch_assoc()) {
            $Proceso= $row['idP'];
        }
      //  echo "<script type='text/javascript'>alert('$Proceso');</script>";
$targetFolder = 'Upload'; //Path to the Uploads Folder 
	if (!empty($_FILES)) {
		for($i=0;$i<count($_FILES['upload_file']['name']);$i++){
                    $arrayreempla=array('/',' ');
                    $targetPath = $targetFolder. '/';
                    $archivo= str_replace($arrayreempla,'', $_FILES['upload_file']['name'][$i]);
                    $tempFile = $_FILES['upload_file']['tmp_name'][$i];
                $path = $_FILES['upload_file']['name'][$i];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $archivo1= md5((0 + (2147483647-0)) * mt_rand(0, 2147483647) / 2147483647).'.'.$ext;
                    $targetFile = str_replace('//', '/', $targetPath) . $archivo1;	
			$fileTypes = array('rar','xls','txt','docx','doc','pdf','jpeg','jpg','png','gif'); // Allowed File extensions
			$fileParts = pathinfo($_FILES['upload_file']['name'][$i]);
			if(isset($fileParts['extension'])){
				if (in_array($fileParts['extension'],$fileTypes)) {
					move_uploaded_file($tempFile,$targetFile);
					echo '<div class="success">'.$_FILES['upload_file']['name'][$i].' was saved successfully </div>';
                                      //  echo '<div class="success">CALL Agregar_Documento(\''.$targetFile.'\', \'Documento\',".$idProceso.",".$_POST["idRequisitos"][$i].",".$Proceso.")</div>';
                                   $result=$db->query("CALL Agregar_Documento('".$targetFile."', 'Documento',".$idProceso.",".$_POST["idRequisitos"][$i].",".$Proceso.")");
                                    
                                }else{
					echo '<div class="fail">'.$_FILES['upload_file']['name'][$i].' couldn\'t be saved because of invalid file type.</div>';
				}
			}else{
				echo '<div class="fail">'.$_FILES['upload_file']['name'][$i].' couldn\'t be saved because of invalid file type.</div>';
			}
		}
	}
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
