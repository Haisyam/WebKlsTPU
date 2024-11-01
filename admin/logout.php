<?php
// Mulai session
session_start();

// Hapus semua variabel session
session_unset();

// Hancurkan session
session_destroy();

// Redirect ke halaman login atau halaman lain setelah logout
header("Location: login.php");
exit;
