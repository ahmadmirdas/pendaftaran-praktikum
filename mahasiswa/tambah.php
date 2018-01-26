<?php
	ob_flush();
	
	if(isset($_GET['btn'])){
		include("../koneksi.php");
		$user=$_GET['user'];
		$nama=$_GET['nama'];
		$fakultas=$_GET['fakultas'];
		$jurusan=$_GET['jurusan'];
		$tgllahir=$_GET['tgllahir'];
		$jk=$_GET['jk'];
		$alamat=$_GET['alamat'];

		$password=$_GET['pass'];
		$level = 5;
		$approval = 1;
		//$pass = $_GET['password'];

	
		$res = $db -> query("SELECT * FROM tbl_mahasiswa WHERE user='$user'");
		$row = $res -> num_rows;
		if($row == 0){
			$query="INSERT INTO tbl_mahasiswa (user,nama,fakultas,jurusan,tgllahir,jk,alamat) VALUES (?,?,?,?,?,?,?)";
			$stmt=$db->prepare($query);
			$stmt->bind_param('sssssss',$user,$nama,$fakultas,$jurusan,$tgllahir,$jk,$alamat);
			$stmt->execute();

			$query1 = "INSERT INTO tbl_user(user,nama,password,level,approval)  VALUES (?,?,?,?,?)";
    		$stmt1=$db->prepare($query1);
    		$stmt1->bind_param('sssii' ,$user,$nama, $password, $level, $approval);
    		$stmt1->execute();
			$stmt->close();
			$stmt1->close();
			$db->close();

			?><script language="javascript">alert("Anda telah berhasil menambah data mahasiswa"); document.location='../index.php?p=mahasiswa'</script><?php
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
    <h1> Mahasiswa</h1>
	<ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Mahasiswa</li>
        <li>Tambah</li>
    </ol>
</section>
<div class="row">
	<form  method="get" class="form-horizontal" action="mahasiswa/tambah.php" novalidate="novalidate">
		<div class="form-group">
			<label class="control-label col-lg-2">NBI</label>
			<div class="col-lg-10">
			    <input type="number" name="user" class="form-control" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Password</label>
			<div class="col-lg-10">
			    <input type="date" name="pass" class="form-control" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Nama Mahasiswa</label>
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
		<div class="form-group">
			<label class="control-label col-lg-2">Tanggal Lahir</label>
			<div class="col-lg-10">
			    <input type="date" name="tgllahir" class="form-control" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Jenis Kelamin</label>
			<div class="col-lg-10">
			    <select class="form-control" name="jk">
			    	<option value="Laki-Laki">Laki-Laki</option>
			    	<option value="Perempuan">Perempuan</option>
			    </select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Alamat</label>
			<div class="col-lg-10">
			    <textarea class="form-control" name="alamat"></textarea>
			</div>
		</div><!-- /.form-group -->
		<div class="form-group">
			<label for="tags" class="control-label col-lg-2">&nbsp;</label>
			<div class="col-lg-10">
			    <input type="submit" class="btn btn-primary" value="Simpan" name="btn">
			</div>
		</div><!-- /.form-group -->
	</form>
	<a href="?p=mahasiswa"><input type="submit" value="Kembali" class="btn btn-success"></a>
			
	
</div>
</div>