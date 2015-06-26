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
 //   $(document).ready(function(){
  
    //    $('#proceso').change(function(){var id1=$(this).val(); alert(id1);});
 //  });
   
   $(function(){

      $('#cnt').change(function(){
            var id=$(this).val();
            var data='id_Proceso='+id;
            $.ajax({
                type:"POST",
                url:"Funciones.php",
                data: data,
                cache: false,
                success: function(html)
                {
                    $('#proceso').html(html);
                    
                }
            });
            
        });
        $('#proceso').click(function(){
            var id1=$(this).val(); 
           
            var data='proceso='+id1;
               $.ajax({
                type:"POST",
                url:"Funciones.php",
                data: data,
                cache: false,
                success: function(html)
                {
                    $('#btnS').html(html);
                }
            });
        });
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
                        
           
                        <table class="table">
                           
                            <tr>
                                <td class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Tipo Proceso</div>
                                        <div class="panel-body">
                                            <form method="POST">
                                            <select name="cnt" id="cnt" size="4">
                                                 <?php FillSelect(); ?>
                                             </select>
                                             </form>
                                         </div>
                                    </div>
                                </td>
                                  <td class="col-md-6">
                                       <div class="panel panel-default">
                                     <div class="panel-heading">Proceso </div>
                                        <div class="panel-body">
                                             <form method="POST">
                                                <select name="proceso" id="proceso" size="4">
                                                    <option>Seleccione Proceso</option>
                                               </select>
                                             </form>
                                         </div>
                                    </div>
                                    </td>
                            </tr>
                            <tr>
                               <td class="col-md-6">
                           
                                </td>
                                 <td class="col-md-1">
                                     <div id="btnS" name="btnS"> </div>
                                </td>
                                 <td class="col-md-1">
                                  
                                </td>
                                 <td class="col-md-1">

                                </td>
                            </tr>
                            
                        </table>
                    

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
