<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        header {
            overflow: hidden;
            background-color: #f1f1f1;
            padding: 10px 10px;
            position: fixed;
            z-index: 10000;
            top: 0;
            left: 0;
            right: 0;
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
            font-size: 17px;
            padding: 7px 13px;
            border-radius: 3px;
            text-transform: uppercase;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
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
         #cart_count{
            text-align: center;
            padding: 0rem 0.4rem 0.1rem 0.4rem;
            border-radius: 50%;
            color: white;
            background-color: thistle;
            position: relative;
            top:-1.2em;
            left: -1.5ex;
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
</head>

<body>
    <header>
        <img src="images/Amethystlogo.png" width="170px">
        <ul>
            <li><a  href="Customer Home.php">Home</a></li>
            <li><a href="Customer Home.php#Products">Products</a></li>
            <li><a href="Contact Us.php">Contact Us</a></li>
            <li><a href="Admin Login.php">Log In</a></li>
            <li>
                <a href="<?php echo $cart?>"> <img src="images/cart.png" width="30px" height="30px">
                    <?php
                    if(isset($_SESSION['cart'])){             

                        $count=array_sum(array_column($_SESSION['cart'], 'quantity')); 
                      
                        echo "<span id='cart_count'>$count</span>";
                    }else{
                         echo "<span id='cart_count'>0</span>";
                    }
                  
                   ?>
                </a>      
            </li>
        </ul>
    </header>
</body>

</html>