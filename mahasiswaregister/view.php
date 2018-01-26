<?php
	include("koneksi.php");
	$query="SELECT COUNT(iduser) FROM tbl_user WHERE level=5";
	$result=$db->query($query);
	$row=$result->fetch_row();

	if(isset($_GET['cari'])){
		$cari = $_GET['cari'];
		$w = "WHERE user LIKE '%$cari%'";
	}
	else{
		$cari = "";
		$w = "";
	}
	$query="SELECT * FROM tbl_user $w WHERE level=5";
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
				$pag .= '<li class="prevnext"><a href="?p=mahasiswaregister&cari='.$_GET['cari'].'&hal='.$prev.'">Previous</a></li>';
				for($i = $pagenum - 4; $i<$pagenum; $i++)
				{
					if($i > 0)
					{
						$pag .= '<li class="prevnext"><a href="?p=mahasiswaregister&cari='.$_GET['cari'].'&hal='.$i.'">'.$i.'</a></li>';
					}
				}
			}
			$pag .= '<li class="active"><a href="?p=mahasiswaregister&cari='.$_GET['cari'].'&hal='.$pagenum.'">'.$pagenum.'</a> </li>';
			for($i= $pagenum+1; $i<= $jhal; $i++)
			{
				$pag .= '<li class="prevnext"><a href="?p=mahasiswaregister&cari='.$_GET['cari'].'&hal='.$i.'">'.$i.'</a></li>';
				if($i >= $pagenum - 4)
				{
					break;
				}
			}
			
			if($pagenum != $jhal)
			{
				$next = $pagenum + 1;
				$pag .= '<li class="prevnext"><a href=?p=mahasiswaregister&cari='.$_GET['cari'].'&hal='.$next.'">Next</a></li>';
			}
		}
	}
	else
	{
		if($jhal != 1){
			if($pagenum > 1){
				$prev = $pagenum - 1;
				$pag .= '<li class="prevnext"><a href="?p=mahasiswaregister&hal='.$prev.'">Previous</a></li>';
				for($i = $pagenum - 4; $i<$pagenum; $i++)
				{
					if($i > 0)
					{
						$pag .= '<li class="prevnext"><a href="?p=mahasiswaregister&hal='.$i.'">'.$i.'</a></a>';
					}
				}
			}
			$pag .= '<li class="active"><a href="?p=mahasiswaregister&hal='.$pagenum.'">'.$pagenum.'</a></li>';
			for($i= $pagenum+1; $i<= $jhal; $i++)
			{
				$pag .= '<li class="prevnext"><a href="?p=mahasiswaregister&hal='.$i.'">'.$i.'</a></li>';
				if($i >= $pagenum - 4)
				{
					break;
				}
			}
			
			if($pagenum != $jhal)
			{
				$next = $pagenum + 1;
				$pag .= '<li class="prevnext"><a href=?p=mahasiswaregister&hal='.$next.'">Next</a></li>';
			}
		}
	}
	$mulai = ($pagenum - 1)*$batas;
	$result = $db -> query("SELECT * FROM tbl_user $w WHERE level=5 ORDER BY user DESC LIMIT $mulai,$batas");
?>
<div class="content-wrapper">
	<section class="content-header">
    <h1> Mahasiswa Register</h1>
	<ol class="breadcrumb">
        <li><i class="fa fa-book"></i> Mahasiswa Register</li>
    </ol>
</section>
<div class="row">
	<div class="col-xs-12">
		<section class="content">	
		<div class="box">
		<div class="box-header">
			<form action="pelanggan/cari.php" method="get" enctype="multipart/form-data">
                <div class="input-group col-lg-6">
                	<span class="input-group-btn">
        				<button class="btn btn-default" type="button">Pencarian! (Mahasiswa)</button>
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
				    <th>Nama</th>
				    <th>Aksi</th>
				    <th>Hapus</th>
				</tr>
			</thead>
			<tbody>
			<?php
				while ($row = $result->fetch_assoc()) {

				if($row['approval'] == '1'){
					$status = '<i style="color:#62A8D9">Sudah Aktif</i>';
					$action = '<a href="?p=mahasiswaregister&a=status&s=2&id='.$row['iduser'].'">							
					<button class="btn btn-orange btn-small">
						<i class="icon-remove-sign"></i>&nbsp;  Non-aktifkan
					</button>
					</a>';
				} 
				else if ($row['approval'] == '2')
				{
					$status = '<i style="color:#ED796D">Non Aktif</i>';
					$action = '<a href="?p=mahasiswaregister&a=status&s=1&id='.$row['iduser'].'">
						<button class="btn btn-blue btn-small">
							<i class="icon-ok-sign"></i>&nbsp;  Aktifkan
						</button>
					</a>';
				} else{
					$status = '<i style="color:#ED796D">User Belum Aktif</i>';
					$action = '<a href="?p=mahasiswaregister&a=status&s=1&id='.$row['iduser'].'">
					<button class="btn btn-blue btn-small">
						<i class="icon-ok-sign"></i>&nbsp;  Aktifkan
					</button>
					</a>';
				}
					
				$mulai++;
			?>
				<tr>
					<td><?php echo $mulai; ?></td>
					<td><?php echo $row['user']?></td>
					<td><?php echo $row['nama']?></td>
					<?php					
					echo "<td width='100px' style=' text-align:center;'>";
					echo $action;
					echo '</br>';
					echo $status;
					echo "</td>";
					echo "<td>";
					echo "
						<a href='?p=mahasiswaregister&a=hapus&id=".$row['iduser']."'><input type='button' class='btn btn-danger btn-flat hapuso' title='hapus' value='Hapus'/></a>
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
	</div>
</div>	
</div>