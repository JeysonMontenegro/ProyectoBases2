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
            $(function () {
                $('#cnt').change(function () {
                    var id = $(this).val();
                    var data = 'ReqSerVer=' + id;
                    $.ajax({
                        type: "POST",
                        url: "Funciones.php",
                        data: data,
                        cache: false,
                        success: function (html)
                        {
                            $('#Mostar').html(html);

                        }
                    });

                });
            });
            function Quitar(Req,Serv){
                var data='QReq='+Req+'&QServ='+Serv;

                   $.ajax({
                        type: "POST",
                        url: "Funciones.php",
                        data: data,
                        cache: false,
                        success: function (html)
                        {
                            $('#Mostar').html(html);

                        }
                    });
            }
            function Agregar(Req,Serv){
              //  alert(Req+' '+Serv);
                var data='AReq='+Req+'&AServ='+Serv;
          
                    $.ajax({
                        type: "POST",
                        url: "Funciones.php",
                        data: data,
                        cache: false,
                        success: function (html)
                        {
                            $('#Mostar').html(html);

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


                            <table class="table">

                                <tr>
                                    <td class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Servicios</div>
                                            <div class="panel-body">
                                                <form method="POST">
                                                    <select name="cnt" id="cnt" size="4">
                                                        <?php
                                                        $db = new Db();
                                                        $res = '';
                                                        $result1 = $db->query("CALL `servicioslegales`.`Get_Servicio`();");
                                                        while ($row = $result1->fetch_assoc()) {
                                                            $res1 .= "<option ";
                                                            $res1 .="value='" . $row['idServicio'] . "'>";
                                                            $res1 .=$row['Nombre'];
                                                            $res1 .='</option>';
                                                        }
                                                        echo $res1;
                                                        ?>
                                                    </select>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                          
                        </div>
                    </div>
                    <div class="row" id="Mostar" name="Mostrar">
                        
                    </div>
                </div>
                <!-- /#page-content-wrapper -->

            </div>
            <!-- /#wrapper -->


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
