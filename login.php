<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Simple login form</title>
    <link rel="stylesheet" href="assets/css/reset.css">
        <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body>
    <div class="container">
  <div class="login">
  	<h1 class="login-heading">
      <strong>Welcome.</strong> Please Login</h1>
      <form method="post">
        <input type="text" name="user" placeholder="Username" required="required" class="input-txt" />
          <input type="password" name="pass" placeholder="Password" required="required" class="input-txt" />
          <div class="login-footer">
             <a href="register.php" class="lnk">
              <span class="icon icon--min"></span> 
              Register Mahasiswa
            </a>
            <button type="submit" name="login" class="btn btn--right">Sign in  </button>
  
          </div>
      </form>		
		<?php
			session_start();
			include ("koneksi.php");
			if (isset($_POST['login']))
			{
				$user=$_POST['user'];
				$pass=$_POST['pass'];
			
				$sql = "SELECT * FROM tbl_user WHERE user='$user' and password='$pass'";
				if(!$result = $db->query($sql))
				{
					die('SQL Salah [' . $db->error . ']');
				}
				else
				{
					if ( ($result->num_rows > 0))
					{
						$row=$result->fetch_assoc();
						if ($row['approval']==1)
						{
							 $_SESSION['user']= $row['user'];
							 $_SESSION['pass']= $row['password'];
							 $_SESSION['level'] = $row['level'];
							 $_SESSION['approval']= $row['approval'];
							 $_SESSION['iduser']=$row['iduser'];
							
							echo '<script>alert("Selamat datang '.$_SESSION['user'].'"); document.location="index.php"</script>';
							
						}
						else if ($row['approval']==2){
							echo'<script>
								window.location.assign("index.php?q=login");
								alert("Akun masih belum aktif, tunggu admin mengkonfirmasi.");
							</script>';
							}	
					}
					else
					{
						echo'<script>
							window.location.assign("index.php?q=login");
							alert("User/password anda salah.");
						</script>';
					
					}
					
				}


				mysqli_close($db);
			
			}
		?>
</div>
</div>
    <script src="assets/js/index.js"></script>
  </body>
</html>