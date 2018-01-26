<?php
	if(isset($_GET['cari'])){
		$cari = $_GET['cari'];
		$w = "WHERE nama_aslab LIKE '%$cari%'";
		header("Location:../index.php?p=aslab&cari=".$cari."");
	}
	else{
		$cari = "";
		$w = "";
	}
?>