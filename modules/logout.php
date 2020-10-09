<?php
 ob_start();
 session_start();
 unset($_SESSION['korisnik']);
 header("Location: ../index.php?page=home");
?>
