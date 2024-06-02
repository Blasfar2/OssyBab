<?php
require_once '../includes/session_test.php';
include ("../../includes/connection.php");
$adminId = $_SESSION['id'];

if (isset($_GET['token']) && isset($_GET['customerId'])) {
    if ($_GET['token'] === $_SESSION['token']) {
        $customerId = $_GET['customerId'];

    } else {
        $customerId = null;
    }

} else {
    header("Location: ./");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" />

    <link rel="stylesheet" href="../assets/css/nav_sidebar.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        crossorigin="anonymous" />

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

    <style>
        .preview-image {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            border-radius: 10px;
        }

        .image-text {
            /* text-align: center; */
            margin-top: 5px;
            font-size: 20px;
            color: #888;
        }
        h4{
            margin-bottom: 0rem;
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
                    <h1>View Customer</h1>
                    <ul class="dreadleft">
                        <li>
                            <a class="active" href="../dashboard/">Dashboard</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="./">Customers</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a href="#">View Customer</a>
                        </li>
                    </ul>
                </div>

            </div>
            <div style=" display: flex; justify-content: center;">
                <div class="table-data" style="width: 90%;">
                    <div class="order">
                        <div class="container-fluid admin">
                            <div style="display: flex;flex-direction: row;justify-content: flex-end;">
                                <a href="./" class="btn btn-primary bt-sm"
                                    style="display: flex; align-items: center;">Go Back</a>
                            </div>
                            <br>
                            <?php

                            $sql = "SELECT * FROM users WHERE UserID = '$customerId'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="container-l px-4 mt-4">
                                            <!-- <hr class="mt-0 mb-4" /> -->
                                            <div class="row">
                                                <div class="col-l-4">
                                                    <div class="card mb-4 mb-xl-0" style="width: 242px;">
                                                        <div class="card-header"><h4>User Picture</h4></div>

                                                        <div class="card-body text-center">

                                                            <img id="imgPreview"
                                                                class="img-account-profile rounded-circle mb-2 preview-image"
                                                                src="../../uploads/<?php echo $row['UserImage']; ?>" alt />
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xl-10">
                                                    <div class="card mb-4">
                                                        <div class="card-header"><h4>User Details</h4></div>
                                                        <div class="card-body">
                                                            <div class="mb-3">
                                                                <label class="small mb-1" for="inputUsername">Username
                                                                </label>
                                                                <input class="form-control" id="inputUsername"
                                                                    name="username" type="text"
                                                                    placeholder="Enter your username"
                                                                    value="<?php echo $row['Username']; ?>" disabled />
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputFirstName">First
                                                                        name</label>
                                                                    <input class="form-control" id="inputFirstName"
                                                                        name="firstName" type="text"
                                                                        placeholder="Enter your first name"
                                                                        value="<?php echo $row['FirstName']; ?>" disabled />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputLastName">Last
                                                                        name</label>
                                                                    <input class="form-control" id="inputLastName"
                                                                        name="lastName" type="text"
                                                                        placeholder="Enter your last name"
                                                                        value="<?php echo $row['LastName']; ?>" disabled />
                                                                </div>
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputCity">City</label>
                                                                    <input class="form-control" id="inputCity" name="city"
                                                                        type="text" placeholder="Enter your location"
                                                                        value="<?php echo $row['City']; ?>" disabled />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputZipCode">Zip
                                                                        Code</label>
                                                                    <input class="form-control" id="inputZipCode"
                                                                        name="zipCode" type="text"
                                                                        placeholder="Enter your ZipCode"
                                                                        value="<?php echo $row['ZipCode']; ?>" disabled />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="small mb-1" for="inputFullAddress">Full
                                                                    Address</label>
                                                                <input class="form-control" id="inputFullAddress"
                                                                    name="fullAddress" type="text"
                                                                    placeholder="Enter your location"
                                                                    value="<?php echo $row['Address']; ?>" disabled />
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputEmailAddress">Email
                                                                        Address</label>
                                                                    <input class="form-control" id="inputEmailAddress"
                                                                        name="emailAddress" type="email" name="birthday"
                                                                        placeholder="name@example.com"
                                                                        value="<?php echo $row['Email']; ?>" disabled />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="inputPhoneNumber">Phone
                                                                        number</label>
                                                                    <input class="form-control" id="inputPhoneNumber"
                                                                        name="phoneNumber" type="tel"
                                                                        placeholder="+212-XXXXXXXXX"
                                                                        value="<?php echo $row['PhoneNumber']; ?>"
                                                                        disabled />
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- ---------------Recent Order ---------------------- -->
                                        <div class="container-l px-4 mt-4">
                                            <div class="row">
                                                <div class="col-l-4" style="width: 242px;">

                                                </div>
                                                <div class="col-lg-10">
                                                    <!-- List of Orders-->
                                                    <div class="card mb-4">
                                                        <div class="card-header"><h4>List of Orders</h4></div>
                                                        <div class="card-body">


                                                            <?php


                                                            $sqlOrderIds = "SELECT OrderID FROM orders WHERE UserID  = $customerId";
                                                            $resultOrderIds = mysqli_query($conn, $sqlOrderIds);
                                                            $orderIds = [];
                                                            if (mysqli_num_rows($resultOrderIds) > 0) {
                                                                while ($rowOrderIds = mysqli_fetch_assoc($resultOrderIds)) {
                                                                    $orderIds[] = $rowOrderIds['OrderID'];
                                                                }
                                                            }
                                                            $token = uniqid(); // Generate a unique token
                                                            $_SESSION['token'] = $token;
                                                            if (count($orderIds) > 0) {
                                                                echo "<ul class='list'>";
                                                                foreach ($orderIds as $orderId) {
                                                                    echo "<li><strong><a href='../orders/view.php?token=" . $token . "&order_id=" . $orderId . "'>Order ID: " . $orderId . "</a></strong></li>";
                                                                }
                                                                echo "</ul>";
                                                            } else {
                                                                echo "<p>No orders found</p>";
                                                            }




                                                            ?>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </section>
    <script src="../assets/js/script.js"></script>

</body>

</html>