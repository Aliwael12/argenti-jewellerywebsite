<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="Draft.css">

<link rel="icon" href="photos/favicon.ico.png" type="image/x-icon">

</head>
    
<body>
    
    
    
<?php include 'header.php'; ?>

    
    <a href="browse.php" class="browse-button">BROWSE</a>

    <div class="wrapper">
    </div>

  <div class="slideshow-container">
      <div class="mySlides fade">
          <img src="photos/ring1.jpg" style="width:90%;">
      </div>

     <div class="mySlides fade">
       <img src="photos/necklace1.jpg"  style="width:90%;">
     </div>

     <div class="mySlides fade">
       <img src="photos/earring1.jpg"  style="width:90%;">
      </div>
       <div class="mySlides fade">
           <img src="photos/bracelet3.jpg"  style="width:90%;">
      </div>

      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
 </div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
            
    
    </div>
   
        <div style="margin-top: 100px;">
    <h1 style="text-align: center; font-weight: 100; font-size: 35px; color:black;">F E A T U R E D &emsp; P R O D U C T S</h1> <br>
<hr style="width: auto;">
</div>

<?php
function featuredProducts($category, $conn) {
    $sql = "SELECT p_id, name, price, thumbnail FROM product WHERE category = ? ORDER BY price DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

$necklace = featuredProducts('necklace', $conn);
$bracelet = featuredProducts('bracelet', $conn);
$ring = featuredProducts('ring', $conn);

echo "
<div class='row55'>
    <div class='column55'>
        <div class='card55'>
            <div class='container55'>
                <img src='" . $necklace['thumbnail'] . "' alt='Necklace' style='width: 200px; height: 200px; margin-top: 10px;'>
                <p><strong>Price: $" . $necklace['price'] . "</strong></p>
                <form action='cart.php' method='POST'>
                    <input type='hidden' name='p_id' value='" . $necklace['p_id'] . "'>
                    <input type='hidden' name='name' value='" . $necklace['name'] . "'>
                    <input type='hidden' name='price' value='" . $necklace['price'] . "'>
                    <input type='hidden' name='thumbnail' value='" . $necklace['thumbnail'] . "'>
                    <button class='zorar' type='submit'>+ Add To Cart</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class='column55'>
        <div class='card55'>
            <div class='container55'>
                <img src='" . $bracelet['thumbnail'] . "' alt='Bracelet' style='width: 200px; height: 200px; margin-top: 10px;'>
                <p><strong>Price: $" . $bracelet['price'] . "</strong></p>
                <form action='cart.php' method='POST'>
                    <input type='hidden' name='p_id' value='" . $bracelet['p_id'] . "'>
                    <input type='hidden' name='name' value='" . $bracelet['name'] . "'>
                    <input type='hidden' name='price' value='" . $bracelet['price'] . "'>
                    <input type='hidden' name='thumbnail' value='" . $bracelet['thumbnail'] . "'>
                    <button class='zorar' type='submit'>+ Add To Cart</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class='column55'>
        <div class='card55'>
            <div class='container55'>
                <img src='" . $ring['thumbnail'] . "' alt='Ring' style='width: 200px; height: 200px; margin-top: 10px;'>
                <p><strong>Price: $" . $ring['price'] . "</strong></p>
                <form action='cart.php' method='POST'>
                    <input type='hidden' name='p_id' value='" . $ring['p_id'] . "'>
                    <input type='hidden' name='name' value='" . $ring['name'] . "'>
                    <input type='hidden' name='price' value='" . $ring['price'] . "'>
                    <input type='hidden' name='thumbnail' value='" . $ring['thumbnail'] . "'>
                    <button class='zorar' type='submit'>+ Add To Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>
";

$conn->close();
?>



    <br><br>
    
    
    
    <hr style="width: auto">

<?php include 'footer.php'; ?>

        <script src="JV.js"></script>

        <script>
    console.log("Script running...");

    const urlParams = new URLSearchParams(window.location.search);

    const accountCreated = urlParams.get('accountCreated');
    const paymentSuccess = urlParams.get('paymentSuccess');
    
    console.log("accountCreated:", accountCreated);
    console.log("paymentSuccess:", paymentSuccess);

    if (accountCreated === 'true') {
        console.log("Creating account alert");
        const alert = document.createElement('div');
        alert.textContent = 'Account created successfully, please verify your account and login.';
        alert.style.position = 'fixed';
        alert.style.top = '20px';
        alert.style.right = '20px';
        alert.style.backgroundColor = '#4CAF50';
        alert.style.color = 'white';
        alert.style.padding = '10px';
        alert.style.borderRadius = '5px';
        alert.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        document.body.appendChild(alert);

        setTimeout(() => {
            alert.remove();
        }, 4000);
    }

    if (paymentSuccess === 'true') {
        console.log("Creating payment alert");
        const alert = document.createElement('div');
        alert.textContent = 'Payment successful! An email with the receipt will be sent to you shortly.';
        alert.style.position = 'fixed';
        alert.style.top = '20px';
        alert.style.right = '20px';
        alert.style.backgroundColor = '#4CAF50';
        alert.style.color = 'white';
        alert.style.padding = '10px';
        alert.style.borderRadius = '5px';
        alert.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        document.body.appendChild(alert);

        setTimeout(() => {
            alert.remove();
        }, 4000);
    }
</script>


</body>
</html>