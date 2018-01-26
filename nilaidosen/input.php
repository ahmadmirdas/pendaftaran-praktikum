<?php
	ob_flush();
	
	
	if (!isset($_GET['btn']))
	{
		include("koneksi.php");
		$id=$_GET['id'];
		$query="SELECT * FROM tbl_pendaftaran WHERE idpendaftar=$id ";
		$result=$db->query($query);
		$row=$result->fetch_assoc();
	} 
	else 
	{
		include("../koneksi.php");
		$id=$_GET['id'];
		$nilaidosen=$_GET['nilaidosen'];

			$query="UPDATE tbl_pendaftaran SET nilaidosen=? WHERE idpendaftar=?";	
			$stmt=$db->prepare($query);
			$stmt->bind_param('ss',$nilaidosen,$id);
			$stmt->execute();
			$stmt->close();
			$db->close();

			?><script language="javascript">alert("Anda telah menginputkan nilai"); document.location='../index.php?p=nilaidosen'</script><?php
		
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
	<form  method="get" class="form-horizontal" action="nilaidosen/input.php" novalidate="novalidate">
		
		<div class="form-group">
			<label class="control-label col-lg-2">Nilai Praktikum</label>
			<div class="col-lg-10">
			    <input type="number" name="nilaidosen" class="form-control"  required=""> 
			</div>
		</div>
		<div class="form-group">
			<label for="tags" class="control-label col-lg-2">&nbsp;</label>
			<div class="col-lg-10">
				<input type="hidden" name="id" value='<?php echo $row['idpendaftar']?>' >
			    <input type="submit" class="btn btn-primary" value="Input" name="btn">
			</div>
		</div><!-- /.form-group -->
	</form>
	<a href="?p=nilaidosen"><input type="submit" value="Kembali" class="btn btn-success"></a>
</div>
</div>