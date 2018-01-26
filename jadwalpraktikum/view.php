<?php
	include("koneksi.php");
	$query="SELECT COUNT(idpraktikum) FROM tbl_praktikum";
	$result=$db->query($query);
	$row=$result->fetch_row();

	if(isset($_GET['cari'])){
		$cari = $_GET['cari'];
		$w = "WHERE namapraktikum LIKE '%$cari%'";
	}
	else{
		$cari = "";
		$w = "";
	}
	$query="SELECT * FROM tbl_praktikum $w";
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
				$pag .= '<li class="prevnext"><a href="?p=jadwalpraktikum&cari='.$_GET['cari'].'&hal='.$prev.'">Previous</a></li>';
				for($i = $pagenum - 4; $i<$pagenum; $i++)
				{
					if($i > 0)
					{
						$pag .= '<li class="prevnext"><a href="?p=jadwalpraktikum&cari='.$_GET['cari'].'&hal='.$i.'">'.$i.'</a></li>';
					}
				}
			}
			$pag .= '<li class="active"><a href="?p=jadwalpraktikum&cari='.$_GET['cari'].'&hal='.$pagenum.'">'.$pagenum.'</a> </li>';
			for($i= $pagenum+1; $i<= $jhal; $i++)
			{
				$pag .= '<li class="prevnext"><a href="?p=jadwalpraktikum&cari='.$_GET['cari'].'&hal='.$i.'">'.$i.'</a></li>';
				if($i >= $pagenum - 4)
				{
					break;
				}
			}
			
			if($pagenum != $jhal)
			{
				$next = $pagenum + 1;
				$pag .= '<li class="prevnext"><a href=?p=jadwalpraktikum&cari='.$_GET['cari'].'&hal='.$next.'">Next</a></li>';
			}
		}
	}
	else
	{
		if($jhal != 1){
			if($pagenum > 1){
				$prev = $pagenum - 1;
				$pag .= '<li class="prevnext"><a href="?p=jadwalpraktikum&hal='.$prev.'">Previous</a></li>';
				for($i = $pagenum - 4; $i<$pagenum; $i++)
				{
					if($i > 0)
					{
						$pag .= '<li class="prevnext"><a href="?p=jadwalpraktikum&hal='.$i.'">'.$i.'</a></a>';
					}
				}
			}
			$pag .= '<li class="active"><a href="?p=jadwalpraktikum&hal='.$pagenum.'">'.$pagenum.'</a></li>';
			for($i= $pagenum+1; $i<= $jhal; $i++)
			{
				$pag .= '<li class="prevnext"><a href="?p=jadwalpraktikum&hal='.$i.'">'.$i.'</a></li>';
				if($i >= $pagenum - 4)
				{
					break;
				}
			}
			
			if($pagenum != $jhal)
			{
				$next = $pagenum + 1;
				$pag .= '<li class="prevnext"><a href=?p=jadwalpraktikum&hal='.$next.'">Next</a></li>';
			}
		}
	}
	$mulai = ($pagenum - 1)*$batas;
	$result = $db -> query("SELECT tbl_praktikum.idpraktikum, tbl_praktikum.kodepraktikum, tbl_praktikum.namapraktikum, tbl_praktikum.hari,tbl_praktikum.pukul,tbl_praktikum.iddosen,tbl_dosen.iddosen, tbl_dosen.nama_dosen,tbl_praktikum.idaslab,tbl_aslab.idaslab,tbl_aslab.nama_aslab FROM tbl_aslab INNER JOIN (tbl_dosen INNER JOIN tbl_praktikum ON tbl_dosen.iddosen = tbl_praktikum.iddosen)ON tbl_aslab.idaslab = tbl_praktikum.idaslab $w ORDER BY namapraktikum ASC LIMIT $mulai,$batas");
?>
<div class="content-wrapper">
	<section class="content-header">
    <h1>Tabel Jadwal Praktikum</h1>
	<ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Tabel Jadwal Praktikum</li>
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
					<th>Kode</th>
				    <th>Nama Praktikum</th>
				    <th>Nama Dosen</th>
				    <th>Nama Aslab</th>
				    <th>Hari</th>
				    <th>Pukul</th>
				    <th>Aksi</th>
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
					<td><?php echo $row['nama_aslab']?></td>
					<td><?php echo $row['hari']?></td>
					<td><?php echo $row['pukul']?></td>
					<?php					
					echo "<td>";
					echo "
						<a href='?p=jadwalpraktikum&a=ubah&id=".$row['idpraktikum']."'><input type='button' class='btn btn-primary btn-flat hapuso' title='hapus' value='Ubah'/></a>
						<a href='?p=jadwalpraktikum&a=hapus&id=".$row['idpraktikum']."'><input type='button' class='btn btn-danger btn-flat hapuso' title='hapus' value='Hapus'/></a>
					";
					echo "</td>";
					?>
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
		<div style="float:left; padding-left: 15px; padding-bottom: 15px; ">
			<a href="?p=jadwalpraktikum&a=tambah" class="btn btn-default"><i class="fa fa-plus"></i> Tambah</a>
		</div>
	</div>
</div>	
</div>