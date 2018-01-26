<?php
	include("koneksi.php");
	$query="SELECT COUNT(idkalab) FROM tbl_kalab";
	$result=$db->query($query);
	$row=$result->fetch_row();

	if(isset($_GET['cari'])){
		$cari = $_GET['cari'];
		$w = "WHERE nama LIKE '%$cari%'";
	}
	else{
		$cari = "";
		$w = "";
	}
	$query="SELECT * FROM tbl_kalab $w";
	$result = mysqli_query($db, $query);
	
	$jdata=$result -> num_rows;
	$batas=5;
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
	$result = $db -> query("SELECT * FROM tbl_kalab $w ORDER BY nama DESC LIMIT $mulai,$batas");
?>
<div class="content-wrapper">
	<section class="content-header">
    <h1>Data Ketua LAB</h1>
	<ol class="breadcrumb">
        <li><i class="fa fa-book"></i>Data Ketua LAB</li>
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
        				<button class="btn btn-default" type="button">Pencarian(Nama)</button>
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
				    <th>Username</th>
				    <th>Nama</th>
				    <th>Fakultas</th>
				    <th>Jurusan</th>
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
					<td><?php echo $row['user']?></td>
					<td><?php echo $row['nama']?></td>
					<td><?php echo $row['fakultas']?></td>
					<td><?php echo $row['jurusan']?></td>
					<?php					
					echo "<td>";
					echo "
						<a href='?p=kalab&a=ubah&user=".$row['user']."'><input type='button' class='btn btn-primary btn-flat hapuso' title='ubah' value='Ubah'/></a>
						<a href='?p=kalab&a=hapus&user=".$row['user']."'><input type='button' class='btn btn-danger btn-flat hapuso' title='hapus' value='Hapus'/></a>
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
			<a href="?p=kalab&a=tambah" class="btn btn-default"><i class="fa fa-plus"></i> Tambah</a>
		</div>
	</div>
</div>	
</div>