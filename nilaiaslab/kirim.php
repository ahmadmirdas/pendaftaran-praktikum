<?php
	ob_flush();
	
	
	if (!isset($_GET['btn']))
	{
		include("koneksi.php");
		$id=$_GET['id'];
		$query="SELECT tbl_pendaftaran.idpendaftar,tbl_pendaftaran.nilaidosen,tbl_pendaftaran.nilaiaslab,tbl_user.iduser,tbl_user.user FROM tbl_user INNER JOIN tbl_pendaftaran ON tbl_user.iduser = tbl_pendaftaran.iduser WHERE idpendaftar=$id ";
		$result=$db->query($query);
		$row=$result->fetch_assoc();
	} 
	else 
	{
		include("../koneksi.php");
		$id=$_GET['id'];
		$nilaidosen=$_GET['nilaidosen'];
		$nilaiaslab=$_GET['nilaiaslab'];

		$total = ($nilaidosen+$nilaiaslab)/2;

			$query="UPDATE tbl_pendaftaran SET total=? WHERE idpendaftar=?";	
			$stmt=$db->prepare($query);
			$stmt->bind_param('ss',$total,$id);
			$stmt->execute();
			$stmt->close();
			$db->close();

			?><script language="javascript">alert("Anda telah menginputkan nilai"); document.location='../index.php?p=nilaiaslab'</script><?php
		
	}
	
	ob_end_flush();
?>
<div class="content-wrapper">
	<section class="content-header">
    <h1> Input Nilai Mahasiswa</h1>
	<ol class="breadcrumb">
        <li><i class="fa fa-book"></i>Input Nilai Mahasiswa</li>
        <li>Input</li>
    </ol>
</section>
<div class="row">
	<form  method="get" class="form-horizontal" action="nilaiaslab/kirim.php" novalidate="novalidate">
		<div class="form-group">
			<label class="control-label col-lg-2">NBI</label>
			<div class="col-lg-10">
			    <input type="number" class="form-control" value="<?php echo $row['user']?>" > 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Nilai Dosen</label>
			<div class="col-lg-10">
			    <input type="number" name="nilaidosen" class="form-control" value="<?php echo $row['nilaidosen']?>" > 
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">Nilai Aslab</label>
			<div class="col-lg-10">
			    <input type="number" name="nilaiaslab" class="form-control" value="<?php echo $row['nilaiaslab']?>"  required=""> 
			</div>
		</div>
		<div class="form-group">
			<label for="tags" class="control-label col-lg-2">&nbsp;</label>
			<div class="col-lg-10">
				<input type="hidden" name="id" value='<?php echo $row['idpendaftar']?>' >
			    <input type="submit" class="btn btn-primary" value="Kirim" name="btn">
			</div>
		</div><!-- /.form-group -->
	</form>
	<a href="?p=nilaiaslab"><input type="submit" value="Kembali" class="btn btn-success"></a>
</div>
</div>