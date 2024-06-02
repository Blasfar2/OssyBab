<?php
require_once '../includes/session_test.php';
include ("../../includes/connection.php");
$adminId = $_SESSION['id'];


if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];


// $order_id = $_GET['order_id'];

// if (isset($_GET['token']) && isset($_GET['order_id'])) {
//     if ($_GET['token'] === $_SESSION['token']) {
//         $order_id = $_GET['order_id'];
//         $_SESSION['token']='';
//     } else {
//         header("Location: ./");
//     }
// } else {
//     header("Location: ./");
// }

// Sanitize input
$order_id = intval($_GET['order_id']); // Cast to integer to prevent SQL injection

// Fetch order information
$order_sql = "SELECT *
              FROM orders
              WHERE OrderID = $order_id";
$order_result = mysqli_query($conn, $order_sql);
$order_info = mysqli_fetch_assoc($order_result);

// Fetch order details
$order_details_sql = "SELECT *
                      FROM orderdetails od
                      LEFT JOIN products p ON od.ProductID = p.ProductID
                      WHERE od.OrderID = $order_id";
$order_details_result = mysqli_query($conn, $order_details_sql);

// Fetch user information
$user_sql = "SELECT *
             FROM users
             WHERE UserID = (SELECT UserID FROM orders WHERE OrderID = $order_id)";
$user_result = mysqli_query($conn, $user_sql);
$user_info = mysqli_fetch_assoc($user_result);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['status'];
    $updateSql = "UPDATE orders SET status='$newStatus' WHERE OrderID=$orderId";
    if (mysqli_query($conn, $updateSql)) {
        $_SESSION['info'] = "The Status has been updated successfully!";
        echo '<script>setTimeout(function(){ window.location.href = "' . $url . '"; }, 1000);</script>';
    } else {
        $_SESSION['error'] = "Failed to updated Status.";
        echo '<script>setTimeout(function(){ window.location.href = "' . $url . '"; }, 1000);</script>';
    }

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/nav_sidebar.css" />
    <link rel="stylesheet" href="pdf_styles.css" />
    <link rel="stylesheet" href="modal_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <style>
        ul {
            padding-left: 0rem;
        }

        .invoice {
            max-width: 80%;
        }

        .pdf_container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body>

    <!-- Modal -->
    <div class="modal fade " id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <p>Are you sure you want to change the status of order <span id="orderIdSpan"></span> from <span
                                id="currentStatusSpan"></span> to <span id="selectedStatusSpan"></span>?</p>
                        <input type="hidden" name="order_id" id="orderIdInput">
                        <input type="hidden" name="status" id="selectedStatusInput">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade " id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="productModalLabel" aria-hidden="true">
        <!-- <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true"> -->
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="productModalLabel">Product Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="productDetails">
                        <!-- Product details will be loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- SIDEBAR -->
    <?php include ('../includes/sidebar.php'); ?>
    <!-- /SIDEBAR -->

    <section class="content" id="content">
        <!-- NAVBAR -->
        <?php include ('../includes/navbar.php'); ?>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">

                    <h1>
                        View Orders
                    </h1>
                    <ul class="dreadleft">
                        <li>
                            <a class="active" href="../dashboard/">Dashboard</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="./">Orders</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a href="#">View Orders</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div style="display: flex;flex-direction: row;justify-content: flex-end;">
                        <a href="./" class="btn btn-primary bt-sm" style="display: flex; align-items: center;">Go
                            Back</a>
                    </div>
                    <br>
                    <div class="pdf_container">

                        <div style="display: flex;flex-direction: row;justify-content: space-between;">

                        </div>
                        <br>
                        <div class="card" style="width:80%;">
                            <div class="card-body">

                                <?php
                                if (isset($_SESSION['info'])) {
                                    ?>
                                    <div id="infoAlert" class="alert alert-success alert-dismissible fade show"
                                        role="alert">
                                        <?php echo $_SESSION['info']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php
                                    unset($_SESSION['info']);
                                }

                                if (isset($_SESSION['error'])) {
                                    ?>
                                    <div id="errorAlert" class="alert alert-danger alert-dismissible fade show"
                                        role="alert">
                                        <?php echo $_SESSION['error']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php
                                    unset($_SESSION['error']);
                                }

                                ?>

                                <div class="invoice-wrapper" id="print-area">
                                    <div class="invoice">
                                        <div class="invoice-container">
                                            <div class="invoice-head">
                                                <div style="padding-bottom: 10px;">
                                                    <div class="text-center">
                                                        <h1>OussyBadr</h1>

                                                    </div>
                                                </div>
                                                <div class="hr"></div>

                                                <div class="invoice-head-bottom">
                                                    <div class="invoice-head-bottom-left">
                                                        <p class='text-bold'>Invoiced To:</p>
                                                        <ul style='margin-left: 15px;'>
                                                            <?php
                                                            // Display user information
                                                            if ($user_info) {
                                                                $token = uniqid(); // Generate a unique token
                                                                $_SESSION['token'] = $token;
                                                                echo "<a href='../customers/view.php?token=" . $token . "&customerId=" . $user_info['UserID'] . "'><li>" . $user_info["UserID"] . " - " . $user_info["Username"] . "</li></a>";
                                                                echo "<li>" . $user_info["Address"] . "</li>";
                                                                echo "<li>" . $user_info["ZipCode"] . "</li>";
                                                                echo "<li>" . $user_info["PhoneNumber"] . "</li>";
                                                            } else {
                                                                echo "<li>No user found</li>";
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>

                                                    <div class="invoice-head-bottom-right"
                                                        style="display: flex;flex-direction: row-reverse;">
                                                        <div>
                                                            <p class='text-bold'>Invoice:</p>
                                                            <ul class="text-start" style="margin-left: 15px;">
                                                                <?php
                                                                if ($order_info) {
                                                                    echo "<li><span class='text-bold'>ID:</span> " . $order_id . "</li>";
                                                                    echo "<li><span class='text-bold'>Issue Date:</span>" . $order_info["OrderDate"] . "</li>";
                                                                    echo "<li><span class='text-bold'>Status: </span>";
                                                                    echo "  <form action='' method='post' class='selectBox' >
                                                                    <input type='hidden' name='order_id' value='" . $order_id . "'>
                                                                    <select name='status' class='form-control' onchange=\"openConfirmationModal('{$order_info['OrderID']}', '{$order_info['Status']}', this.value)\">";

                                                                    echo "<option value='pending' " . ($order_info['Status'] == 'pending' ? 'selected' : '') . ">Pending</option>";
                                                                    echo "<option value='processing' " . ($order_info['Status'] == 'processing' ? 'selected' : '') . ">Processing</option>";
                                                                    echo "<option value='shipped' " . ($order_info['Status'] == 'shipped' ? 'selected' : '') . ">Shipped</option>";
                                                                    echo "<option value='cancelled' " . ($order_info['Status'] == 'cancelled' ? 'selected' : '') . ">Cancelled</option>";
                                                                    echo "<option value='completed' " . ($order_info['Status'] == 'completed' ? 'selected' : '') . ">Completed</option>";
                                                                    echo " </form></select>";
                                                                    echo "</li>";
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="overflow-view">
                                                <div class="invoice-body">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <td class="text-bold">#</td>
                                                                <td class="text-bold">Product</td>
                                                                <td class="text-bold">Unit Price</td>
                                                                <td class="text-bold">QTY</td>
                                                                <td class="text-bold">Amount</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($order_details_result && mysqli_num_rows($order_details_result) > 0) {
                                                                // $totalAmount = 0;
                                                                while ($order_item = mysqli_fetch_assoc($order_details_result)) {
                                                                    $amount = $order_item["Quantity"] * $order_item["UnitPrice"];
                                                                    // $totalAmount += $amount;
                                                                    echo "<tr>";
                                                                    echo "<td><a href='#' onclick='openModal(" . $order_item["ProductID"] . ")'>" . $order_item["ProductID"] . "</a></td>";

                                                                    echo "<td>" . $order_item["Name"] . "</td>";
                                                                    echo "<td>" . $order_item["UnitPrice"] . " DH</td>";
                                                                    echo "<td>" . $order_item["Quantity"] . "</td>";
                                                                    echo "<td class='text-end'>" . $amount . " DH</td>";
                                                                    echo "</tr>";
                                                                }
                                                                ?>

                                                                <?php
                                                                echo "</tbody>";
                                                                echo "</table>";

                                                                // Output total amount
                                                                echo "<div class='invoice-body-bottom'>";
                                                                echo "<div class='invoice-body-info-item'>";
                                                                echo "<div class='info-item-td text-end text-bold'>Total:</div>";
                                                                echo "<div class='info-item-td text-end'>" . $order_info["TotalAmount"] . " DH</div>";
                                                                echo "</div>";
                                                                echo "</div>";
                                                            } else {
                                                                echo "<tr><td colspan='5'>No products found for this order</td></tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <script src="../assets/js/script.js"></script>
    <script>
        function openConfirmationModal(orderId, currentStatus, selectedStatus) {
            // Set the values of hidden input fields
            document.getElementById('orderIdInput').value = orderId;
            document.getElementById('selectedStatusInput').value = selectedStatus;

            // Set the values of placeholders in the modal body
            document.getElementById('orderIdSpan').innerText = orderId;
            document.getElementById('currentStatusSpan').innerText = currentStatus;
            document.getElementById('selectedStatusSpan').innerText = selectedStatus;

            // Show the modal
            $('#exampleModal').modal('show');
            $('#exampleModal').on('hidden.bs.modal', function (e) {

                document.querySelector('select[name="status"]').value = currentStatus;
            });
        }

        // Function to fetch and display product details
        function fetchProductDetails(productId) {
            $.ajax({
                url: 'fetch_product_details.php',
                type: 'GET',
                data: { productId: productId },
                dataType: 'json',
                success: function (response) {
                    // Construct HTML to display product details
                    var html = '<div class="card-wrapper">';
                    html += '<div class="cardy">';
                    html += '<div class="product-imgs">';
                    html += '<div class="img-display">';
                    html += '<div class="img-showcase">';
                    html += '<img src="../../uploads/' + response.productImage + '" alt="' + response.productName + '">';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="product-content">';
                    html += '<h2 class="product-title">' + response.productName + '</h2>';
                    html += '<div class="product-price">';
                    html += '<p>ID: <span>' + response.productId + '</span></p>';
                    html += '<p>Price: <span>' + response.productPrice + ' DH</span></p>';
                    html += '<p>Qty Stock: <span>' + response.productStock + '</span></p>';
                    html += '</div>';
                    html += '<div class="product-detail">';
                    html += '<h2>About this item:</h2>';
                    html += '<p>' + (response.productDescription ? response.productDescription : 'No description found.') + '</p>';
                    // html += '<h3>Product Attributes:</h3>';
                    html += '<ul>';
                    $.each(response.attributes, function (index, attribute) {
                        html += '<li>' + attribute.attributeName + ': <span>' + attribute.attributeValue + '</span></li>';
                    });
                    html += '</ul>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    // Display product details in the modal
                    $('#productDetails').html(html);
                },
                error: function (xhr, status, error) {
                    // Display error message if AJAX request fails
                    $('#productDetails').html('<p>Error fetching product details.</p>');
                }
            });
        }

        function openModal(productId) {
            fetchProductDetails(productId);
            $('#productModal').modal('show');
        }
        setTimeout(function () {
            var infoAlert = document.getElementById('infoAlert');
            if (infoAlert) {
                var bsAlert = new bootstrap.Alert(infoAlert);
                bsAlert.close();
            }
        }, 900);

        // Automatically dismiss the error alert after 3 seconds
        setTimeout(function () {
            var errorAlert = document.getElementById('errorAlert');
            if (errorAlert) {
                var bsAlert = new bootstrap.Alert(errorAlert);
                bsAlert.close();
            }
        }, 900);

    </script>

</body>

</html>