<head>
<title>Log Out</title>
<meta charset="UTF-8">
</head>
<body>
<?php
include ("seguridad.php");
session_unset();
session_destroy();
?>
<p>Sesion cerrada</p>
<?php  header("location: index.php");?>
</body>
</html>