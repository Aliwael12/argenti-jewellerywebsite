<header>
    <a href="Home.php"><img src="photos/argenti-black.png"></a>
    <ul>
        <li><a href="Necklaces.php">Necklaces</a></li>
        <li><a href="Rings.php">Rings</a></li>
        <li><a href="Bracelets.php">Bracelets</a></li>
        <li><a href="Earrings.php">Earrings</a></li>
        <?php
        include 'db.php';

        if (isset($_SESSION['Admin'])) {
            echo '<li><a href="Admin.html"><img src="photos/login.png" alt="Admin" class="icon"></a></li>';
        } else if (isset($_SESSION['userName'])) {
            echo '<li><a href="Cart.php"><img src="photos/cart.png" class="icon"></a></li>';
            echo '<li><a href="userProfile.php"><img src="photos/login.png" class="icon"></a></li>';
        } else {
            echo '<li><a href="Login.php"><img src="photos/cart.png" class="icon"></a></li>';
            echo '<li><a href="Login.php"><img src="photos/login.png" class="icon"></a></li>';
        }
        ?>
    </ul>

    <style>
::-webkit-scrollbar {    width: 8px; }
::-webkit-scrollbar-track {    background: #f1f1f1;    border-radius: 10px; }
::-webkit-scrollbar-thumb {    background: #888;     border-radius: 10px; }
::-webkit-scrollbar-thumb:hover {    background: #555;}
.icon {    width: 24px;     height: 24px;}
</style>
</header>
