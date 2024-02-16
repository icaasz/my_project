<?php
session_start();
session_unset();
session_destroy();



// Redirect ke halaman signin
header("Location:../2. Sign in/sign_in.php");
exit();
?>