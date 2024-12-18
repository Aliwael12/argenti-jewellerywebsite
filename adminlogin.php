<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet"  href="Draft.css" >
    <link rel="icon" href="photos/favicon.ico.png" type="image/x-icon">
</head>

<body>
   <header>
       <a href="Home.html" style="margin-left: 550px; margin-top: 180px;" class="logo">Argenti</a>
   </header>

  
   <?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli("localhost", "root", "", "argenti");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM admin WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($stored_password);

    if ($stmt->fetch() && $password === $stored_password) {
        $_SESSION['Admin'] = $email; 
        header('Location: Admin.html');
        exit;
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>

 <div class="center";>
    <form id="login2" style="margin-left: 550px; margin-top: 150px;" class="input" method="POST">
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <input type="text" class="output" name="email" placeholder="Email" required>
        <input type="password" class="output" name="password" placeholder="Password" id="loginPassword" required>
        <div class="eye-icon" onclick="togglePasswordVisibility('loginPassword', 'loginEyeIcon')">
            <i class="fa fa-eye" id="loginEyeIcon"></i>
        </div>
        <input type="checkbox" class="check"><span> Remember Password</span>
        <button type="submit" class="submit">Login</button>
    </form>
</div>

<?php include 'footer.php'; ?>

   <script src="JV.js"></script>

</body>
</html>
