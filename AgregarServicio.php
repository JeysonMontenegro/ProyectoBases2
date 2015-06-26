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
        <script src="js/jquery.js"></script>
        <script>
            $(function () {
                $('#bt1').on('click', function (e) {
                    var val = 'DR=' + $('#comment').val();
                    var val2 = 'NS=' + $('#usr').val();
                    var val3 = 'costo=' + $('#costo').val();
                     var val4 = 'TTS=' + $('#tipo').val();
                    if (val && val2 && val3 && val4) {

                        val = val + "&" + val2 + "&" +val3 + "&" +val4;
                        $.ajax({
                            type: "POST",
                            url: "Funciones.php",
                            data: val,
                            cache: false,
                            success: function (html)
                            {
                                $('#OK').html(html);
                            }
                        });
                    }

                });
            });
        </script>
    </head>

    <body>
        <!-- Navigation -->
        <?php
        CabeceraPaginaUsuario();
        session_start();
        ?>
        <div id="wrapper">
            <div id='OK'></div>
            <!-- Sidebar -->
            <?php SideBarAdmin(); ?>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="panel panel-default">
                                <!-- Default panel contents -->
                                <div class="panel-heading">Requisito</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="usr">Nombre:</label>
                                        <input type="text" class="form-control" id="usr">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Descripcion:</label>
                                        <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="costo">Costo:</label>
                                        <input type="text" class="form-control" id="costo">
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo">Tipo Proceso</label>
                                     <form method="POST">
                                            <select name="tipo" id="tipo" size="4">
                                                 <?php FillSelect(); ?>
                                             </select>
                                      </form>
                                    </div>
                                    <button class="btn btn-primary btn-lg pull-right" name="bt1" id="bt1" type="submit">Agregar</button>

                                </div></div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->


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
