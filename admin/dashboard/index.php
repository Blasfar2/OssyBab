<?php
require_once '../includes/session_test.php';
include ("../../includes/connection.php");
$adminId = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <!-- Boxicons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="../assets/css/nav_sidebar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    crossorigin="anonymous" />


  <!-- <script src ="assets/js/bootstrap.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

  <style>
    .actionBtns {
      display: flex;
      justify-content: space-evenly;
      flex-direction: row;
      gap: 15px;
      align-items: center;
    }

    .status_filter {
      display: flex;
      align-items: center;
      justify-content: space-around;
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
          <h1>Dashboard</h1>
          <ul class="dreadleft">
            <li>
              <a href="#">Dashboard</a>
            </li>
            <!-- <li><i class="bx bx-chevron-right"></i></li>
              <li>
                <a class="active" href="#">Home</a>
              </li> -->
          </ul>
        </div>
        <!-- <a href="#" class="btn-download">
            <i class="bx bxs-cloud-download"></i>
            <span class="text">Download PDF</span>
          </a> -->
      </div>

      <ul class="box-info">
        <li class="li-item">
          <i class="bx bxs-calendar-check"></i>
          <span class="text">
            <h3>1020</h3>
            <p>New Order</p>
          </span>
        </li>
        <li class="li-item">
          <i class="bx bxs-group"></i>
          <span class="text">
            <h3>2834</h3>
            <p>Visitors</p>
          </span>
        </li>
        <li class="li-item">
          <i class="bx bxs-dollar-circle"></i>
          <span class="text">
            <h3>$2543</h3>
            <p>Total Sales</p>
          </span>
        </li>
      </ul>

      <div class="table-data">
        <div class="order">
          <div class="container-fluid admin">
            <div class="col-md-12 alert alert-primary">Recent Orders</div>
            <div style="display: flex;flex-direction: row;justify-content: space-between;">

            </div>
            <br>
            <div class="card">
              <div class="card-body">
                <table class="table table-bordered" id="OrderTable">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th style='width: 25%;'>
                        <span>Date Order</span>
                      </th>
                      <th style='width: 25%;'>
                        <span>Status: </span>
                      </th>
                      <th>Ammount</th>
                      <th>Action</th>
                    </tr>

                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM orders where Status = 'pending'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      $token = uniqid(); // Generate a unique token
                      $_SESSION['token'] = $token;
                      while ($row = mysqli_fetch_assoc($result)) {
                        $orderDateTime = $row['OrderDate'];
                        $dateAndTime = explode(" ", $orderDateTime);
                        $date = $dateAndTime[0]; // Date component
                        $time = $dateAndTime[1]; // Time component
                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . $row['OrderID'] . "</td>";
                        echo "<td>" . $date . "</td>";
                        echo "<td> <span class='status " . $row['Status'] . "'>" . $row['Status'] . "</span></td>";
                        echo "<td>" . $row['TotalAmount'] . " DH</td>";
                        echo "<td class='action-column' style='width: 15%;'>";
                        echo "<div class='actionBtns'>";
                        echo "<a href='../orders/view.php?token=" . $token . "&order_id=" . $row['OrderID'] . "' class='btn btn-sm btn-outline-success' name='view' ><i class='fa-regular fa-eye'></i> View</a>";
                        // echo "<a href='../orders/edit.php?token=" . $token . "&order_id=" . $row['OrderID'] . "' class='btn btn-sm btn-outline-primary' ><i class='fa fa-edit'></i> Edit</a>";
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
    <!-- MAIN -->
  </section>
  <script>
    $('#OrderTable').DataTable({
      orderMulti: false,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'All'],]
    });

  </script>

  <script>
    // $(document).ready(function () {
    //   $('#myTable').DataTable();
    // });
  </script>

  <script src="../assets/js/script.js"></script>
</body>

</html>