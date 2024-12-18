<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="photos/favicon.ico.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <script>
      function validateForm() {
    const cardholderName = document.getElementById('cardholdername').value.trim();
    const cardNumber = document.getElementById('cardnumber').value.replace(/\s+/g, '');
    const expiryDate = document.getElementById('expirydate').value.trim();
    const cvv = document.getElementById('cvv').value.trim();

    if (cardholderName.length < 3) {
        alert('Cardholder name must be at least 3 characters long.');
        return false;
    }

    if (!/^\d{16}$/.test(cardNumber)) {
        alert('Card number must be exactly 16 digits.');
        return false;
    }

    const expiryDatePattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
    if (!expiryDatePattern.test(expiryDate)) {
        alert('Expiry date must be in MM/YY format.');
        return false;
    }

    if (!/^\d{3}$/.test(cvv)) {
        alert('CVV must be exactly 3 digits.');
        return false;
    }

    const paymentSuccess = true; 

    if (paymentSuccess) {
        window.location.href = 'clear_cart.php';
        return false; 
    }

    return false; 
}

    </script>
</head>
<body>
    <div class="container">
        <h2>Payment Checkout</h2>
        <form onsubmit="return validateForm()">
            <div class="form-group">
                <label for="cardholdername">Cardholder Name:</label>
                <input type="text" id="cardholdername" name="cardholdername" required>
            </div>
            <div class="form-group">
                <label for="cardnumber">Card Number:</label>
                <input type="text" id="cardnumber" name="cardnumber" required>
            </div>
            <div class="form-group">
                <label for="expirydate">Expiry Date:</label>
                <input type="text" id="expirydate" name="expirydate" placeholder="MM/YY" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Pay Now">
            </div>
        </form>
    </div>
</body>
</html>
