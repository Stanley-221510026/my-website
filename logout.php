<?php
session_start();
session_unset();      // Hapus semua variabel session
session_destroy();    // Hancurkan session
header("Location: auth.php");  // Arahkan kembali ke halaman login
exit();
