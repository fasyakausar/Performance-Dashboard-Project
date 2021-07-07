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
												 user = '$_POST[user]',
												 pass = '$_POST[pass]',
												 nama_lengkap = '$_POST[nama_lengkap]'
												 WHERE id_adm = '$_GET[id]'
											   ");
			if($edit) //Jika edit sukses
			{
				echo "<script>
						alert('Update Data Sukses!');
						document.location='editupdatedata.php';
					  </script>";
			}
			else //Jika edit gagal
			{
				echo "<script>
						alert('Update Data GAGAL!');
						document.location='editupdatedata.php';
					  </script>";
			}
			}else
			{
				//Data akan disimpan baru
				$simpan = mysqli_query($koneksi, "INSERT INTO tadm (user, pass)
											  VALUES ('$_POST[user]', 
											  		  '$_POST[pass]',
													  '$_POST[nama_lengkap]'
											  		 				)
											 ");
			if($simpan) //Jika simpan sukses
			{
				echo "<script>
						alert('Login Success!');
						document.location='editupdate.php';
					  </script>";
			}
			else //Jika simpan gagal
			{
				echo "<script>
						alert('Login Failed!');
						document.location='editupdate.php';
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
						document.location='editupdatedata.php';
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
												 user = '$_POST[user]',
												 pass = '$_POST[pass]',
												 nama_lengkap ='$_POST[nama_lengkap]'
												 WHERE id_adm = '$_GET[id]'
											   ");
			if($edit) //Button back
			{
				echo "<script>
						document.location='menulogin.php';
						alert('Apakah Anda Yakin Ingin Kembali ?');
					  </script>";
			}
		}
	}
		
?>


<!DOCTYPE html>
<html>
<head>
	<title>EDIT DATA</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container"></div>
	<h1 class="text-center">Performance Dashboard</h1>
	<h2 class="text-center">EDIT DATA USER</h2>

<!--start update form -->
	<div class="card mt-5">
  	  <div class="card-header bg-info text-white">
    Edit Data User
  </div>
  <div class="card-body">
  	<form method="post" action=" ">
	  <div class="form-group">
  			<label>Nama Lengkap</label>
  			<input type="text" name="nama_lengkap" value="<?=@$vnama?>" class="form-control" placeholder="Input Nama Lengkap Baru" required>
  		</div>
  		
  		<div class="form-group">
  			<label>Username</label>
  			<input type="text" name="user" value="<?=@$vnama?>" class="form-control" placeholder="Input Username Baru" required>
  		</div>
  		<div class="form-group">
  			<label>Password</label>
  			<input type="text" name="pass" value="<?=@$vnim?>" class="form-control" placeholder="Input Password Baru" required>
  		</div>
  		
  		<button type="update" class="btn btn-primary" name="bupdate">Update</button>
		<button type="back" class="btn btn-dark" name="bback">Back</button>
  	</form>
  </div>
	</div>
<!-- end update form -->

<!--awal card tabel -->
<div class="card mt-5">
  	  <div class="card-header bg-success text-white">
    List Data User
  </div>
  <div class="card-body">
  	<table class="table table-bordered table-black-50">
  		<tr>
  			<th>No.</th>
  			<th>Nama User</th>
  			<th>Username</th>
  			<th>Password</th>
  			<th>Role</th>
  			<th>Action</th>
  		</tr>
  		<?php
  			$no = 1;
  			$tampil = mysqli_query($koneksi, "SELECT * from tadm order by id_adm desc");
  			while($data = mysqli_fetch_array($tampil)) :

  		?>
  		<tr>
  			<td><?=$no++;?></td>
  			<td><?=$data['nama_lengkap']?></td>
  			<td><?=$data['user']?></td>
  			<td><?=$data['pass']?></td>
  			<td><?=$data['posisi']?></td>
  			<td>
  				<a href="editupdatedata.php?hal=edit&id=<?=$data['id_adm']?>" class="btn btn-danger text-white"> EDIT </a>
  				<a href="editupdatedata.php?hal=hapus&id=<?=$data['id_adm']?>" onclick ="return confirm('Apakah yakin ingin mengahapus ?')" class="btn btn-dark"> HAPUS </a>
  			</td>
  		</tr>
  	<?php endwhile; //penutup while ?>
  	</table>
  </div>
	</div>
<!-- akhir card tabel -->



</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>	
</body>
</html>
