<?php
	ob_flush();
	
	if(isset($_GET['btn'])){
		include("../koneksi.php");
		$user=$_GET['user'];
		$nama=$_GET['nama'];
		$fakultas=$_GET['fakultas'];
		$jurusan=$_GET['jurusan'];

		$password=$_GET['pass'];
		$level = 2;
		$approval = 1;
		//$pass = $_GET['password'];

	
		$res = $db -> query("SELECT * FROM tbl_aslab WHERE user='$user'");
		$row = $res -> num_rows;
		if($row == 0){
			$query="INSERT INTO tbl_aslab(user,nama_aslab,fakultas,jurusan) VALUES (?,?,?,?)";
			$stmt=$db->prepare($query);
			$stmt->bind_param('ssss',$user,$nama,$fakultas,$jurusan);
			$stmt->execute();

			$query1 = "INSERT INTO tbl_user(user,nama,password,level,approval)  VALUES (?,?,?,?,?)";
    		$stmt1=$db->prepare($query1);
    		$stmt1->bind_param('sssii' ,$user,$nama, $password, $level, $approval);
    		$stmt1->execute();
			$stmt->close();
			$stmt1->close();
			$db->close();

			?><script language="javascript">alert("Anda telah berhasil menambah data aslab"); document.location='../index.php?p=aslab'</script><?php
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
    <h1>Asisten Lab</h1>
	<ol class="breadcrumb">
        <li><i class="fa fa-book"></i>Asisten Lab</li>
        <li>Tambah</li>
    </ol>
</section>
<div class="row">
	<form  method="get" class="form-horizontal" action="aslab/tambah.php" novalidate="novalidate">
		<div class="form-group">
			<label class="control-label col-lg-2">NBI</label>
			<div class="col-lg-10">
			    <input type="number" name="user" class="form-control" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Password</label>
			<div class="col-lg-10">
			    <input type="password" name="pass" class="form-control" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Nama Aslab</label>
			<div class="col-lg-10">
			    <input type="text" name="nama" class="form-control" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Fakultas</label>
			<div class="col-lg-10">
			    <input type="text" name="fakultas" class="form-control" value="Teknik" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Jurusan</label>
			<div class="col-lg-10">
			    <input type="text" name="jurusan" class="form-control" value="Informatika" required=""> 
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
	<a href="?p=aslab"><input type="submit" value="Kembali" class="btn btn-success"></a>
</div>
</div>