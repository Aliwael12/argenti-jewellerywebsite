<!DOCTYPE html>
<html lang="en">
<head>
    <title>Earrings</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="Draft.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="JV.js"></script>
    <link rel="icon" href="photos/favicon.ico.png" type="image/x-icon">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .wrapper {
            flex: 1;
            padding: 40px 0; 
        }

        .banner {
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }

        .row55 {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 0 auto;
            max-width: 1200px; 
        }

        .column55 {
            flex: 0 0 calc(33.33% - 20px); 
            box-sizing: border-box;
        }

        .card55 {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            background-color: #fff;
            padding: 15px;
        }

        .card55 img {
            width: 100%;
            height: auto;
        }

        .container55 {
            margin-top: 10px;
        }

        .zorar {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="wrapper">
        <section class="banner">
            <h1>Earrings</h1>
            <div class="row55">
                <?php
             
                $sql = "SELECT p_id, name, price, thumbnail FROM product WHERE name IN ('earring1', 'earring2', 'earring3', 'earring4', 'earring5', 'earring6')";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <div class='column55'>
                            <div class='card55'>
                                <img src='" . $row['thumbnail'] . "' alt='earring'>
                                <div class='container55'>
                                    <p><strong>Price: $" . $row['price'] . "</strong></p>
                                    <form action='cart.php' method='POST'>
                                        <input type='hidden' name='p_id' value='" . $row['p_id'] . "'>
                                        <input type='hidden' name='name' value='" . $row['name'] . "'>
                                        <input type='hidden' name='price' value='" . $row['price'] . "'>
                                        <input type='hidden' name='thumbnail' value='" . $row['thumbnail'] . "'>
                                        <button class='zorar' type='submit'>+ Add To Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>";
                    }
                } else {
                    echo "<p>No products available.</p>";
                }
                $conn->close();
                ?>
            </div>
        </section>
    </div>

    
<div style="margin-top: 1000px;">
    <hr style="width: auto;">


    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <script src="JV.js"></script>
</body>
</html>
