<?php

session_start();
unset($_SESSION['user']);
unset($_SESSION['pass']);
unset($_SESSION['nama_lengkap']);
unset($_SESSION['posisi']);

session_destroy();
echo "<script>alert('Anda Telah Logout Sebagai Administrator');document.location='menulogin.php' </script>";