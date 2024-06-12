<?php




// Simulate a cart array for demonstration purposes
$query = "SELECT *
    FROM cartitems c
    JOIN products p ON c.ProductID = p.ProductID
    WHERE c.UserID = $adminId";

$result = $conn->query($query);
if ($result === false) {
    // Handle the error
    die('Query execution failed: ' . $conn->error);
}

$cartItems = $result->fetch_all(MYSQLI_ASSOC);

// Calculate total price
$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['Price'] * $item['Quantity'];
}
?>

<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" data-bs-scroll="false" tabindex="-1" id="Id2"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel">Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <hr>
        <div id="cart-items">
            <?php foreach ($cartItems as $item): ?>
                <div class='row align-items-center cart-item' style='justify-content:center;flex-wrap: nowrap; ' data-id='<?= $item['CartItemID'] ?>'
                    data-price='<?= $item['Price'] ?>'>
                    <div class='col-4 px-5'>
                        <img src='../uploads/<?= $item['ProductImage'] ?>' class='rounded-2'
                            style='width: 100px; height: 100px; object-fit: cover;'>
                    </div>
                    <div class='col-auto'>
                        <div class='text-center'>
                            <div><strong><?= $item['Name'] ?></strong></div>
                            <div><strong>Prix :</strong><?= $item['Price'] ?>Dh</div>
                            <div class='row gap-1' style='justify-content:center ; align-items: baseline'>
                                <!-- Add a form around the quantity -->
                                <button class='btn btn-primary col-3' onclick='changeQuantity(this, 1)'
                                    name='quantity_change' value='increase'><i class='fa-solid fa-plus'></i></button>
                                    <p class='col-2 quantity' contenteditable='true'><?= $item['Quantity'] ?></p>

                                    <button class='btn btn-primary col-3' onclick='changeQuantity(this, -1)'
                                        name='quantity_change' value='decrease'><i class='fa-solid fa-minus'></i></button>
                                <div class='d-flex justify-content-center gap-3'>
                                    <form method='post' action="offcanvas/update_quantity.php">
                                        <input type='hidden' name='cart_item_id' value='<?= $item['CartItemID'] ?>'>
                                        <input type='hidden' id="new_quantity_input" name='new_quantity'
                                            value='<?= $item['Quantity'] ?>'>
                                        <button type="submit" class='btn btn-success' style="width:5rem">submit</button>
                                        </form>
                                    <form method='post'>
                                        <input type='hidden' name='deletcart_product_id' value='<?= $item['ProductID'] ?>'>
                                        <input type='hidden' name='deletCart_user_id' value='<?= $adminId ?>'>
                                        <button type='submit' class='btn btn-danger' style="width:5rem" name='deletCart'>del</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div id="cart-total" class="mt-3 sticky-bottom bg-outline-primary">
            <h3>Total: <span id="total-price"><?= $totalPrice ?></span>Dh</h3>
            <button type='submit' class='btn btn-primary' style="width:5rem">buy</button>
            <button type='submit' class='btn btn-danger' style="width:5rem">all del</button>
        </div>
    </div>
</div>