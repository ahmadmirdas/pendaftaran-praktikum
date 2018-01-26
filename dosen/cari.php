<?php
	if(isset($_GET['cari'])){
		$cari = $_GET['cari'];
		$w = "WHERE nama_dosen LIKE '%$cari%'";
		header("Location:../index.php?p=dosen&cari=".$cari."");
	}
	else{
		$cari = "";
		$w = "";
	}
?>