<?php
	ob_flush();
	
	if(!isset($_GET['btn']))
	{
		include("koneksi.php");
		$user = $_GET['user'];
		
		$query = "SELECT * FROM tbl_aslab WHERE user='$user'";
		$result = $db -> query($query);
		$row = $result -> fetch_assoc();
		
	}
	else
	{
		include("../koneksi.php");
		$user = $_GET['user'];
		
		$query1="DELETE FROM tbl_user WHERE user=?";
		$stmt1=$db->prepare($query1);
		$stmt1->bind_param('s',$user);
		$stmt1->execute();

		$query = "DELETE FROM tbl_aslab WHERE user=?";
		$stmt = $db -> prepare($query);
		$stmt -> bind_param('s',$user);
		$stmt1 -> close();
		$stmt -> execute();
		$stmt -> close();
		$db -> close();
		echo '<script>alert("Anda berhasil menghapus data aslab"); document.location="../index.php?p=aslab"</script>';
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
				<form action="aslab/hapus.php" method="get" accept-charset="utf-8">
					<label style="padding: 20px;">Anda Yakin ingin menghapus data pelanggan ? <?php echo $row['user'];?></label>
					<input type="hidden" name="user" value='<?php echo $row['user']?>'/>
					
					<input type="submit" name="btn" value="Hapus" class="btn btn-danger btn-flat hapuso" />
				</form>
			</div>
				<a href="?p=dosen"><input type="submit" value="Cancel" class="btn btn-default" ></a>
		</section>
	</div>
</div>
</div>