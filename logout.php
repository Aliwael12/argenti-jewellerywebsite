<?php
session_start();
session_unset();
session_destroy();
if (isset($_COOKIE['cart'])) {
    setcookie('cart', '', time() - 3600, '/'); 
}
header("Location: Home.php");
exit;
?>
