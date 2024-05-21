<?php
require_once '../includes/session_test.php';
include ("../../includes/connection.php");
$adminId = $_SESSION['id'];
if (isset($_GET['id'])) {
    $cat_id = $_GET['id'];
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
    <!-- <link rel="stylesheet" href="../assets/css/style.css" /> -->

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
                    <h1>View Category</h1>
                    <ul class="dreadleft">
                        <li>
                            <a class="active" href="../dashboard/">Dashboard</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="./">Categories</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a href="#">View Category</a>
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

                            $sql = "SELECT * FROM categories WHERE CategoryID = '$cat_id'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="both" style="display: flex;">
                                            <div style="width: 25%; margin: 5px; padding: 5px;">
                                                <div class="form-element my-4">
                                                    <!-- <p class="image-text">Preview Image : </p> -->
                                                    <?php echo "<img src='../../uploads/" . $row['CategoryImage'] . "'  class='preview-image' alt='Preview'>"; ?>
                                                </div>
                                            </div>
                                            <div style="width: 75%;">
                                                <div class="form-element my-4">
                                                    <h1>Category:</h1>
                                                    <h3 style="margin-left: 5%;"><?php echo $row['CategoryName']; ?></h3>
                                                </div>
                                                <div class="form-element my-4">
                                                    <h1>Description: </h1>
                                                    <h3 style="margin-left: 5%;"><?php echo $row['Description']; ?></h3>
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