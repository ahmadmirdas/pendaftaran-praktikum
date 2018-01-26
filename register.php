<?php
	if (isset($_POST['btn'])){

	session_start();
	include("koneksi.php");
	$user=$_POST['user'];
	$nama=$_POST['nama'];

	$pas1=$_POST['pas1'];
	$pas2=$_POST['pas2'];
	
	$level=5;
	$approval=2;

	$quser=$db->query("SELECT * FROM tbl_user WHERE user='$user' ");
	$row=$quser->num_rows;
		if ($pas1 == $pas2){
			if ($row==0){
			$query="INSERT INTO tbl_user(user,password,nama,level,approval) VALUES(?,?,?,?,?)";
			$stmt=$db->prepare($query);
			$stmt->bind_param('sssss',$user,$pas1,$nama,$level,$approval);
			$stmt->execute();
			$stmt->close();
			$db->close();
			echo'<script>
				window.location.assign("index.php?q=login");
				alert("Suksess, Akun masih belum aktif tunggu Kalab mengkonfirmasi.");
				</script>';
			}
			else{
			echo'<script>
				window.location.assign("register.php");
				alert("Maaf, user telah terdaftar.");
			</script>';
			}
		
		}
		else{
			echo'<script>
				window.location.assign("register.php");
				alert("Password yang anda masukkan tidak sama, mohon masukkan kembali.");
			</script>';
		}
	

	
	$db->close();
	}
?>
<?php
	if (!isset($_POST['btn'])){
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Simple Register form</title>
    <link rel="stylesheet" href="assets/css/reset.css">
        <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body>
    <div class="container">
  <div class="login">
  	<h1 class="login-heading">
      <strong>Welcome.</strong> Please Register.</h1>
      <form method="post">
        <input type="number" name="user" placeholder="NBI" required="required" class="input-txt" />
          <input type="password" name="pas1" placeholder="Password" required="required" class="input-txt" />
          <input type="password" name="pas2" placeholder="Re-Password" required="required" class="input-txt"/>
          <input type="text" name="nama" placeholder="Nama" required="required" class="input-txt" />
          <div class="login-footer">
             <a href="login.php" class="lnk">
              <span class="icon icon--min"></span> 
              Login Praktikum
            </a>
            <button type="submit" name="btn" class="btn btn--right">Sign up </button>
  
          </div>
      </form>		
		
</div>
</div>
    <script src="assets/js/index.js"></script>
  </body>
</html>
<?php
	}
?>