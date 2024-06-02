<?php
require_once '../../includes/session_test.php';
include "../../../includes/connection.php";
$adminId = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" />

    <!-- <link rel="stylesheet" href="../../assets/css/style.css" /> -->
    <link rel="stylesheet" href="../../assets/css/nav_sidebar.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

    <style>
         ul {
            padding-left: 0rem;
        }
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
    <!-- Single Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deleteForm" action="process.php" method="post">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Product with ID: <span id="deleteProductId"></span>?
                        </p>

                        <input type="hidden" id="hiddenProductyId" name="ProductyId">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="deleteForm" class="btn btn-danger" name="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SIDEBAR -->
    <?php include ('../../includes/sidebar.php'); ?>
    <!-- /SIDEBAR -->

    <section class="content" id="content">
        <!-- NAVBAR -->
        <?php include ('../../includes/navbar.php'); ?>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Products List</h1>
                    <ul class="dreadleft">
                        <li>
                            <a class="active" href="../../dashboard/">Dashboard</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="../">Products</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a href="#">Products List</a>
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
                        <div style="display: flex;flex-direction: row;justify-content: flex-end;">
                            <a href="./create.php" class="btn btn-primary bt-sm"
                                style="display: flex; align-items: center;"><i class='bx bx-plus'></i>Add New</a>
                        </div>
                        <br>

                        <div class="card">
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

                                <table class="table table-bordered" id="OrderTable">
                                    <thead>
                                        <tr>
                                            <th>ProductID</th>
                                            <th>ProductImage</th>
                                            <th>ProductName</th>
                                            <th>Price</th>
                                            <th>Qte Stock</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $sql = "SELECT * FROM products where IsDeleted = 0";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            $token = uniqid(); // Generate a unique token
                                            $_SESSION['token'] = $token;
                                            while ($row = mysqli_fetch_assoc($result)) {

                                                echo "<tr>";
                                                echo "<td style='text-align: center;'>" . $row['ProductID'] . "</td>";
                                                echo "<td style='text-align: center; width: 140px;height: 168px;'><img src='../../../uploads/" . $row['ProductImage'] . "'  class='preview-image'></td>";
                                                echo "<td>" . $row['Name'] . "</td>";
                                                echo "<td>" . $row['Price'] . "</td>";
                                                echo "<td>" . $row['Stock'] . "</td>";
                                                echo "<td class='action-column' style='width: 15%;'>";
                                                echo "<div class='actionBtns'>";
                                                echo "<a href='view.php?token=" . $token . "&prod_id=" . $row['ProductID'] . "' class='btn btn-sm btn-outline-success' name='view' style='width: 90%;'><i class='fa-regular fa-eye'></i> View</a>";
                                                echo "<a href='edit.php?token=" . $token . "&prod_id=" . $row['ProductID'] . "' class='btn btn-sm btn-outline-primary' style='width: 90%;'><i class='fa fa-edit'></i> Edit</a>";
                                                // echo "<a href='./' class='btn btn-sm btn-outline-danger' style='width: 90%;'><i class='fa fa-trash'></i> Delete</a>";
                                                echo "<button type='button' class='btn btn-sm btn-outline-danger deleteBtn' data-bs-target='#deleteModal' data-product-id='" . $row['ProductID'] . "' style='width: 90%;'><i class='fa fa-trash'></i> Delete</button>";
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
    <script src="../../assets/js/script.js"></script>
    <script>

        //update the link of the sidebar and the nav links
        $(document).ready(function () {
            $('.nav-list a').each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', '../' + href);
            });
            $('.profile-image img').each(function () {
                var profile = $(this).attr('src');
                $(this).attr('src', '../' + profile);
            });

            $('.profile-link a').each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', '../' + href);
            });
        });

        setTimeout(function () {
            var infoAlert = document.getElementById('infoAlert');
            if (infoAlert) {
                var bsAlert = new bootstrap.Alert(infoAlert);
                bsAlert.close();
            }
        }, 1500);

        // Automatically dismiss the error alert after 3 seconds
        setTimeout(function () {
            var errorAlert = document.getElementById('errorAlert');
            if (errorAlert) {
                var bsAlert = new bootstrap.Alert(errorAlert);
                bsAlert.close();
            }
        }, 1500);

        document.addEventListener('DOMContentLoaded', function () {
            var deleteModal = document.getElementById('deleteModal');
            var confirmDelete = document.getElementById('confirmDelete');

            // Event delegation to handle clicks on delete buttons
            document.querySelector('.table-data').addEventListener('click', function (event) {
                if (event.target.classList.contains('deleteBtn') || event.target.closest('.deleteBtn')) {
                    var button = event.target.closest('.deleteBtn');
                    var ProductyId = button.getAttribute('data-product-id');

                    // Update the modal message with the Producty ID
                    deleteProductId.textContent = ProductyId;

                    // Update the hidden input value with the Producty ID
                    hiddenProductyId.value = ProductyId;

                    // Show the modal
                    var bootstrapModal = new bootstrap.Modal(deleteModal);
                    bootstrapModal.show();
                }
            });
        });

    </script>
</body>

</html>