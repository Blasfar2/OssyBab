<?php
require_once '../includes/session_test.php';
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
    <link rel="stylesheet" href="../assets/css/style.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        crossorigin="anonymous" />

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
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
                        <a href="./create.php" class="btn btn-primary bt-sm" style="display: flex; align-items: center;"><i class='bx bx-plus'></i>Add New</a>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered" id="OrderTable">
                                    <colgroup>
                                        <!-- 	<col width="10%">
                                                <col width="10%">
                                                <col width="10%">
                                                <col width="10%">
                                                <col width="20%">
                                                <col width="10%"> -->
                                    </colgroup>
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
                                        <tr>
                                            <td>1</td>
                                            <td>Images</td>
                                            <td>Name here</td>
                                            <td>Descriptions</td>
                                            <td>
                                                <button class='btn btn-sm btn-outline-primary edit_student'
                                                    type='button'>
                                                    <i class='fa fa-edit'></i> Edit</button>
                                            </td>


                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Images</td>
                                            <td>Name here</td>
                                            <td>Descriptions</td>
                                            <td>
                                                <button class='btn btn-sm btn-outline-primary edit_student'
                                                    type='button'>
                                                    <i class='fa fa-edit'></i> Edit</button>
                                            </td>


                                        </tr>


                                    </tbody>

                                </table>
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