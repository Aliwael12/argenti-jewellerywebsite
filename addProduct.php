<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Product</title>
</head>
<body>
<?php
$p_id = $name = $category = $price = "";
$p_id_err = $name_err = $category_err = $price_err = "";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "argenti";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["p_id"]))) {
        $p_id_err = "Please enter product ID.";
    } else {
        $p_id = trim($_POST["p_id"]);
    }

    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter product name.";
    } else {
        $name = trim($_POST["name"]);
    }

    if (empty(trim($_POST["category"]))) {
        $category_err = "Please enter product category.";
    } else {
        $category = trim($_POST["category"]);
    }

    if (empty(trim($_POST["price"]))) {
        $price_err = "Please enter product price.";
    } else {
        $price = trim($_POST["price"]);
    }

    if (empty($p_id_err) && empty($name_err) && empty($category_err) && empty($price_err)) {
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO product (p_id, name, category, price) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        $stmt->bind_param("sssd", $p_id, $name, $category, $price);

        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<h2>Add Product</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <label for="p_id">Product ID:</label><br>
    <input type="text" id="p_id" name="p_id" required><br>
    <span class="error"><?php echo $p_id_err; ?></span><br>
    
    <label for="name">Product Name:</label><br>
    <input type="text" id="name" name="name" required><br>
    <span class="error"><?php echo $name_err; ?></span><br>
    
    <label for="category">Product Category:</label><br>
    <input type="text" id="category" name="category" required><br>
    <span class="error"><?php echo $category_err; ?></span><br>
    
    <label for="price">Product Price:</label><br>
    <input type="number" id="price" name="price" step="0.01" required><br>
    <span class="error"><?php echo $price_err; ?></span><br>
    
    <input type="submit" value="Add Product">
</form>
</body>
</html>