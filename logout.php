
<?php
	session_start();
	
	unset($_SESSION['user']);
	unset($_SESSION['pass']);
	unset($_SESSION['level']);
	unset($_SESSION['approval']);
	unset($_SESSION['iduser_fe']);
	
	echo '<script language="javascript">alert("Anda sudah log out");document.location="login.php"</script>';

?>