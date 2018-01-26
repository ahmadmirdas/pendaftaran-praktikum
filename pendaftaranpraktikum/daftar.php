<?php

	ob_flush();
	if(!isset($_GET['btn'])){
		include "koneksi.php";
		$id=$_GET['id'];
		$query="SELECT * FROM tbl_praktikum WHERE idpraktikum=$id";
		$result=$db->query($query);
		$row=$result->fetch_assoc();
	}else{
		session_start();
		include("../koneksi.php");
		$kodepraktikum=$_GET['kodepraktikum'];
		$iduser = $_SESSION['iduser'];
		$namapraktikum = $_GET['namapraktikum'];
		$nilaidosen = 0;
		$nilaiaslab = 0;
		$iddosen=$_GET['iddosen'];
		$idaslab=$_GET['idaslab'];

			$query="INSERT INTO tbl_pendaftaran(iduser,kodepraktikum,iddosen,idaslab,namapraktikum,nilaidosen,nilaiaslab) VALUES (?,?,?,?,?,?,?)";
			$stmt=$db->prepare($query);
			$stmt->bind_param('sssssss',$iduser,$kodepraktikum,$iddosen,$idaslab,$namapraktikum,$nilaidosen,$nilaiaslab);
			$stmt->execute();
			$stmt->close();
			$db->close();

			?><script language="javascript">alert("Anda telah berhasil mendaftar praktikum"); document.location='../index.php?p=pendaftaranpraktikum'</script><?php
	}
	ob_end_flush();
?>
<div class="content-wrapper">
	<section class="content-header">
    <h1> Pendaftaran Praktikum</h1>
	<ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Pendaftaran Praktikum</li>
        <li>Tambah</li>
    </ol>
</section>
<div class="row">
	<form  method="get" class="form-horizontal" action="pendaftaranpraktikum/daftar.php" novalidate="novalidate">
		
		<div class="form-group">
			<label class="control-label col-lg-2">Kode Praktikum</label>
			<div class="col-lg-10">
			    <input type="text" name="kodepraktikum" class="form-control" value="<?php echo $row['kodepraktikum']?>" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Nama Praktikum</label>
			<div class="col-lg-10">
			    <input type="text" name="namapraktikum" class="form-control" value="<?php echo $row['namapraktikum']?>" required=""> 
			</div>
		</div>
		<input type="hidden" name="iddosen" class="form-control" value="<?php echo $row['iddosen']?>" required="">
		<input type="hidden" name="idaslab" class="form-control" value="<?php echo $row['idaslab']?>" required="">
		<!-- /.form-group -->
		<div class="form-group">
			<label for="tags" class="control-label col-lg-2">&nbsp;</label>
			<div class="col-lg-10">
			    <input type="submit" class="btn btn-primary" value="Daftar" name="btn">
			</div>
		</div><!-- /.form-group -->
	</form>
	<a href="?p=pendaftaranpraktikum"><input type="submit" value="Kembali" class="btn btn-success"></a>
</div>
</div>