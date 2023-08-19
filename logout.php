<?php
session_start();
// hapus session
session_destroy();

// alihkan ke halaman login (indexl.php) dan berikan alert = 2
header('Location: login.php?alert=2');
?>