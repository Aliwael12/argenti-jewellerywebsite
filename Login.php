<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet"  href="Draft.css" >
    <link rel="icon" href="photos/favicon.ico.png" type="image/x-icon">;
</head>
</head>

<body>
    
   <header>
    <a href="Home.php" class="logo">Argenti</a>
    <ul>
    <li><a href="adminlogin.php">Owner? Login As Admin</a></li>  
    </ul>

    
                <?php
            session_start();

            $error = '';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $conn = new mysqli("localhost", "root", "", "argenti");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if (isset($_POST['login2'])) {

                $email = $_POST['email'];
                $password = $_POST['password'];

                $stmt = $conn->prepare("SELECT password FROM customer WHERE email = ?");

                if (!$stmt) {
                    die("Prepare failed: " . $conn->error); 
                }

                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($stored_password);

                if ($stmt->fetch() && $password === $stored_password) {
                    $_SESSION['userName'] = $email;
                    header('Location: Home.php');
                    exit;
                } else {
                    $error = "Invalid username or password";
                }

                $stmt->close();
            }

                elseif (isset($_POST['signup'])) {
                    $F_name = $conn->real_escape_string($_POST['F_name']);
                    $L_name = $conn->real_escape_string($_POST['L_name']);
                    $email = $conn->real_escape_string($_POST['email']);
                    $password = $conn->real_escape_string($_POST['password']);

                        $stmt = $conn->prepare("INSERT INTO customer (F_name, L_name, email, password) VALUES (?, ?, ?, ?)");
                        if (!$stmt) {
                            die("Prepare failed: " . $conn->error);
                        }
                        $stmt->bind_param("ssss", $F_name, $L_name, $email, $password);
            
                        if ($stmt->execute()) {
                            $_SESSION['UserName'] = $F_name;
                            header('Location: Home.php?accountCreated=true');
                            exit;
                        } else {
                            $error = "Error: " . $stmt->error;
                        }
            
                   $stmt->close();
                    
                }
            
                $conn->close();
            }
        
?>

    </header>
    <section  class="banner">
       <div class=login>
     <div class=form>
        <div class=button-box>
           <div>
              <div id="btnn">
                  
              </div>
               <button type="button" class="btn" onclick="login2()">Login</button>
               <button type="button" class="btn" onclick="signup()">Sign up </button>
               
           </div>
           </div>
            <div class="media">
              <img src="photos/face%20book.png" alt="" width="30">
               <img src="photos/twitter.png" alt="" width="30">
                <img src="photos/gmail.png" alt="" width="30">
               
        </div>


        <form id="login2" class="input" method="POST">
           <?php if ($error): ?>
               <p style="color: red;"><?php echo $error; ?></p>
           <?php endif; ?>
           <input type="text" class="output" name="email" placeholder="Email" required>
           <input type="password" class="output" name="password" placeholder="Password" id="loginPassword" required>
           <div class="eye-icon" onclick="togglePasswordVisibility('loginPassword', 'loginEyeIcon')">
               <i class="fa fa-eye" id="loginEyeIcon"></i>
           </div>
           <input type="checkbox" class="check"><span> Remember Password</span>
           <button type="submit" name="login2" class="submit">Login</button>
       </form>


        
        <form id=signup class=input method="POST" onsubmit="return validatePasswords()">
            <input type="Fname" name ="F_name" class=output placeholder="First name" required>
            <input type="Lname" name ="L_name" class=output placeholder="Last name" required>
            <input type="email" name ="email" class=output placeholder="Email" required>
            <input type="password" name ="password" class="output" placeholder="Password" id="signupPassword" required>
            <div class="eye-icon" onclick="togglePasswordVisibility('signupPassword', 'signupEyeIcon')">
                <i class="fa fa-eye" id="signupEyeIcon"></i>
            </div>
            <input type="password" name="confirm_password" class="output" placeholder="Confirm Password" id="confirmPassword" required>
            <div class="eye-icon" onclick="togglePasswordVisibility('confirmPassword', 'confirmEyeIcon')">
                <i class="fa fa-eye" id="confirmEyeIcon"></i>
            </div>            
            <input type="checkbox" id="termsCheckbox" class=check><span>I agree to the terms & conditions</span>
            <button type="submit" name="signup" class="submit"> Sign Up</button>
            
        </form> 
        <script>

function validatePasswords() {
    var password = document.getElementById("signupPassword").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var checkbox = document.getElementById('termsCheckbox');

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false; 
    }

    if (!checkbox.checked) {
        alert("You must agree to the terms & conditions.");
        return false;
    }


    return true; 
}
</script>
         
     </div>
     
   </div>
        </section>
    <div class="wrapper" style="margin-top: 180px;">
    </div>
    

        <hr style="width: auto">

<?php include 'footer.php'; ?>
            <script src="JV.js"></script>
    
    </body>
    </html>