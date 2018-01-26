<?php
	include("koneksi.php");
	if(isset($_GET['id']))
	{
		$s = $_GET['s'];
		$result = $db -> query('UPDATE tbl_user SET approval="'.$s.'" WHERE iduser="'.$_GET['id'].'"');
		if($result)
		{
			echo '<script>alert("Status mahasiswa telah diganti"); document.location="index.php?p=mahasiswaregister"; </script>';
		}
		else
		{
			echo '<script>alert("Pengaktifan gagal"); document.location="index.php?p=mahasiswaregister";</script>';
		}
	}
?>