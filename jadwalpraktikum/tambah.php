<?php
	ob_flush();
	
	if(!isset($_GET['btn'])){
		include "koneksi.php";
		$dosen=$db->query("SELECT * FROM tbl_dosen");
		$aslab=$db->query("SELECT * FROM tbl_aslab");
		$db->close();
	}else{
		include("../koneksi.php");
		$kodepraktikum=$_GET['kodepraktikum'];
		$namapraktikum=$_GET['namapraktikum'];
		$hari=$_GET['hari'];
		$pukul=$_GET['pukul'];
		$dosen=$_GET['dosen'];
		$aslab=$_GET['aslab'];

		$res = $db -> query("SELECT * FROM tbl_praktikum WHERE kodepraktikum='$kodepraktikum'");
		$row = $res -> num_rows;
		if($row == 0){
			$query="INSERT INTO tbl_praktikum(kodepraktikum,namapraktikum,hari,pukul,iddosen,idaslab) VALUES (?,?,?,?,?,?)";
			$stmt=$db->prepare($query);
			$stmt->bind_param('ssssss',$kodepraktikum,$namapraktikum,$hari,$pukul,$dosen,$aslab);
			$stmt->execute();
			$stmt->close();
			$db->close();

			?><script language="javascript">alert("Anda telah berhasil menambah praktikum"); document.location='../index.php?p=jadwalpraktikum'</script><?php
		}
		else
		{
			echo '<script>alert("Data sudah ada"); history.back();</script>';
		}
	}
	
	ob_end_flush();
?>
<div class="content-wrapper">
	<section class="content-header">
    <h1> Jadwal Praktikum</h1>
	<ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Jadwal Praktikum</li>
        <li>Tambah</li>
    </ol>
</section>
<div class="row">
	<form  method="get" class="form-horizontal" action="jadwalpraktikum/tambah.php" novalidate="novalidate">
		
		<div class="form-group">
			<label class="control-label col-lg-2">Kode Praktikum</label>
			<div class="col-lg-10">
			    <input type="text" name="kodepraktikum" class="form-control" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Nama Praktikum</label>
			<div class="col-lg-10">
			    <input type="text" name="namapraktikum" class="form-control" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Hari Praktikum</label>
			<div class="col-lg-10">
			    <select class="form-control" name="hari">
			    	<option value="Senin">Senin</option>
			    	<option value="Selasa">Selasa</option>
			    	<option value="Rabu">Rabu</option>
			    	<option value="Kamis">Kamis</option>
			    	<option value="Jumat">Jumat</option>
			    	<option value="Sabtu">Sabtu</option>
			    	<option value="Minggu">Minggu</option>
			    </select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Pukul Praktikum</label>
			<div class="col-lg-10">
			    <input type="time" name="pukul" class="form-control" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Dosen Pembimbing</label>
			<div class="col-lg-10">
			    <select name='dosen' class="form-control" >
					<?php 
						while ($d = $dosen -> fetch_assoc()){
							echo "<option value='".$d['iddosen']."'>".$d['nama_dosen']."</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Asisten Lab</label>
			<div class="col-lg-10">
			    <select name='aslab' class="form-control" >
					<?php 
						while ($a = $aslab -> fetch_assoc()){
							echo "<option value='".$a['idaslab']."'>".$a['nama_aslab']."</option>";
						}
					?>
				</select> 
			</div>
		</div>
		<!-- /.form-group -->
		<div class="form-group">
			<label for="tags" class="control-label col-lg-2">&nbsp;</label>
			<div class="col-lg-10">
			    <input type="submit" class="btn btn-primary" value="Simpan" name="btn">
			</div>
		</div><!-- /.form-group -->
	</form>
	<a href="?p=jadwalpraktikum"><input type="submit" value="Kembali" class="btn btn-success"></a>
</div>
</div>