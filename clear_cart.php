<?php
session_start();

if (isset($_COOKIE['cart'])) {
    setcookie('cart', '', time() - 3600, '/'); 
}

header("Location: Home.php?paymentSuccess=true");
exit;
?>
