<?php
	ob_flush();
	
	if(!isset($_GET['btn']))
	{
		include("koneksi.php");
		$id = $_GET['id'];
		
		$query = "SELECT * FROM tbl_praktikum WHERE idpraktikum='$id'";
		$result = $db -> query($query);
		$row = $result -> fetch_assoc();
		$db -> close();
	}
	else
	{
		include("../koneksi.php");
		$id = $_GET['id'];
		
		$query = "DELETE FROM tbl_praktikum WHERE idpraktikum=?";
		$stmt = $db -> prepare($query);
		$stmt -> bind_param('s',$id);
		$stmt -> execute();
		$stmt -> close();
		$db -> close();
		echo '<script>alert("Anda berhasil menghapus jadwalpraktikum"); document.location="../index.php?p=jadwalpraktikum"</script>';
	}
	
	ob_end_flush();
?>
<div class="content-wrapper">
	<section class="content-header">
    <h1> Jadwal Praktikum</h1>
	<ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Jadwal Praktikum</li>
        <li>Hapus</li>
    </ol>
</section>
<div class="row">
	<div class="col-xs-12">
		<section class="content">	
			<div class="box">
				<form action="jadwalpraktikum/hapus.php" method="get" accept-charset="utf-8">
					<label style="padding: 20px;">Anda Yakin ingin menghapus ? <?php echo $row['kodepraktikum'];?></label>
					<input type="hidden" name="id" value='<?php echo $row['idpraktikum']?>'/>
					
					<input type="submit" name="btn" value="Hapus" class="btn btn-danger btn-flat hapuso" />
				</form>
			</div>
				<a href="?p=jadwalpraktikum"><input type="submit" value="Cancel" class="btn btn-default" ></a>
		</section>
	</div>
</div>
</div>