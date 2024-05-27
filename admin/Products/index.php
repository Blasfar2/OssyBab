<?php
require_once '../includes/session_test.php';
include "../../includes/connection.php";
$adminId = $_SESSION['id'];


// Initialize count variable
$productTypeCount = 0;

// SQL query to count the number of product types
$productTypeCount = ($resultCount = $conn->query("SELECT COUNT(*) AS typeCount FROM producttypes")) ? $resultCount->fetch_assoc()['typeCount'] : die("Error: " . $conn->error);

// SQL query to count the number of products
$productCount = ($resultCount = $conn->query("SELECT COUNT(*) AS productCount FROM products")) ? $resultCount->fetch_assoc()['productCount'] : die("Error: " . $conn->error);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/nav_sidebar.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <style>
        #content main .box-info .li-item {
            box-shadow: 4px 4px 16px 5px rgb(0 0 0 / 25%);
        }

        .productTypeStyle {
            height: auto;
            width: 115%;
            padding: 10px;
            border-radius: 10px;
            font-size: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #CFE8FF;
            color: #3C91E6;
        }
    </style>
</head>

<body>
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
                    <h1>Products</h1>
                    <ul class="dreadleft">
                        <li>
                            <a class="active" href="../dashboard/">Dashboard</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a href="#">Products</a>
                        </li>
                    </ul>
                </div>
                <!-- <a href="#" class="btn-download">
            <i class="bx bxs-cloud-download"></i>
            <span class="text">Download PDF</span>
          </a> -->
            </div>
            <div class="table-data">
                <div class="order">
                    <div class="container-fluid admin">
                        <div class="col-md-12 alert alert-primary" style="text-align: center;">Products Types and List
                        </div>

                        <ul class="box-info"
                            style="display: flex; grid-gap: 24px; margin-top: 36px; flex-wrap: wrap;justify-content: space-evenly;">
                            <li class="li-item">
                                <div class="left-elements"
                                    style="display: flex; grid-gap: 24px; width: 283px; cursor: pointer; flex-direction: column; align-items: center;"
                                    onclick="location.href='productsType/';">
                                    <!-- <i class="bx bxs-dollar-circle"></i> -->
                                    <h3 class="productTypeStyle">Products Type</h3>
                                    <span class="text" style="text-align: center;">
                                        <h3><?php echo $productTypeCount; ?></h3>
                                        <p>Total Types</p>
                                    </span>
                                </div>
                            </li>
                         
                            <li class="li-item">
                                <div class="left-elements"
                                    style="display: flex; grid-gap: 24px; width: 283px; cursor: pointer; flex-direction: column; align-items: center;"
                                    onclick="location.href='productsList/';">
                                    <!-- <i class="bx bxs-dollar-circle"></i> -->
                                    <h3 class="productTypeStyle">Products List</h3>
                                    <span class="text" style="text-align: center;">
                                        <h3><?php echo $productCount; ?></h3>
                                        <p>Total Products</p>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <script src="../assets/js/script.js"></script>
</body>

</html>