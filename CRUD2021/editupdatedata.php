<?php
		//koneksi database
		$server = "localhost";
		$user = "root";
		$pass = "";
		$database = "dlogin";


		$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

		//Tombol simpan di klik
		if(isset($_POST['bupdate']))
		{
			//PENGUJIAN APAKAH DATA AKAN DI EDIT ATAU SIMPAN BARU
			if($_GET['hal'] == "edit")
			{
				//Data akan diedit
				$edit = mysqli_query($koneksi, " UPDATE tadm set
												 user = '$_POST[tuser]',
												 pass = '$_POST[tpass]'
												 WHERE id_adm = '$_GET[id]'
											   ");
			if($edit) //Jika edit sukses
			{
				echo "<script>
						alert('Update Data Sukses!');
						document.location='edit.php';
					  </script>";
			}
			else //Jika edit gagal
			{
				echo "<script>
						alert('Update Data GAGAL!');
						document.location='edit.php';
					  </script>";
			}
			}else
			{
				//Data akan disimpan baru
				$simpan = mysqli_query($koneksi, "INSERT INTO tadm (user, pass)
											  VALUES ('$_POST[tuser]', 
											  		 '$_POST[tpass]'
											  		 				)
											 ");
			if($simpan) //Jika simpan sukses
			{
				echo "<script>
						alert('Login Success!');
						document.location='edit.php';
					  </script>";
			}
			else //Jika simpan gagal
			{
				echo "<script>
						alert('Login Failed!');
						document.location='edit.php';
					  </script>";
			}
			}
			
		}

		//PENGUJIAN TOMBOL EDIT / HAPUS DI KLIK
		if(isset($_GET['hal']))
		{
			//PENGUJIAN DATA YANG AKAN DI EDIT
			if($_GET['hal'] == "edit")
			{
				//TAMPILKAN DATA YANG AKAN DI EDIT
				$tampil = mysqli_query($koneksi, "SELECT * FROM tadm WHERE id_adm = '$_GET[id]' ");
				$data = mysqli_fetch_array($tampil);
				if($data)
				{
					//jika data ditemukan, maka data ditampung ke dalam variabel
					$vnama = $data['user'];
					$vnim = $data['pass'];
				}
			}
			else if ($_GET['hal'] == "hapus")
			{
				//Persiapan hapus data
				$hapus = mysqli_query($koneksi, "DELETE FROM tadm WHERE id_adm = '$_GET[id]' ");
				if($hapus)
				{
					echo "<script>
						alert('Hapus Data Sukses!');
						document.location='edit.php';
					  </script>";
			}
				}
			}
			//Tombol back di klik
		if(isset($_POST['back']))
		{
			if($_GET['hal'] == "edit")
			{
				//Data akan diedit
				$edit = mysqli_query($koneksi, " UPDATE tadm set
												 user = '$_POST[tuser]',
												 pass = '$_POST[tpass]'
												 WHERE id_adm = '$_GET[id]'
											   ");
			if($edit) //Button back
			{
				echo "<script>
						document.location='konfirmasiedit.php';
						alert('Apakah Anda Yakin Ingin Kembali ?');
					  </script>";
			}
		}
	}
		
?>


<!DOCTYPE html>
<html>
<head>
	<title>LOGIN SYSTEM</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container"></div>
	<h1 class="text-center">Performance Dashboard</h1>
	<h2 class="text-center">LOGIN SYSTEM</h2>

<!--start update form -->
	<div class="card mt-5">
  	  <div class="card-header bg-info text-white">
    Edit Data User
  </div>
  <div class="card-body">
  	<form method="post" action=" ">
  		<div class="form-group">
  			<label>Username</label>
  			<input type="text" name="tuser" value="<?=@$vnama?>" class="form-control" placeholder="Input Username Baru" required>
  		</div>
  		<div class="form-group">
  			<label>Password</label>
  			<input type="text" name="tpass" value="<?=@$vnim?>" class="form-control" placeholder="Input Password Baru" required>
  		</div>
  		
  		<button type="update" class="btn btn-primary" name="bupdate">Update</button>
		<button type="back" class="btn btn-dark" name="bback">Back</button>
  	</form>
  </div>
	</div>
<!-- end update form -->

<!--start update table -->
	<div class="card mt-5">
  	  <div class="card-header bg-secondary text-white">
    List Data User
  </div>
  <div class="card-body">
  	<table class="table table-bordered table-black-50">
  		<tr>
  			<th>No.</th>
  			<th>Username</th>
  			<th>Password</th>
  		</tr>
  		<?php
  			$no = 1;
  			$tampil = mysqli_query($koneksi, "SELECT * from tadm order by id_adm desc");
  			while($data = mysqli_fetch_array($tampil)) :

  		?>
  		<tr>
  			<td><?=$no++;?></td>
  			<td><?=$data['user']?></td>
  			<td><?=$data['pass']?></td>
  			<td>
  				<a href="edit.php?hal=edit&id=<?=$data['id_adm']?>" onclick= "return confirm('Apakah yakin ingin mengedit ?')" class="btn btn-danger"> EDIT </a>
  				<a href="edit.php?hal=hapus&id=<?=$data['id_adm']?>" onclick ="return confirm('Apakah yakin ingin mengahapus ?')" class="btn btn-dark"> HAPUS </a>
  			</td>
  		</tr>
  	<?php endwhile; //penutup while ?>
  	</table>
  </div>
	</div>
<!-- end update table -->


</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>	
</body>
</html>