<?php

if (isset($_POST['add_to_wishlist'])) {
    $wishlistUserID = $_POST['wishlist_user_id'];
    $wishlistProductID = $_POST['wishlist_product_id'];

    $check_sql = "SELECT WishlistItemID FROM wishlistitems WHERE UserID = '$wishlistUserID' AND ProductID = '$wishlistProductID'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $delete_sql = "DELETE FROM wishlistitems WHERE UserID = '$wishlistUserID' AND ProductID = '$wishlistProductID'";
        if ($conn->query($delete_sql) === TRUE) {
            $_SESSION['info'] = "Item removed from wishlist successfully";
            header("Location: produit.php");
        } else {
            $_SESSION['error'] = "Error deleting record: " . $conn->error;
        }
    } else {
        $insert_sql = "INSERT INTO wishlistitems (UserID, ProductID) VALUES ('$wishlistUserID', '$wishlistProductID')";
        if ($conn->query($insert_sql) === TRUE) {
            $_SESSION['info'] = "Item added to wishlist successfully";
            header("Location: produit.php");
        } else {
            $_SESSION['error'] = "Error inserting record: " . $conn->error;
        }
    }

}
if (isset($_POST['add_to_buy'])) {
    $buyUserID = $_POST['buy_user_id'];
    $buyProductID = $_POST['buy_product_id'];
    $check_sql = "SELECT CartItemID, Quantity FROM cartitems WHERE UserID = '$buyUserID' AND ProductID = '$buyProductID'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quantity = $row['Quantity'] + 1;
        $update_sql = "UPDATE cartitems SET Quantity = $quantity WHERE UserID = '$buyUserID' AND ProductID = '$buyProductID'";
        if ($conn->query($update_sql) === TRUE) {
            $_SESSION['info'] = "Item quantity updated successfully";
            header("Location: produit.php");
        } else {
            $_SESSION['error'] = "Error updating record: " . $conn->error;
        }
    } else {
        $insert_sql = "INSERT INTO cartitems (UserID, ProductID, Quantity) VALUES ('$buyUserID', '$buyProductID', 1)";
        if ($conn->query($insert_sql) === TRUE) {
            $_SESSION['info'] = "Item added to buy successfully";
            header("Location: produit.php");
        } else {
            $_SESSION['error'] = "Error inserting record: " . $conn->error;
        }
    }
}

if (isset($_POST['deletCart'])) {
    $deletCart_UserID = $_POST['deletCart_user_id'];
    $deletCart_ProductID = $_POST['deletcart_product_id'];

    $delete_sql = "DELETE FROM cartitems WHERE UserID = '$deletCart_UserID' AND ProductID = '$deletCart_ProductID'";

    if ($conn->query($delete_sql) === TRUE) {
        $_SESSION['info'] = "Item removed from cart successfully";
        header("Location: produit.php");
        exit;
    } else {
        $_SESSION['error'] = "Error deleting record: " . $conn->error;
    }
}
if (isset($_POST['deleteAllinCart'])) {
    $deletCart_UserID = $_POST['Cart_user_id'];
    $delete_sql = "DELETE FROM cartitems WHERE UserID = '$deletCart_UserID'";

    if ($conn->query($delete_sql) === TRUE) {
        $_SESSION['info'] = "All Items removed from cart successfully";
        header("Location: produit.php");
        exit;
    } else {
        $_SESSION['error'] = "Error deleting record: " . $conn->error;
    }
}

if (isset($_POST['buyAllinCart'])) {
    $buyUserID = $_POST['Cart_user_id'];

    // Fetch all items in the cart for the user
    $check_sql = "SELECT * FROM cartitems c JOIN products p ON c.ProductID = p.ProductID WHERE c.UserID = '$buyUserID'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $totalAmount = 0;
        $items = []; // Store fetched rows in an array

        while ($row = $result->fetch_assoc()) {
            $quantity = $row['Quantity'];
            $unitPrice = $row['Price'];
            $totalAmount += $quantity * $unitPrice;
            $items[] = $row; 
        }
        $insert_order_sql = "INSERT INTO orders (UserID, TotalAmount) VALUES ('$buyUserID', '$totalAmount')";
        if ($conn->query($insert_order_sql)) {
            $orderID = $conn->insert_id;

            foreach ($items as $item) {
                $quantity = $item['Quantity'];
                $unitPrice = $item['Price'];
                $productID = $item['ProductID'];

                $insert_item_sql = "INSERT INTO orderdetails (OrderID, ProductID, Quantity, UnitPrice) 
                                    VALUES ('$orderID', '$productID', '$quantity', '$unitPrice')";
                if (!$conn->query($insert_item_sql)) {
                    $_SESSION['error'] = "Error inserting order details: " . $conn->error;
                    header("Location: produit.php");
                    exit;
                }
            }
            // Clear the cart for the user
            $clear_cart_sql = "DELETE FROM cartitems WHERE UserID = '$buyUserID'";
            if (!$conn->query($clear_cart_sql)) {
                $_SESSION['error'] = "Error clearing cart: " . $conn->error;
                header("Location: produit.php");
                exit;
            }
            $_SESSION['info'] = "Items added to buy successfully";
            header("Location: produit.php");
            exit;
        } else {
            $_SESSION['error'] = "Error inserting order: " . $conn->error;
            header("Location: produit.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "No items in the cart";
        header("Location: produit.php");
        exit;
    }
}
?>