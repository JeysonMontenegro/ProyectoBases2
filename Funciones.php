<?php

include 'Conexion.php';
include 'Conexion2.php';
function hola() {
//$email = $_POST["users_email"];
//$pass = $_POST["users_pass"];
//header("Location: register.php");
    return "<script type='text/javascript'>alert('hola');</script>";
}

function registrar() {
    $db = new Db();
    $db->InsertUser($_POST['nom'], $_POST['dpi'], $_POST['tel'], $_POST['correo'], $_POST['dir'], $_POST['usr'], $_POST['pass']);
}

function login($usr, $pass) {
    $val = array();
    $db = new Db();
    $val = $db->Login($usr, $pass);
    $val2 = $val['login'];
    if ($val2 == 0) {
        return false;
    } else {
        return true;
    }
}

function IDUSR($nombre) {
    $val = array();
    $db = new Db();
    $val = $db->query("select id_USR('$nombre') as id");
    while ($row = $val->fetch_assoc()) {
        return $row['id'];
    }
}

function TIPOUSR($id) {
    $val = array();
    $db = new Db();
    $val = $db->query("select servicioslegales.TipoDe_USR($id) as tipo;");
    while ($row = $val->fetch_assoc()) {
        return $row['tipo'];
    }
}

function Proceso() {
    $db = new Db();

    $result = $db->query("call Get_Tipo_Servicio()");
    while ($row = $result->fetch_assoc()) {
        $categories[] = array("id" => $row['idTipo_Servicio'], "val" => $row['Nombre']);
        $hola = $row['idTipo_Servicio'];
    }

    $jsonCats = json_encode($categories);
    return $jsonCats;
}

function FillSelect() {

    $db = new Db();

    $result = $db->query("call Get_Tipo_Servicio()");
    while ($row = $result->fetch_assoc()) {
        $res = "<option ";
        $res .="value='" . $row['idTipo_Servicio'] . "'>";
        $res .=$row['Nombre'];
        $res .='</option>';
        echo $res;
    }
}

function FillSelectServicio() {

    $db = new Db();
    $result = $db->query("CALL `servicioslegales`.`Get_Servicio`();");
    while ($row = $result->fetch_assoc()) {
        $res = "<option ";
        $res .="value='" . $row['idServicio'] . "'>";
        $res .=$row['Nombre'];
        $res .='</option>';
        echo $res;
    }
}

function FillSelectRequisito() {

    $db = new Db();
    $result = $db->query("CALL `servicioslegales`.`Get_Requisitos`();");
    while ($row = $result->fetch_assoc()) {
        $res = "<option ";
        $res .="value='" . $row['idRequisito'] . "'>";
        $res .=$row['Nombre'];
        $res .='</option>';
        echo $res;
    }
}

if (isset($_POST['id_Proceso'])) {
    $db = new Db();
    $result = $db->query("CALL Ver_Servicio_Tipo(" . $_POST['id_Proceso'] . ")");
    if (mysqli_num_rows($result) == 0) {
        echo '<option> No Exite </option>';
    } else {
        while ($row = $result->fetch_assoc()) {
            $res = "<option ";
            $res .="value='" . $row['idServicio'] . "'>";
            $res .='Servicio: '.$row['Nombre'].'    Costo: Q'.$row['Precio'].'  ' ;
            $res .='</option>';
            echo $res;
        }
    }
}
if (isset($_POST['proceso'])) {
    echo '<form method="get" action="requisitos.php">
    <input type="hidden" name="idProceso" value=' . $_POST['proceso'] . '>
    <input type="submit" value="Agregar Proceso"></form>';
}
if (isset($_POST['EliminarR'])) {
    $var = $_POST['EliminarR'];
    $db = new Db();
    $db->query("CALL `servicioslegales`.`Eliminar_Requisito`($var,null)");
    echo '<div class="panel panel-default">
                                            <!-- Default panel contents -->
                                            <div class="panel-heading">Requisitos</div>
                                            <div class="panel-body">
                                             <a type="button" class="btn btn-primary btn-lg pull-right" href="AgregarRequisito.php">Agregar Nuevo</a>
                                            </div>';

    $result = $db->query("CALL `servicioslegales`.`Get_Requisitos`();");
    echo "<table class=\"table table-striped\">";
    echo "<thead><th>ID Requisito</th><th>Nombre</th><th>Descripcion</th><th></th></thead>";
    while ($row = $result->fetch_assoc()) {

        $res = "<tr>";
        $res .="<td class=\"col-md-2\">" . $row['idRequisito'] . "</td>";
        $res .="<td class=\"col-md-2\">" . $row['Nombre'] . "</td>";
        $res .="<td class=\"col-md-3\">" . $row['Descripcion'] . "</td>";
        $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"EndP\" class=\"btn btn-default btn-xs\" onclick=\"Eliminar(" . $row['idRequisito'] . ")\"> Eliminar</button></td>";
        $res .='</tr>';
        echo $res;
    }
    echo "</table></div>";
}
if (isset($_POST['EliminarS'])) {
$var = $_POST['EliminarS'];
 $db = new Db();
  $db->query("CALL `servicioslegales`.`Eliminar_Servicio`($var)");
      echo '<div class="panel panel-default">
                                            <!-- Default panel contents -->
                                            <div class="panel-heading">Servicios</div>
                                            <div class="panel-body">
                                             <a type="button" class="btn btn-primary btn-lg pull-right" href="AgregarServicio.php">Agregar Nuevo</a>
                                            </div>';
                               
                                $result = $db->query("CALL `servicioslegales`.`Get_Servicio`();");
                                echo "<table class=\"table table-striped\">";
                                echo "<thead><th>ID Requisito</th><th>Nombre</th><th>Descripcion</th><th>Costo Q</th></thead>";
                                while ($row = $result->fetch_assoc()) {
                                    
                                    $res ="<tr>";
                                    $res .="<td class=\"col-md-2\">" . $row['idServicio'] . "</td>";
                                    $res .="<td class=\"col-md-2\">" . $row['Nombre'] . "</td>";
                                    $res .="<td class=\"col-md-3\">" . $row['Descripcion'] . "</td>";
                                    $res .="<td class=\"col-md-3\">" . $row['Precio'] . "</td>";
                                    $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"EndP\" class=\"btn btn-default btn-xs\" onclick=\"Eliminar(".$row['idServicio'].")\"> Eliminar</button></td>";
                                    $res .='</tr>';
                                    echo $res;
                                }
                                echo "</table></div>";

}


if (isset($_POST['EliminarTS'])) {
$var = $_POST['EliminarTS'];
 $db = new Db();
$db->query("CALL `servicioslegales`.`Eliminar_Tipo_Servicio`($var,null);");
             echo '<div class="panel panel-default">
                                            <!-- Default panel contents -->
                                            <div class="panel-heading">Tipo Servicios</div>
                                            <div class="panel-body">
                                             <a type="button" class="btn btn-primary btn-lg pull-right" href="AgregarTipo.php">Agregar Nuevo</a>
                                            </div>';
               
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
}
if (isset($_POST['info']) && isset($_POST['idHis'])) {
    $db = new Db();

    $val = $db->query("CALL `servicioslegales`.`Crear_Historial`(" . $_POST['idHis'] . ",'" . $_POST['info'] . "');");
    echo "<script type='text/javascript'>alert('Agregado Correctamente');</script>";
}
//NombreTipoS
if (isset($_POST['NombreTipoS'])) {
    $db = new Db();
 $db->query("CALL `servicioslegales`.`Crear_Tipo_Servicio`('" . $_POST['NombreTipoS'] . "');");
    echo "<script type='text/javascript'>alert('Agregado Correctamente');</script>";
}
if (isset($_POST['DR']) && isset($_POST['NS']) && isset($_POST['costo'])&& isset($_POST['TTS'])) {
    $db = new Db();
    $var=$_POST['DR'];
    $var1=$_POST['NS'];
    $var2=$_POST['costo'];
    $var3=$_POST['TTS'];
    $val = $db->query("call `servicioslegales`.`Crear_Servicio`('" . $var1 . "','" . $var . "','" . $var3 . "','" . $var2 . "');");
    echo "<script type='text/javascript'>alert('Agregado Correctamente');</script>";
}

if (isset($_POST['EliminarH']) && isset($_POST['idPro'])) {
    $var = $_POST['EliminarH'];
    $var1 = $_POST['idPro'];
    //CALL `servicioslegales`.`Eliminar_Historial`(<{IN in_id INT}>);
    $db = new Db();
    $db->query("CALL `servicioslegales`.`Eliminar_Historial`($var)");
    echo '<div class="panel panel-default">
                                            <!-- Default panel contents -->
                                            <div class="panel-heading">Historial</div>
                                            <div class="panel-body">
                                             <a type="button" class="btn btn-primary btn-lg pull-right" href="AgregarHistorial.php?IDP=' . $var1 . '">Agregar Nuevo</a>
                                            </div>';
    $result = $db->query("CALL `servicioslegales`.`Ver_Historial_Proceso`(" . $var1 . ");");
    echo "<table class=\"table table-striped\">";
    echo "<thead><th>Fecha</th><th>Comentario</th><th></th><th></th></thead>";
    while ($row = $result->fetch_assoc()) {
        $res = "<tr><td class=\"col-md-2\">" . $row['Fecha_Hora'] . "</td>";
        $res .="<td class=\"col-md-4\">" . $row['Comentario'] . "</td>";
        $res .= '<form action="Funciones.php" method="POST">';
        $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"Edit\" class=\"btn btn-default btn-xs\"> Editar</button><input type=\"hidden\" name=\"EditarH\" value='" . $row['idHistorial'] . "'></td></form>";
        $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"DeleteHistorial\" class=\"btn btn-default btn-xs\" onclick=\"Eliminar(" . $row['idHistorial'] . "," . $var1 . " )\"> Eliminar</button>";
        $res .='</tr>';
        echo $res;
    }
    echo "</table></div>";
}
 //var data='QReq='+Req+'&QServ='+Serv;





if (isset($_POST['QReq'])&&isset($_POST['QServ'])) {
    $valr=$_POST['QReq'];
    $vals=$_POST['QServ'];
            $db = new Db();
            $db->query('call Eliminar_Servicio_Requisito('.$vals.','.$valr.');');
        $db1 = new DB2();
        
        
      $result = $db1->select("CALL RequisitosNO_Servicio(" . $vals . ");");
    $res= "<table class=\"table table-striped\">";
    $res .="<thead><th>idRequisito</th><th>Nombre</th><th></th></thead>";
    foreach ($result as $row){
        $res .= "<tr><td class=\"col-md-2\">" . $row['idRequisito'] . "</td>";
        $res .="<td class=\"col-md-4\">" . $row['Nombre'] . "</td>";
        $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"Edit\" class=\"btn btn-default btn-xs\" onclick=\"Agregar(".$row['idRequisito'].",".$vals.")\"> Agregar </button></td>";
        $res .='</tr>';
    }
   $res.= "</table>";
    
    $result1 = $db1->select("CALL Requisitos_Servicio(" . $vals . ");");
    $res1= "<table class=\"table table-striped\">";
    $res1 .="<thead><th>idRequisito</th><th>Nombre</th><th></th></thead>";
   foreach ($result1 as $row1) {
        $res1 .= "<tr><td class=\"col-md-2\">" . $row1['idRequisito'] . "</td>";
        $res1 .="<td class=\"col-md-4\">" . $row1['nombre'] . "</td>";
        $res1 .="<td class=\"col-md-1\"><button type=\"submit\" name=\"Edit\" class=\"btn btn-default btn-xs\" onclick=\"Quitar(".$row1['idRequisito'].",".$vals.")\"> Quitar </button></td>";
        $res1 .='</tr>';
    }
   $res1.= "</table>";
    echo '        
<table class="table">        
<tr><td class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Requisitos Disponibles</div>
                                            <div class="panel-body">
                                            '.$res.'
                                            </div>
                                        </div>
                                        
                                    </td>
                                                <td class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Requisitos Actuales</div>
                                            <div class="panel-body">'.$res1.'
                                            </div>
                                        </div>
                                        
                                    </td> </tr>
                                    </table>';
    
}
if (isset($_POST['AReq'])&&isset($_POST['AServ'])) {
    $valr=$_POST['AReq'];
    $vals=$_POST['AServ'];
            $db = new Db();
               $db->query('call Crear_Servicio_Requisito('.$vals.','.$valr.');');
        $db1 = new DB2();
     
        
      $result = $db1->select("CALL RequisitosNO_Servicio(" . $vals . ");");
    $res= "<table class=\"table table-striped\">";
    $res .="<thead><th>idRequisito</th><th>Nombre</th><th></th></thead>";
    foreach ($result as $row){
        $res .= "<tr><td class=\"col-md-2\">" . $row['idRequisito'] . "</td>";
        $res .="<td class=\"col-md-4\">" . $row['Nombre'] . "</td>";
        $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"Edit\" class=\"btn btn-default btn-xs\" onclick=\"Agregar(".$row['idRequisito'].",".$vals.")\"> Agregar </button></td>";
        $res .='</tr>';
    }
   $res.= "</table>";
    
    $result1 = $db1->select("CALL Requisitos_Servicio(" . $vals . ");");
    $res1= "<table class=\"table table-striped\">";
    $res1 .="<thead><th>idRequisito</th><th>Nombre</th><th></th></thead>";
   foreach ($result1 as $row1) {
        $res1 .= "<tr><td class=\"col-md-2\">" . $row1['idRequisito'] . "</td>";
        $res1 .="<td class=\"col-md-4\">" . $row1['nombre'] . "</td>";
        $res1 .="<td class=\"col-md-1\"><button type=\"submit\" name=\"Edit\" class=\"btn btn-default btn-xs\" onclick=\"Quitar(".$row1['idRequisito'].",".$vals.")\"> Quitar </button></td>";
        $res1 .='</tr>';
    }
   $res1.= "</table>";
    echo '        
<table class="table">        
<tr><td class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Requisitos Disponibles</div>
                                            <div class="panel-body">
                                            '.$res.'
                                            </div>
                                        </div>
                                        
                                    </td>
                                                <td class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Requisitos Actuales</div>
                                            <div class="panel-body">'.$res1.'
                                            </div>
                                        </div>
                                        
                                    </td> </tr>
                                    </table>';
    
    
}
if (isset($_POST['ReqSerVer'])) {
    //Disponibles
        $db = new DB2();
        $db1 = new DB2();
    $var1=$_POST['ReqSerVer'];
      $result = $db->select("CALL RequisitosNO_Servicio(" . $var1 . ");");
    $res= "<table class=\"table table-striped\">";
    $res .="<thead><th>idRequisito</th><th>Nombre</th><th></th></thead>";
    foreach ($result as $row){
        $res .= "<tr><td class=\"col-md-2\">" . $row['idRequisito'] . "</td>";
        $res .="<td class=\"col-md-4\">" . $row['Nombre'] . "</td>";
        $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"Edit\" class=\"btn btn-default btn-xs\" onclick=\"Agregar(".$row['idRequisito'].",".$var1.");\"> Agregar </button></td>";
        $res .='</tr>';
    }
   $res.= "</table>";
    
    $result1 = $db1->select("CALL Requisitos_Servicio(" . $var1 . ");");
    $res1= "<table class=\"table table-striped\">";
    $res1 .="<thead><th>idRequisito</th><th>Nombre</th><th></th></thead>";
   foreach ($result1 as $row1) {
        $res1 .= "<tr><td class=\"col-md-2\">" . $row1['idRequisito'] . "</td>";
        $res1 .="<td class=\"col-md-4\">" . $row1['nombre'] . "</td>";
        $res1 .="<td class=\"col-md-1\"><button type=\"submit\" name=\"Edit\" class=\"btn btn-default btn-xs\" onclick=\"Quitar(".$row1['idRequisito'].",".$var1.");\"> Quitar </button></td>";
        $res1 .='</tr>';
    }
   $res1.= "</table>";
    echo '        
<table class="table">        
<tr><td class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Requisitos Disponibles</div>
                                            <div class="panel-body">
                                            '.$res.'
                                            </div>
                                        </div>
                                        
                                    </td>
                                                <td class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Requisitos Actuales</div>
                                            <div class="panel-body">'.$res1.'
                                            </div>
                                        </div>
                                        
                                    </td> </tr>
                                    </table>';
}
if (isset($_POST['Finalizarp'])) {
    $db = new Db();
    $var1 = $_POST['Finalizarp'];
    $db->query("CALL `servicioslegales`.`Finalizar_Proceso`(" . $var1 . ");");
    $result = $db->query("CALL `servicioslegales`.`Ver_Procesos_Activos`()");
    echo "<table class=\"table table-striped\">";
    echo "<thead><th>ID Proceso</th><th>Usuario</th><th>Fecha Creacion</th><th>Servicio</th><th>Agregar Historial</th><th>Ver Documentos Adjuntos</th><th>Finalizar Proceso</th></thead>";
    while ($row = $result->fetch_assoc()) {

        $res = "<tr>";
        $res .="<td class=\"col-md-1\">" . $row['idProceso'] . "</td>";
        $res .="<td class=\"col-md-1\">" . $row['Usuario'] . "</td>";
        $res .="<td class=\"col-md-1\">" . $row['Fecha_Inicio'] . "</td>";
        $res .="<td class=\"col-md-1\">" . $row['Servicio'] . "</td>";
        $res .= '<form action="HistorialAdmin.php" method="POST">';
        $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"AddHistorial\" class=\"btn btn-default btn-sm\"> Historial</button><input type=\"hidden\" name=\"AgregarHistorial\" value='" . $row['idProceso'] . "'></td></form>";
        $res .= '<form action="DocumentosAdmin.php" method="POST">';
        $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"VerDocs\" class=\"btn btn-default btn-sm\"> Documentos</button><input type=\"hidden\" name=\"VerDocumentacion\" value='" . $row['idProceso'] . "'></td></form>";
        $res .="<td class=\"col-md-1\"><button type=\"submit\" name=\"EndP\" class=\"btn btn-default btn-sm\" onclick=\"Finalizar(" . $row['idProceso'] . ")\"> Finalizar</button></td>";
        $res .='</tr>';
        echo $res;
    }
    echo "</table>";
}
?>