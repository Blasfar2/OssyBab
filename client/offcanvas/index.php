
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
    <!-- Offcanvas -->
<div class="offcanvas offcanvas-end" data-bs-scroll="false" tabindex="-1" id="Id2" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel">Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <hr>
        <div id="cart-items">
            <?php foreach ($cartItems as $item): ?>
            <div class='row align-items-center cart-item' data-id='<?= $item['CartItemID'] ?>' data-price='<?= $item['Price'] ?>'>
                <div class='col-4 p-1'>
                    <img src='../uploads/<?= $item['ProductImage'] ?>' class='rounded-2' style='width: 100px; height: 100px; object-fit: cover;'>
                </div>
                <div class='col-auto'>
                    <div class='text-center'>
                        <div><strong><?= $item['Name'] ?></strong></div>
                        <div><strong>Prix :</strong><?= $item['Price'] ?>Dh</div>
                        <div class='row gap-1'>
                            <button class='btn btn-primary col-3' onclick='changeQuantity(this, 1)'><i class='fa-solid fa-plus'></i></button>
                            <p class='col-2 quantity'><?= $item['Quantity'] ?></p>
                            <button class='btn btn-primary col-3' onclick='changeQuantity(this, -1)'><i class='fa-solid fa-minus'></i></button>
                            <form method='post'>
                                <input type='hidden' name='deletcart_product_id' value='<?= $item['ProductID'] ?>'>
                                <input type='hidden' name='deletCart_user_id' value='<?= $adminId ?>'>
                                <button type='submit' class='btn btn-danger col-3' name='deletCart'>del</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <!-- <hr> -->
        </div>
        <div id="cart-total" class="mt-3 sticky-bottom">
            <h3>Total: <span id="total-price"><?= $totalPrice ?></span>Dh</h3>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="scripts.js"></script>

