<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Bootstrap Login Form</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
                <?php include 'Funciones.php';
                if(isset($_POST['registrar']))
                {
                    registrar();
               }?>
	</head>
	<body>
<!--login modal-->
<div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6">
                            <form method="post" action="register.php" class='ajaxform'>
				<h3 class="dark-grey">Registration</h3>
                             
		
				<div class="form-group col-lg-12">
					<label>Nombre</label>
					<input type="" name="nom" class="form-control" id="nom" value="">
				</div>
				<div class="form-group col-lg-6">
					<label>DPI</label>
					<input type="" name="dpi" class="form-control" id="dpi" value="">
				</div>
                                <div class="form-group col-lg-6">
					<label>Telefono</label>
					<input type="" name="tel" class="form-control" id="tel" value="">
				</div>
                                <div class="form-group col-lg-6">
					<label>Correo</label>
					<input type="" name="correo" class="form-control" id="correo" value="">
				</div>
                                <div class="form-group col-lg-6">
					<label>Direccion</label>
					<input type="" name="dir" class="form-control" id="dir" value="">
				</div>
                                <br>
                                <br>
                                <div class="form-group col-lg-6">
					<label>User Name</label>
					<input type="" name="usr" class="form-control" id="usr" value="">
				</div>
				<div class="form-group col-lg-6">
					<label>Password</label>
					<input type="password" name="pass" class="form-control" id="pass" value="">
				</div>
				
				<div class="form-group col-lg-6">
					<label>Repeat Password</label>
					<input type="password" name="pass1" class="form-control" id="" value="">
				</div>	
                               
                                <div class="form-group col-lg-6" style="text-align:center" >
					 <button type="submit" class="btn btn-primary" name="registrar">Register</button>
				</div>
                   </Form>
			
			</div>
		
			<div class="col-md-6">
				<h3 class="dark-grey">Terms and Conditions</h3>
				<p>
					By clicking on "Register" you agree to The Company's' Terms and Conditions
				</p>
				<p>
					While rare, prices are subject to change based on exchange rate fluctuations - 
					should such a fluctuation happen, we may request an additional payment. You have the option to request a full refund or to pay the new price. (Paragraph 13.5.8)
				</p>
				<p>
					Should there be an error in the description or pricing of a product, we will provide you with a full refund (Paragraph 13.5.6)
				</p>
				<p>
					Acceptance of an order by us is dependent on our suppliers ability to provide the product. (Paragraph 13.5.6)
				</p>
				
				
                        
			</div>
		</div>
	</section>
</div>
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>