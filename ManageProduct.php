<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="photos/favicon.ico.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
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
            <h1>Manage Products</h1>
            <button onclick="window.location.href='admin.html';" class="btn">Back</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Thumbnail</th>
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

                function getProducts() {
                    $conn = connectDB();
                    $sql = "SELECT * FROM product";
                    $result = mysqli_query($conn, $sql);
                    mysqli_close($conn);
                    return $result;
                }

                $products = getProducts();
                if (mysqli_num_rows($products) > 0) {
                    while($row = mysqli_fetch_assoc($products)) {
                        echo "<tr>";
                        echo "<td>" . $row["p_id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["category"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td><img src='" . $row["thumbnail"] . "' alt='Thumbnail' style='width: 50px; height: 50px;'></td>"; // Displaying Thumbnail
                        echo "<td>
                                <form action='ManageProduct.php' method='post' style='display: inline;'>
                                    <input type='hidden' name='edit_id' value='" . $row["p_id"] . "'>
                                    <input type='number' name='new_price' placeholder='New Price' required>
                                    <button type='submit' name='edit_btn' class='btn'>Edit Price</button>
                                </form>
                                <form action='ManageProduct.php' method='post' style='display: inline;'>
                                    <input type='hidden' name='delete_id' value='" . $row["p_id"] . "'>
                                    <button type='submit' name='delete_btn' class='btn'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No products found</td></tr>";
                }

                if (isset($_POST['delete_btn'])) {
                    $delete_id = $_POST['delete_id'];
                    $conn = connectDB();
                    $sql = "DELETE FROM product WHERE p_id='$delete_id'";
                    if (mysqli_query($conn, $sql)) {
                        echo '<script>alert("Product deleted successfully");</script>';
                    } else {
                        echo "Error deleting record: " . mysqli_error($conn);
                    }
                    mysqli_close($conn);
                    echo "<meta http-equiv='refresh' content='0'>";
                }

                if (isset($_POST['edit_btn'])) {
                    $edit_id = $_POST['edit_id'];
                    $new_price = $_POST['new_price'];
                    $conn = connectDB();
                    $sql = "UPDATE product SET price='$new_price' WHERE p_id='$edit_id'";
                    if (mysqli_query($conn, $sql)) {
                        echo '<script>alert("Product price updated successfully");</script>';
                    } else {
                        echo "Error updating record: " . mysqli_error($conn);
                    }
                    mysqli_close($conn);
                    echo "<meta http-equiv='refresh' content='0'>";
                }

                if (isset($_POST['add_product'])) {
                    $name = $_POST['name'];
                    $category = $_POST['category'];
                    $price = $_POST['price'];
                    $thumbnail = $_POST['thumbnail'];

                    $conn = connectDB();
                    $sql = "INSERT INTO product (name, category, price, thumbnail) VALUES ('$name', '$category', '$price', '$thumbnail')";
                    if (mysqli_query($conn, $sql)) {
                        echo '<script>alert("Product added successfully");</script>';
                    } else {
                        echo "Error adding record: " . mysqli_error($conn);
                    }
                    mysqli_close($conn);
                    echo "<meta http-equiv='refresh' content='0'>";
                }
            ?>
            </tbody>
        </table>

        <button id="addProductBtn" class="btn" onclick="toggleForm()">Add Product</button>

        <div id="addProductForm" style="display: none;">
            <h2>Add New Product</h2>
            <form action="ManageProduct.php" method="post">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" required>
                
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>
                
                <label for="thumbnail">Thumbnail Path:</label>
                <input type="text" id="thumbnail" name="thumbnail" required>
                
                <button type="submit" name="add_product" class="btn">Add Product</button>
            </form>
        </div>
    </div>

    <script>
        function toggleForm() {
            const form = document.getElementById('addProductForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>
