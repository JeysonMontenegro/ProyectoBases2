<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Login Form</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
               <?php include 'Funciones.php';
                if(isset($_POST['signin']))
                {
                        $usr=$_POST["usr"];
                         $pass=$_POST["pass"];
                    if(login($usr,$pass)){
                        session_start();
                        $_SESSION["usr"] = $usr;
                        echo "<script type='text/javascript'>alert('$usr');</script>";
                        $_SESSION["id_usr"]=IDUSR($usr);
                        $tipo=$_SESSION['tipo']=TIPOUSR($_SESSION["id_usr"]);
                        if($tipo==1){
                            header('location: usuario.php');
                        }else{
                            header('location: Admin.php');
                            
                        }
                        
                    }else{
                        
                         echo "<script type='text/javascript'>alert('Contrasenia Incorrecta');</script>";
                    }
               }?>
	</head>
	<body>
<!--login modal-->
<div class="container">
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
      
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Login</h1>
      </div>
      <div class="modal-body">
        
          <form class="form col-md-12 center-block" action="Login.php" method="post">
            <div class="form-group">
              <input type="text" class="form-control input-lg" name='usr' > 
            </div>
            <div class="form-group">
                <input type="password" class="form-control input-lg" name='pass'>
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block" name='signin'>Sign In</button>
              <span class="pull-right"></span><span></span>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		  </div>	
      </div>
  </div>
  </div>
</div>
</div>
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>