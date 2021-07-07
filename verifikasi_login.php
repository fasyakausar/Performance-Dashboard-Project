<?php

//pangil koneksi database
include "koneksi_login.php";

$pass = $_POST['pass'];
$username = mysqli_escape_string($koneksi, $_POST['user']);
$pass = mysqli_escape_string($koneksi, $pass);
$level = mysqli_escape_string($koneksi, $_POST['posisi']);

//cek username terdaftar atau tidak
$cek_user = mysqli_query($koneksi, "SELECT * FROM tadm WHERE user = '$username' and posisi='$level' ");
$user_valid = mysqli_fetch_array($cek_user);

//menguji jika username terdaftar

if($user_valid)
{
    //jika username terdaftar
    //cek password sesuai atau tidak
    if($pass == $user_valid['pass'])
    {
        //jika password sesuai
        //buat session
        session_start();
        $_SESSION['user'] = $user_valid['user'];
        $_SESSION['nama_lengkap'] = $user_valid['nama_lengkap'];
        $_SESSION['posisi'] = $user_valid['posisi'];

        //pengujian level user
        if($level == "PIC Regional")
        {
            header('location:home_picregion.php');
        }
        if ($level == "PIC Witel")
        {
            header('location:home_picwitel.php');
        }
        if ($level == "Administrator")
        {
            header('location:editupdatedata.php');
        }
    }
    else{
        echo "<script>
		alert('Login Gagal Password Tidak Sesuai');
		document.location='menulogin.php';
		 </script>";
    }
    }
    else {
    echo "<script>
    alert('Login Gagal Username Tidak Terdaftar');
    document.location='menulogin.php';
    </script>";
    }
?>
