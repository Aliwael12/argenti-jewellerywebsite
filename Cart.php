<?php
function getCartFromCookies() {
    return isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
}

function saveCartToCookies($cart) {
    setcookie('cart', json_encode($cart), time() + (86400 * 30), "/"); 
}

$cart = getCartFromCookies();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['p_id'], $_POST['name'], $_POST['price'], $_POST['thumbnail'])) {
        $product_id = $_POST['p_id'];
        $product_name = $_POST['name'];
        $product_price = $_POST['price'];
        $product_image = $_POST['thumbnail'];

        $item_array = array(
            'p_id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'picture' => $product_image,
            'quantity' => 1 
        );

        $product_ids = array_column($cart, 'p_id');
        if (!in_array($product_id, $product_ids)) {
            $cart[] = $item_array;
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['p_id'])) {
    foreach ($cart as $key => $value) {
        if ($value["p_id"] == $_GET['p_id']) {
            unset($cart[$key]);
            echo "<script>alert('Product has been Removed...!')</script>";
            echo "<script>window.location = 'cart.php'</script>";
        }
    }
}

saveCartToCookies($cart);

$total = 0;
$items = "";
if ($cart) {
    foreach ($cart as $row) {
        $item_total = (int)$row['price'] * (int)$row['quantity'];
        $items .= "
        <tr>
            <td><a href='cart.php?action=remove&p_id={$row['p_id']}'><i class='fa-solid fa-trash-can'></i></a></td>
            <td><img src='{$row['picture']}' alt=''></td>
            <td><h5>{$row['name']}</h5></td>
            <td><h5>\${$row['price']}</h5></td>
            <td><input class='info quantity' type='number' value='{$row['quantity']}' data-price='{$row['price']}' data-pid='{$row['p_id']}' min='1'></td>
            <td class='total-item-price'><h5>\${$item_total}</h5></td>
        </tr>
        ";
        $total += $item_total;
    }
} else {
    $items = "<tr><td colspan='6'><h5>Cart is Empty</h5></td></tr>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="Draft.css">
    <script src="JV.js"></script>
    <link rel="icon" href="photos/favicon.ico.png" type="image/x-icon">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const quantityInputs = document.querySelectorAll('.quantity');

            quantityInputs.forEach(input => {
                input.addEventListener('change', (event) => {
                    const price = parseFloat(event.target.dataset.price);
                    const quantity = parseInt(event.target.value);
                    if (isNaN(quantity) || quantity < 1) {
                        event.target.value = 1;
                    }
                    const totalItemPrice = event.target.closest('tr').querySelector('.total-item-price h5');
                    
                    const itemTotal = price * parseInt(event.target.value);
                    totalItemPrice.textContent = `$${itemTotal.toFixed(2)}`;

                    updateCartTotal();
                });
            });

            function updateCartTotal() {
                let total = 0;
                const totalItemPrices = document.querySelectorAll('.total-item-price h5');
                totalItemPrices.forEach(priceElement => {
                    total += parseFloat(priceElement.textContent.replace('$', ''));
                });

                const shipping = 20;
                document.getElementById('cart-total').textContent = `$${total.toFixed(2)}`;
                document.getElementById('total-plus-shipping').textContent = `$${(total + shipping).toFixed(2)}`;
            }
        });
    </script>
</head>
<body>
<?php include 'header.php'; ?>

<section class="banner" style="margin-top -100px;">
    <div class="ordersum">
        <h3 class="title">Order Summary</h3>
        <hr style="width: auto">
    </div>
    <section id="cart" class="cont">
        <table style="width: 100%;">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php echo $items; ?>
            </tbody>
        </table>
    </section>
    <section id="card-add">
        <div id="total">
            <h2 style="font-size: 40px;">Summary</h2>
            <table>
                <tr>
                    <td>Cart Total</td>
                    <td id="cart-total">$<?php echo number_format($total, 2); ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>$20</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td id="total-plus-shipping"><strong>$<?php echo number_format($total + 20, 2); ?></strong></td>
                </tr>
            </table>
            <button onclick="window.location.href='payment.php'" class="addprdctbtn">Proceed to Checkout</button>
        </div>
    </section>
</section>

<div class="wrapper" style="margin-top: 60px"></div>

<div style="margin-top: 500px;">
    <hr style="width: auto;">
    <?php include 'footer.php'; ?>
</div>
</body>
</html>
