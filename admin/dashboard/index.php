<?php
require_once '../includes/session_test.php';
$adminId = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <!-- Boxicons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="../assets/css/nav_sidebar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" crossorigin="anonymous" />


  <!-- <script src ="assets/js/bootstrap.min.js"></script> -->
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
                      <th>User</th>
                      <th>Date Order</th>
                      <th>Status</th>
                      <th>Ammount</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Tiger Nixon</td>
                      <td>2011-04-25</td>
                      <td><span class="status completed">Completed</span></td>
                      <td>$320,800</td>
                      <td>
                        <button class='btn btn-sm btn-outline-primary edit_student' data-toggle='modal'
                          data-target='#edit$id' type='button'><i class='fa fa-edit'></i> Edit</button>
                      </td>


                    </tr>
                    <tr>
                      <td>Garrett Winters</td>

                      <td>2011-07-25</td>
                      <td><span class="status pending">Pending</span></td>
                      <td>$170,750</td>
                      <td>
                        <button class='btn btn-sm btn-outline-primary edit_student' data-toggle='modal'
                          data-target='#edit$id' type='button'><i class='fa fa-edit'></i> Edit</button>
                      </td>
                    </tr>
                    <tr>
                      <td>Ashton Cox</td>

                      <td>2009-01-12</td>
                      <td><span class="status process">Process</span></td>
                      <td>$86,000</td>
                      <td>
                        <button class='btn btn-sm btn-outline-primary edit_student' data-toggle='modal'
                          data-target='#edit$id' type='button'><i class='fa fa-edit'></i> Edit</button>
                      </td>
                    </tr>
                    <tr>
                      <td>Ashton Cox</td>

                      <td>2009-01-12</td>
                      <td><span class="status pending">Pending</span></td>
                      <td>$86,000</td>
                      <td>
                        <button class='btn btn-sm btn-outline-primary edit_student' data-toggle='modal'
                          data-target='#edit$id' type='button'><i class='fa fa-edit'></i> Edit</button>
                      </td>
                    </tr>
                    <tr>
                      <td>Ashton Cox</td>

                      <td>2009-01-12</td>
                      <td><span class="status completed">Completed</span></td>
                      <td>$86,000</td>
                      <td>
                        <button class='btn btn-sm btn-outline-primary edit_student' data-toggle='modal'
                          data-target='#edit$id' type='button'><i class='fa fa-edit'></i> Edit</button>
                      </td>
                    </tr>
                    <tr>
                      <td>Ashton Cox</td>

                      <td>2009-01-12</td>
                      <td><span class="status completed">Completed</span></td>
                      <td>$86,000</td>
                      <td>
                        <button class='btn btn-sm btn-outline-primary edit_student' data-toggle='modal'
                          data-target='#edit$id' type='button'><i class='fa fa-edit'></i> Edit</button>
                      </td>
                    </tr>

                  </tbody>

                </table>
                </table>

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
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>

  <script src="../assets/js/script.js"></script>
</body>

</html>