<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Draft.css">
    <script src="JV.js"></script>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="icon" href="photos/favicon.ico.png" type="image/x-icon">
    <style>
        .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background: #fff;
            border-radius: 8px;
            margin-left: 450px; 
        }
        .change-password, .logout-form {
            text-align: center; 
            margin-bottom: 20px;
        }
        .change-password label,
        .change-password input {
            display: block;
            width: 100%;
            text-align: left;
            margin-bottom: 10px;
        }
        .change-password input {
            padding: 8px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }
        .addprdctbtn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
        }
        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .form-header h3 {
            margin: 0;
            font-size: 24px;
        }
        .greeting {
            font-size: 16px;
            font-weight: bold;
            color: #4CAF50; 
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<?php
if (!isset($_SESSION['userName'])) {
    header("Location: userProfile.php");
    exit;
}

$userName = $_SESSION['userName'];
$sql = "SELECT F_name FROM customer WHERE email='$userName'";
$result = $conn->query($sql);

$firstName = "User"; 
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstName = $row['F_name'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('New password and confirm password do not match. Please try again.');</script>";
    } else {
        $sql = "SELECT password FROM customer WHERE email='$userName'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedPassword = $row['password'];

            if ($currentPassword === $storedPassword) {
                $updateSql = "UPDATE customer SET password='$newPassword' WHERE email='$userName'";
                if ($conn->query($updateSql) === TRUE) {
                    echo "<script>alert('Password updated successfully.');</script>";
                } else {
                    echo "<script>alert('Error updating password: " . $conn->error . "');</script>";
                }
            } else {
                echo "<script>alert('Incorrect current password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('User not found.');</script>";
        }
    }
}

$conn->close();
?>

    <div class="wrapper">
        <div class="container">
            <div class="change-password">
                <div class="form-header">
                    <h3 class="section-title">Change Password</h3>
                    <span class="greeting">Hello, <?php echo htmlspecialchars($firstName); ?>!</span>
                </div>
                <form action="userProfile.php" method="post">
                    <label for="current-password">Current Password:</label>
                    <input type="password" id="current-password" name="current-password" required><br><br>
                    <label for="new-password">New Password:</label>
                    <input type="password" id="new-password" name="new-password" required><br><br>
                    <label for="confirm-password">Confirm New Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required><br><br>
                    <button type="submit" name="change_password" class="addprdctbtn">Change Password</button>
                </form>
            </div>

            <form action="logout.php" method="post" class="logout-form">
                <button type="submit" name="logout" class="addprdctbtn">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
