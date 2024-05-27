<?php
require_once '../includes/session_test.php';
include ("../../includes/connection.php");
$adminId = $_SESSION['id'];

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
        .table-data {
            display: flex;
            flex-wrap: wrap;
            grid-gap: 24px;
            margin-top: 24px;
            width: 100%;
            color: var(--dark);
        }

        .table-data>div {
            border-radius: 20px;
            background: var(--light);
            padding: 24px;
            overflow-x: auto;
        }

        .table-data .order {
            flex-grow: 1;
            flex-basis: 500px;
            box-shadow: 4px 4px 16px rgba(0, 0, 0, .05);
        }

        .table-data .order table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data .order table th {
            padding-bottom: 12px;
            font-size: 17px;
            text-align: center;
            border-bottom: 1px solid var(--grey);
        }

        .table-data .order table td {
            padding: 16px 0;
            text-align: center;
        }

        .preview-image {
            max-width: 200px;
            max-height: 150px;
            width: auto;
            height: auto;
            border-radius: 10px;
        }

        .actionBtns {
            display: flex;
            justify-content: space-evenly;
            flex-direction: column;
            gap: 15px;
            align-items: center; 
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
                    <h1>Categories</h1>
                    <ul class="dreadleft">
                        <li>
                            <a class="active" href="../dashboard/">Dashboard</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a href="#">Categories</a>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="table-data">
                <div class="order">
                    <div class="container-fluid admin">
                        <div style="display: flex;flex-direction: row;justify-content: flex-end;">
                            <a href="./create.php" class="btn btn-primary bt-sm"
                                style="display: flex; align-items: center;"><i class='bx bx-plus'></i>Add New</a>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered" id="OrderTable">
                                    <thead>
                                        <tr>
                                            <th>CategoryID</th>
                                            <th>CategoryImage</th>
                                            <th>CategoryName</th>
                                            <th>Description</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $sql = "SELECT * FROM categories";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            $token = uniqid(); // Generate a unique token
                                            $_SESSION['token'] = $token;
                                            while ($row = mysqli_fetch_assoc($result)) {

                                                echo "<tr>";
                                                echo "<td style='text-align: center;'>" . $row['CategoryID'] . "</td>";
                                                echo "<td style='text-align: center; width: 140px;height: 168px;'><img src='../../uploads/" . $row['CategoryImage'] . "'  class='preview-image'></td>";
                                                echo "<td>" . $row['CategoryName'] . "</td>";
                                                echo "<td>" . $row['Description'] . "</td>";
                                                echo "<td class='action-column' style='width: 15%;'>";
                                                echo "<div class='actionBtns'>";
                                                echo "<a href='view.php?token=" . $token . "&cat_id=" . $row['CategoryID'] . "' class='btn btn-sm btn-outline-success' name='view' style='width: 90%;'><i class='fa-regular fa-eye'></i> View</a>";
                                                echo "<a href='edit.php?token=" . $token . "&cat_id=" . $row['CategoryID'] . "' class='btn btn-sm btn-outline-primary' style='width: 90%;'><i class='fa fa-edit'></i> Edit</a>";
                                                echo "<a href='./' class='btn btn-sm btn-outline-danger' style='width: 90%;'><i class='fa fa-trash'></i> Delete</a>";
                                                echo "</div>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>


                                    </tbody>

                                </table>


                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </main>
    </section>
    <script>
        $('#OrderTable').DataTable({
            orderMulti: false,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'All'],]
        });

    </script>
    <script src="../assets/js/script.js"></script>
</body>

</html>