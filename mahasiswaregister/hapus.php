<?php
	ob_flush();
	
	if(!isset($_GET['btn']))
	{
		include("koneksi.php");
		$id = $_GET['id'];
		
		$query = "SELECT * FROM tbl_user WHERE iduser='$id'";
		$result = $db -> query($query);
		$row = $result -> fetch_assoc();
		$db -> close();
	}
	else
	{
		include("../koneksi.php");
		$id = $_GET['id'];
		
		$query = "DELETE FROM tbl_user WHERE iduser=?";
		$stmt = $db -> prepare($query);
		$stmt -> bind_param('s',$id);
		$stmt -> execute();
		$stmt -> close();
		$db -> close();
		echo '<script>alert("Anda berhasil menghapus mahasiswa register"); document.location="../index.php?p=mahasiswaregister"</script>';
	}
	
	ob_end_flush();
?>
<div class="content-wrapper">
	<section class="content-header">
    <h1> Mahasiswa Register</h1>
	<ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Mahasiswa Register</li>
        <li>Hapus</li>
    </ol>
</section>
<div class="row">
	<div class="col-xs-12">
		<section class="content">	
			<div class="box">
				<form action="mahasiswaregister/hapus.php" method="get" accept-charset="utf-8">
					<label style="padding: 20px;">Anda Yakin ingin menghapus data pelanggan ? <?php echo $row['user'];?></label>
					<input type="hidden" name="id" value='<?php echo $row['iduser']?>'/>
					
					<input type="submit" name="btn" value="Hapus" class="btn btn-danger btn-flat hapuso" />
				</form>
			</div>
				<a href="?p=mahasiswaregister"><input type="submit" value="Cancel" class="btn btn-default" ></a>
		</section>
	</div>
</div>
</div>