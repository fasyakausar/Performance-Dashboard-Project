<?php
		include "koneksi_login.php";

		session_start();
		if( !isset($_SESSION["login"])){
			header("Location: menulogin.php");
		}
		
		//Tombol simpan di klik
		if(isset($_POST['bupdate']))
		{
			//PENGUJIAN APAKAH DATA AKAN DI EDIT ATAU SIMPAN BARU
			if($_GET['hal'] == "edit")
			{
				//Data akan diedit
				$edit = mysqli_query($koneksi, " UPDATE tadm set
												 email = '$_POST[email]',
												 kata_sandi = '$_POST[kata_sandi]',
												 nama_lengkap = '$_POST[nama_lengkap]',
												 posisi = '$_POST[posisi]',
												 unit = '$_POST[unit]'
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
					$vnama = $data['email'];
					$vnim = $data['kata_sandi'];
					$vnamalengkap = $data['nama_lengkap'];
					$vposisi = $data['posisi'];
					$vunit = $data['unit'];
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
			include "session.php";
		
?>


<!DOCTYPE html>
<html>
<head>
	<title>EDIT DATA!</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!-- My CSS-->
    <link rel="stylesheet" href="style.css" />
	<!-- Bootstrap CSS -->
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- My CSS -->
    <link rel="stylesheet" href="stylewecare.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: rgb(221, 60, 60)">
      <div class="container">
        <a class="navbar-brand" href="page_admin.php">Dashboard Administrator</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="page_admin.php">Home</a>
            </li>
            <li class="nav-item">
              <div class="dropdown">
                <a class="nav-link active dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> WeCare </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="view.php">View</a></li>
                  <li><a class="dropdown-item" href="#">Update</a></li>
                </ul>
              </div>
            <li class="nav-item">
              <div class="dropdown">
                <a class="nav-link active dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> User Management </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="register.php">Create User</a></li>
                  <li><a class="dropdown-item" href="editupdatedata.php">Edit User</a></li>
                  <li><a class="dropdown-item" href="databaseuser.php">Data User</a></li>
                </ul>
              </div>
              <li class="nav-item">
                <a class="btn btn-dark" aria-current="page" href="logout.php">LOGOUT</a>
              </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Jumbotron -->
    <section class="jumbotron text-center">
      <img src="img/Logo We Care (3).png" alt="Logo We Care" width="200" class="rounded-circle" />
      <h1 class="display-4">WeCare Edit Data User</h1>
      <p class="lead">We Care More Than You Know.</p>
      <p class="lead">Edit Data User WeCare</p>
    </section>
    <!-- Akhir Jumbotron -->
	

<!--start update form -->
	<div class="card mt-5">
  	  <div class="card-header bg-info text-white">
    Edit Data User
  </div>
  <div class="card-body">
  	<form method="post" action=" ">
	  <div class="form-group font-weight-bold">
  			<label>Nama</label>
  			<input type="text" name="nama_lengkap" value="<?=@$vnamalengkap?>" class="form-control" required>
  		</div>
  		
  		<div class="form-group font-weight-bold">
  			<label>E-mail</label>
  			<input type="text" name="email" value="<?=@$vnama?>" class="form-control"  required>
  		</div>
  		<div class="form-group font-weight-bold">
  			<label>Password</label>
  			<input type="text" name="kata_sandi" value="<?=@$vnim?>" class="form-control" required>
  		</div>
		  <div class="form-group font-weight-bold">
  			<label>Posisi </label>
  			<select class="form-control" name="posisi" value="<?=@$vposisi?>" required>
  				<option value="Administrator">Administrator</option>
  				<option value="PIC Regional">PIC Regional</option>
				<option value="PIC Witel">PIC Witel</option>
  			</select>
  		</div>
		  <div class="form-group font-weight-bold">
  			<label>Unit </label>
  			<select class="form-control" name="unit" value="<?=@$vunit?>" required>
  				<option value="Unit MSO">Unit MSO</option>
  			</select>
  		</div>
  		
  		<button type="update" class="btn btn-primary" name="bupdate" onclick ="return confirm('Apakah data yang ingin diupdate sudah sesuai?')">Update</button>
  	</form>
  </div>
	</div>
<!-- end update form -->

<!--awal card tabel -->
<div class="card mt-5">
  	  <div class="card-header bg-success text-white">
    List Data 
	<a class="btn btn-warning" aria-current="page" href="databaseuser.php">Database</a>
  </div>
  <div class="card-body">
  	<table class="table table-bordered table-black-50">
  		<tr>
  			<th>No.</th>
  			<th>Nama</th>
  			<th>E-mail</th>
  			<th>Password</th>
  			<th>Role</th>
  			<th>Unit</th>
  		</tr>
  		<?php
  			$no = 1;
  			$tampil = mysqli_query($koneksi, "SELECT * from tadm order by id_adm desc");
  			while($data = mysqli_fetch_array($tampil)) :

  		?>
  		<tr>
  			<td><?=$no++;?></td>
  			<td><?=$data['nama_lengkap']?></td>
  			<td><?=$data['email']?></td>
  			<td><?=$data['kata_sandi']?></td>
  			<td><?=$data['posisi']?></td>
  			<td><?=$data['unit']?></td>
  			<td>
  				<a href="editupdatedata.php?hal=edit&id=<?=$data['id_adm']?>" onclick ="return confirm('Apakah anda yakin ingin mengedit data user ?')" class="btn btn-danger text-white"> EDIT </a>
  				<a href="editupdatedata.php?hal=hapus&id=<?=$data['id_adm']?>" onclick ="return confirm('Apakah anda yakin ingin mengahapus data user ?')" class="btn btn-dark"> HAPUS </a>
  			</td>
  		</tr>
  	<?php endwhile; //penutup while ?>
  	</table>
  </div>
	</div>
<!-- akhir card tabel -->

<p class="mt-5 mb-3 text-muted text-center">&copy; PT. Telkom Indonesia, Tbk 2021</p>

</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>	
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>