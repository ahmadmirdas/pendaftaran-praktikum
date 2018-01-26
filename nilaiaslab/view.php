<?php
	if(isset($_SESSION['user'])) {
		$name = $_SESSION['user'];
	}
	include("koneksi.php");
	$result1=$db->query("SELECT * FROM tbl_aslab WHERE user=$name");
	$row1 = $result1->fetch_assoc();
	$kode = $row1['idaslab'];

	$sql1="SELECT * FROM tbl_pendaftaran as l inner join tbl_user as u on l.iduser=u.iduser where idaslab=$kode";
	$res=$db->query($sql1);

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
	$query="SELECT * FROM tbl_pendaftaran $w";
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
				$pag .= '<li class="prevnext"><a href="?p=mahasiswa&cari='.$_GET['cari'].'&hal='.$prev.'">Previous</a></li>';
				for($i = $pagenum - 4; $i<$pagenum; $i++)
				{
					if($i > 0)
					{
						$pag .= '<li class="prevnext"><a href="?p=mahasiswa&cari='.$_GET['cari'].'&hal='.$i.'">'.$i.'</a></li>';
					}
				}
			}
			$pag .= '<li class="active"><a href="?p=mahasiswa&cari='.$_GET['cari'].'&hal='.$pagenum.'">'.$pagenum.'</a> </li>';
			for($i= $pagenum+1; $i<= $jhal; $i++)
			{
				$pag .= '<li class="prevnext"><a href="?p=mahasiswa&cari='.$_GET['cari'].'&hal='.$i.'">'.$i.'</a></li>';
				if($i >= $pagenum - 4)
				{
					break;
				}
			}
			
			if($pagenum != $jhal)
			{
				$next = $pagenum + 1;
				$pag .= '<li class="prevnext"><a href=?p=mahasiswa&cari='.$_GET['cari'].'&hal='.$next.'">Next</a></li>';
			}
		}
	}
	else
	{
		if($jhal != 1){
			if($pagenum > 1){
				$prev = $pagenum - 1;
				$pag .= '<li class="prevnext"><a href="?p=mahasiswa&hal='.$prev.'">Previous</a></li>';
				for($i = $pagenum - 4; $i<$pagenum; $i++)
				{
					if($i > 0)
					{
						$pag .= '<li class="prevnext"><a href="?p=mahasiswa&hal='.$i.'">'.$i.'</a></a>';
					}
				}
			}
			$pag .= '<li class="active"><a href="?p=mahasiswa&hal='.$pagenum.'">'.$pagenum.'</a></li>';
			for($i= $pagenum+1; $i<= $jhal; $i++)
			{
				$pag .= '<li class="prevnext"><a href="?p=mahasiswa&hal='.$i.'">'.$i.'</a></li>';
				if($i >= $pagenum - 4)
				{
					break;
				}
			}
			
			if($pagenum != $jhal)
			{
				$next = $pagenum + 1;
				$pag .= '<li class="prevnext"><a href=?p=mahasiswa&hal='.$next.'">Next</a></li>';
			}
		}
	}
	$mulai = ($pagenum - 1)*$batas;
	$result = $db->query("SELECT * FROM tbl_pendaftaran WHERE idaslab='$kode'");
	/*$result = $db -> query("SELECT tbl_pendaftaran.idpendaftar, tbl_pendaftaran.iduser,tbl_user.iduser,tbl_user.user, tbl_pendaftaran.kodepraktikum,tbl_pendaftaran.namapraktikum,tbl_pendaftaran.nilaidosen,tbl_pendaftaran.nilaiaslab,tbl_pendaftaran.total,tbl_aslab.idaslab,tbl_aslab.nama_aslab FROM tbl_aslab INNER JOIN (tbl_user INNER JOIN tbl_pendaftaran ON tbl_user.iduser = tbl_pendaftaran.iduser)ON tbl_aslab.idaslab = tbl_pendaftaran.idaslab  $w ORDER BY kodepraktikum DESC LIMIT $mulai,$batas");*/
	/*
	$result = $db -> query("SELECT tbl_pendaftaran.idpendaftar, tbl_pendaftaran.iduser,tbl_user.iduser,tbl_user.user, tbl_pendaftaran.kodepraktikum,tbl_pendaftaran.namapraktikum FROM tbl_user INNER JOIN tbl_pendaftaran ON tbl_pendaftaran.iduser = tbl_user.iduser $w ORDER BY kodepraktikum DESC LIMIT $mulai,$batas");
	*/
?>
<div class="content-wrapper">
	<section class="content-header">
    <h1>Lihat Praktikum (ASISTEN LAB)</h1>
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
				    <th>NBI</th>
				    <th>Kode Praktikum</th>
				    <th>Nama Aslab</th>
				    <th>Nama Praktikum</th>
				    <th>Nilai Dosen</th>
				    <th>Nilai Aslab</th>
				    <th>Aksi</th>
				</tr>
			</thead>
			<tbody>
			<?php
				while ($row = $result->fetch_assoc()) {
				if ($row['nilaiaslab']==0){
					$nilai="<a href='?p=nilaiaslab&a=input&id=".$row['idpendaftar']."'><input type='button' class='btn btn-primary btn-flat hapuso' title='hapus' value='Input Nilai'/></a>";
				}
				else if ($row['nilaiaslab'] >= 0){
					$nilai="<button name='ubah' style='cursor:default;' class='btn btn-small'>
								<i class='icon-ok'></i>Sudah
						</button>";
				
				}
				if ($row['total']==0){
					$total="<a href='?p=nilaiaslab&a=kirim&id=".$row['idpendaftar']."'><input type='button' class='btn btn-success btn-flat' title='hapus' value='Kirim Nilai'/></a>";
				}
				else if ($row['total'] >= 0){
					$total="<button name='ubah' style='cursor:default;' class='btn btn-small'>
								<i class='icon-ok'></i>Sukses
						</button>";
				
				}	
				$mulai++;
			?>
				<tr>
					<td><?php echo $mulai; ?></td>
					<td><?php echo $row['user']?></td>
					<td><?php echo $row['kodepraktikum']?></td>
					<td><?php echo $row1['nama_aslab']?></td>
					<td><?php echo $row['namapraktikum']?></td>
					<td><?php echo $row['nilaidosen']?></td>
					<td><?php echo $row['nilaiaslab']?></td>
					<td><?php echo $nilai; ?></td>
					<td><?php echo $total; ?></td>
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
			</div>
		</div>
		</div>
		</section>
		
	</div>
</div>	
</div>