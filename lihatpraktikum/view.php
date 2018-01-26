<?php
	include("koneksi.php");

	$query="SELECT COUNT(idpendaftar) FROM tbl_pendaftaran";
	$result=$db->query($query);
	$row=$result->fetch_row();

	if(isset($_GET['cari'])){
		$cari = $_GET['cari'];
		$w = "WHERE kodepraktikum LIKE '%$cari%'";
	}
	else{
		$cari = "";
		$w = "";
	}
	$iduser=$_SESSION['iduser'];
	$query="SELECT  tbl_pendaftaran.idpendaftar,tbl_pendaftaran.iduser,tbl_pendaftaran.iddosen, tbl_dosen.nama_dosen,tbl_pendaftaran.kodepraktikum,tbl_pendaftaran.namapraktikum,tbl_pendaftaran.total FROM tbl_dosen INNER JOIN tbl_pendaftaran ON tbl_dosen.iddosen = tbl_pendaftaran.iddosen $w WHERE iduser=$iduser";
	$result = mysqli_query($db, $query);
	
	$jdata=$result -> num_rows;
	$batas=10;
	$jhal = ceil($jdata/$batas);

	if($jhal < 1)
	{
		$jhal = 1;
	}
	$pagenum = 1;
	if(isset($_GET['hal']))
	{
		$pagenum = preg_replace('#[^0-9]#','',$_GET['hal']);
	}
	if($pagenum < 1)
	{
		$pagenum = 1;
	}
	else if($pagenum > $jhal){
		$pagenum = $jhal;
	}
	$pag = '';
	if(isset($_GET['cari'])){
		if($jhal != 1){
			if($pagenum > 1){
				$prev = $pagenum - 1;
				$pag .= '<li class="prevnext"><a href="?p=lihatpraktikum&cari='.$_GET['cari'].'&hal='.$prev.'">Previous</a></li>';
				for($i = $pagenum - 4; $i<$pagenum; $i++)
				{
					if($i > 0)
					{
						$pag .= '<li class="prevnext"><a href="?p=lihatpraktikum&cari='.$_GET['cari'].'&hal='.$i.'">'.$i.'</a></li>';
					}
				}
			}
			$pag .= '<li class="active"><a href="?p=lihatpraktikum&cari='.$_GET['cari'].'&hal='.$pagenum.'">'.$pagenum.'</a> </li>';
			for($i= $pagenum+1; $i<= $jhal; $i++)
			{
				$pag .= '<li class="prevnext"><a href="?p=lihatpraktikum&cari='.$_GET['cari'].'&hal='.$i.'">'.$i.'</a></li>';
				if($i >= $pagenum - 4)
				{
					break;
				}
			}
			
			if($pagenum != $jhal)
			{
				$next = $pagenum + 1;
				$pag .= '<li class="prevnext"><a href=?p=lihatpraktikum&cari='.$_GET['cari'].'&hal='.$next.'">Next</a></li>';
			}
		}
	}
	else
	{
		if($jhal != 1){
			if($pagenum > 1){
				$prev = $pagenum - 1;
				$pag .= '<li class="prevnext"><a href="?p=lihatpraktikum&hal='.$prev.'">Previous</a></li>';
				for($i = $pagenum - 4; $i<$pagenum; $i++)
				{
					if($i > 0)
					{
						$pag .= '<li class="prevnext"><a href="?p=lihatpraktikum&hal='.$i.'">'.$i.'</a></a>';
					}
				}
			}
			$pag .= '<li class="active"><a href="?p=lihatpraktikum&hal='.$pagenum.'">'.$pagenum.'</a></li>';
			for($i= $pagenum+1; $i<= $jhal; $i++)
			{
				$pag .= '<li class="prevnext"><a href="?p=lihatpraktikum&hal='.$i.'">'.$i.'</a></li>';
				if($i >= $pagenum - 4)
				{
					break;
				}
			}
			
			if($pagenum != $jhal)
			{
				$next = $pagenum + 1;
				$pag .= '<li class="prevnext"><a href=?p=lihatpraktikum&hal='.$next.'">Next</a></li>';
			}
		}
	}
	$mulai = ($pagenum - 1)*$batas;

	
	/*
	$result = $db->query("SELECT tbl_pendaftaran.idpendaftar,tbl_pendaftaran.iduser,tbl_pendaftaran.iddosen,tbl_dosen.iddosen,tbl_dosen.nama_dosen,tbl_pendaftaran.kodepraktikum,tbl_pendaftaran.namapraktikum,tbl_pendaftaran.total, tbl_user.iduser,tbl_user.user FROM tbl_user INNER JOIN (tbl_dosen INNER JOIN tbl_pendaftaran ON tbl_dosen.iddosen = tbl_pendaftaran.iddosen)ON tbl_user.iduser = tbl_pendaftaran.iduser $w ORDER BY kodepraktikum DESC  LIMIT $mulai,$batas ");
	*/
?>
<div class="content-wrapper">
	<section class="content-header">
    <h1>Lihat Praktikum</h1>
	<ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Lihat Praktikum</li>
    </ol>
</section>
<div class="row">
	<div class="col-xs-12">
		<section class="content">	
		<div class="box">
		<div class="box-header">
			<form action="mahasiswa/cari.php" method="get" enctype="multipart/form-data">
                <div class="input-group col-lg-6">
                	<span class="input-group-btn">
        				<button class="btn btn-default" type="button">Pencarian! (Nama Praktikum)</button>
      				</span>
                    	<input type="text" name="cari" value='<?php echo $cari;?>' class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <input type="submit" name="btn" class="btn btn-flat" >
                   	</span>
                </div>
            </form>   
        </div>
		<div class="box-body table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>No</th>
				    <th>Kode Praktikum</th>
				    <th>Nama Praktikum</th>
				    <th>Nama Dosen</th>
				    <th>Nilai Praktikum</th>
				</tr>
			</thead>
			<tbody>
			<?php
				while ($row = $result->fetch_assoc()) {
					
				$mulai++;
			?>
				<tr>
					<td><?php echo $mulai; ?></td>
					<td><?php echo $row['kodepraktikum']?></td>
					<td><?php echo $row['namapraktikum']?></td>
					<td><?php echo $row['nama_dosen']?></td>
					<td><?php echo $row['total']?></td>
				</tr>
			<?php
				}

			?>
			</tbody>
		</table>
			<div style="padding-bottom:20px; padding-top : 20px; margin-bottom:40px;">
				<div style="float:right;">
					<ul class="pagination">
					<?php
						echo $pag;
					?>
					</ul>
				</div>
				<div class="col-xs-6" style="float : left;">
					<span>Showing <?php echo $jdata; ?> entries</span>
				</div>
			</div>
		</div>
		</div>
		</section>
		
	</div>
</div>	
</div>