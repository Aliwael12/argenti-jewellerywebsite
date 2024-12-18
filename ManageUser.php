<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="photos/favicon.ico.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="Draft.css">
    <style>
        .btn {
            background-color: #f44336;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin: 5px;
        }
        .btn:hover {
            background-color: #d32f2f;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <h1>Manage Users</h1>
            <button onclick="window.location.href='admin.html';" class="btn">Back</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                function connectDB() {
                    $conn = mysqli_connect("localhost", "root", "", "argenti");
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    return $conn;
                }

                function getUsers() {
                    $conn = connectDB();
                    $sql = "SELECT * FROM customer";
                    $result = mysqli_query($conn, $sql);
                    mysqli_close($conn);
                    return $result;
                }

                $users = getUsers();
                if (mysqli_num_rows($users) > 0) {
                    while($row = mysqli_fetch_assoc($users)) {
                        echo "<tr>";
                        echo "<td>" . $row["customer_id"] . "</td>";
                        echo "<td>" . $row["F_name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["password"] . "</td>";
                        echo "<td>
                                <form action='ManageUser.php' method='post'>
                                    <input type='hidden' name='delete_id' value='" . $row["customer_id"] . "'>
                                    <button type='submit' name='delete_btn' class='btn delete-btn'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }

                if (isset($_POST['delete_btn'])) {
                    $delete_id = $_POST['delete_id'];
                    $conn = connectDB();
                    $sql = "DELETE FROM customer WHERE customer_id='$delete_id'";
                    if (mysqli_query($conn, $sql)) {
                        echo '<script>alert("User deleted successfully");</script>';
                    } else {
                        echo "Error deleting record: " . mysqli_error($conn);
                    }
                    mysqli_close($conn);
                    echo "<meta http-equiv='refresh' content='0'>";
                }
            ?>
            </tbody>
        </table>

        <button class="btn" onclick="window.location.href='add_user.php'">Add User</button>
    </div>
</body>
</html>
