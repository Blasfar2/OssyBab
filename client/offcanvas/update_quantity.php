<?php
// Your PHP code to fetch cart items from the database and calculate total price goes here...
include ("../../includes/connection.php");
if (isset($_POST['new_quantity'])) {
    $cartItemID = $_POST['cart_item_id'];
    $newQuantity = $_POST['new_quantity'];

    $update_sql = "UPDATE cartitems SET Quantity = '$newQuantity' WHERE CartItemID = '$cartItemID'";
    if ($conn->query($update_sql) === TRUE) {
        header("Location: ../produit.php");
        // exit;
    } else {
        header("Location: ../produit.php");
      
        // exit;
    }
}
?>
