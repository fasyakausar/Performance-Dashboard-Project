<?php
    session_start();

    if(empty($_SESSION['user']) or empty($_SESSION['posisi']))
    {
        echo "<script>
		alert('Maaf anda belum melakukan login, terima kasih');
		document.location='menulogin.php';
		 </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PIC Witel</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <div class="jumbotron">
  <h1 class="display-4">Hello, <b><?=$_SESSION['nama_lengkap'] ?></b></h1>
  <p class="lead">Selamat datang anda berhasil Login sebagai <b><?=$_SESSION['user']?></b></p>
  <hr class="my-4">
  <a class="btn btn-dark btn-lg" href="logout.php" role="button">Log Out</a>
</div>
    </div>
</body>
</html>