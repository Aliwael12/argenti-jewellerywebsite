<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="photos/favicon.ico.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="Draft.css">
    
</head>
<body>
    <div class="container">
        <h1>Add User</h1>
        <?php
          session_start();

          $error = '';

          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              $conn = new mysqli("localhost", "root", "", "argenti");

              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }
              
            $F_name = $_POST['F_name'];
            $L_name = $_POST['L_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "INSERT INTO customer (F_name, L_name, email, password) VALUES ('$F_name', '$L_name', '$email', '$password')";

            if (mysqli_query($conn, $sql)) {
                echo "New user added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        ?>
        <?php } else { ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="name">First name:</label>
                <input type="text" id="First name" name="F_name" required><br><br>
                <label for="L_name">Last name:</label>
                <input type="text" id="Last name" name="L_name" required><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>
                
                <button type="submit" class="addprdctbtn">Confirm</button>
            </form>
        <?php } ?>
    </div>
</body>
</html>