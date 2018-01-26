<?php
	ob_flush();

	
	if (!isset($_GET['btn']))
	{
		include("koneksi.php");
		$id=$_GET['idmahasiswa'];
		$result=$db->query("SELECT * FROM tbl_mahasiswa WHERE idmahasiswa=$id");
		$row=$result->fetch_assoc();
	} 
	else 
	{
		include("../config/koneksi.php");
		$nbi=$_GET['nbi'];
		$nama=$_GET['nama'];
		$fakultas=$_GET['fakultas'];
		$jurusan=$_GET['jurusan'];
		$jk=$_GET['jk'];
		$alamat=$_GET['alamat'];


		$result=$db->query("SELECT * FROM tbl_mahasiswa WHERE idmahasiswa='".$id."'");
		$row = $result -> fetch_assoc();
		$isi = $result -> num_rows;
		if($isi > 0)
		{
			echo '<script>alert("Data sudah ada"); history.back();</script>';
		}
		else{
			$query="UPDATE tbl_mahasiswa SET nbi=?,nama=?,fakultas=?,jurusan=?,jk=?,alamat=? WHERE idmahasiswa=?";	
			$stmt=$db->prepare($query);
			$stmt->bind_param('sssssss',$nbi,$nama,$fakultas,$jurusan,$jk,$alamat,$id);
			if($stmt->execute()){
				echo '<script>alert("Data telah ditambahkan"); document.location="../index.php?p=mahasiswa"</script>';
			}
			$stmt->close();
			$db->close();
		}
		
	}
	
	ob_end_flush();
?>
<div class="content-wrapper">
	<section class="content-header">
    <h1> Mahasiswa</h1>
	<ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Mahasiswa</li>
        <li>Ubah</li>
    </ol>
</section>
<div class="row">
	<form  method="get" class="form-horizontal" action="mahasiswa/ubah.php" novalidate="novalidate">
		<div class="form-group">
			<label class="control-label col-lg-2">NBI</label>
			<div class="col-lg-10">
			    <input type="number" name="nbi" class="form-control" value="<?php echo $row['nbi']?>" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Nama Mahasiswa</label>
			<div class="col-lg-10">
			    <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']?>" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Fakultas</label>
			<div class="col-lg-10">
			    <input type="text" name="fakultas" class="form-control" value="<?php echo $row['fakultas']?>" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Jurusan</label>
			<div class="col-lg-10">
			    <input type="text" name="jurusan" class="form-control" value="<?php echo $row['jurusan']?>" required=""> 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Jenis Kelamin</label>
			<div class="col-lg-10">
				<select class="form-control" name="jk">
			    <option value="Laki-Laki" 
					<?php if($row['jk'] == 'Laki-Laki') {echo"selected";} ;?> >
							laki-Laki</option>
        		<option value="Perempuan" 
        			<?php if($row['jk'] == 'Perempuan') {echo"selected";} ;?> >
        					Perempuan</option>
        		</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Alamat</label>
			<div class="col-lg-10">
			    <textarea class="form-control" name="alamat"><?php echo $row['alamat']?></textarea>
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