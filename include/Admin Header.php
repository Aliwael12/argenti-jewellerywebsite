<!-- Lama Al-Ghamdi - 2190002418 -->

<head>
    <meta charset="UTF-8">
    <style>
        body {
            margin-top: 200px;
            padding: 10px 10px;
            font-family: 'Poppins', sans-serif;
        }

        header {
            overflow: hidden;
            background-color: #f1f1f1;
            padding: 10px 10px;
            position: fixed;
            z-index: 10000;
            top: 0;
            left: 0;
            right: 0;
            margin: 10px;
            margin-top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.6s;
        }


        /*header menu items*/

        header ul {
            float: right;
            margin-right: 20px;
        }

        header ul li {
            display: inline-block;
            line-height: 80px;
            margin: 0 5px;
        }

        header ul li a {
            color: black;
            padding: 7px 13px;
            border-radius: 3px;
            text-transform: uppercase;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 12pt;
            line-height: 25px;
            border-radius: 4px;
        }


        /* activate current link*/

        a.active {
            background-color: #af93ad;
            color: white;
            transition: .5s;
        }


        /* Change the background color when hover */

        a:hover {
            background-color: #ddd;
            color: black;
            transition: .5s;
        }

        .name {
            float: left;
            position: relative;
            left: 0px;
            color: #461c4b;
            background: #f1f1f1;
        }
    </style>


    <script type="text/javascript">
        function start() {
            const currentLocation = window.location.href.split("/").pop();
            const menuItem = document.querySelectorAll('a');
            const menuLength = menuItem.length;

            for (let i = 0; i < menuLength; i++) {
                if (menuItem[i].href.split("/").pop() == currentLocation) {
                    menuItem[i].className = "active";
                }
            }
        }
        window.addEventListener("load", start, false);
    </script>

    <?php session_start() ?>
</head>

<body>
    <header>
        <img src="images/Amethystlogo.png" alt="Amethyst Logo" width="170px">
        <h2 class="name">
            <?php
            if (isset($_SESSION['Admin_Fname']) && isset($_SESSION['Admin_Lname']) && (!isset($_GET['logout']))) {
                echo ("Welcome " . $_SESSION['Admin_Fname'] . " " . $_SESSION['Admin_Lname']);
            } else {
                header('location: Admin Login.php');
            }
            ?></h2>
        <ul>
            <li><a href="Admin Home.php">Home</a></li>
            <li><a onclick="location.replace('Admin Home.php#Products'); window.location.reload();" href="Admin Home.php#Products">Products</a></li>
            <li><a href="Add Products.php">Add Products</a></li>
            <li><a href="Customer%20Service.php">Customer Service</a></li>
            <li><a href="?logout=1">Log Out</a></li>

            <?php

            if (isset($_SESSION['Admin_Fname']) && isset($_SESSION['Admin_Lname']) && (isset($_GET['logout']))) {

                if ($_GET['logout'] == 1) {
                    $_SESSION = array();
                    session_destroy();
                    header('location: Customer Home.php');
                }
            }
            ?>
        </ul>
    </header>
</body>

</html>