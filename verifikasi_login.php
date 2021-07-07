<?php

//pangil koneksi database
include "koneksi_login.php";

$pass = md5($_POST['password']);
$username = mysqli_escape_string($koneksi, $_POST['user']);
$password = mysqli_escape_string($koneksi, $pass);
$level = mysqli_escape_string($koneksi, $_POST['level']);

//cek username terdaftar atau tidak
$cek_user = mysqli_query($koneksi, "SELECT * FROM tadm WHERE user = '$username' and level='$level' ");
$user_valid = mysqli_fetch_array($cek_user);

//menguji jika username terdaftar

if($user_valid)
{
    //jika username terdaftar
    //cek password sesuai atau tidak
    if($password == $user_valid['password'])
    {
        //jika password sesuai
        //buat session
        session_start();
        $_SESSION['user'] = $user_valid['user'];
        $_SESSION['nama_lengkap'] = $user_valid['nama_lengkap'];
        $_SESSION['level'] = $user_valid['level'];

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
