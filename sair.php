<?php
	
	session_start();

	unset($_SESSION['usuario']);
	unset($_SESSION['email']);

	echo 'Esperamos você de volta em breve !!!';

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refresh" content="3; url=index.php" />
</head>
<body>

</body>
</html>