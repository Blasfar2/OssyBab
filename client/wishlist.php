<?php
require_once '../includes/session_test.php';
include ("../includes/connection.php");
$adminId = $_SESSION['id'];

if (isset($_POST['remove_from_wishlist'])) {
    $wishlistItemID = $_POST['wishlist_item_id'];

    $sql = "DELETE FROM wishlistitems WHERE WishlistItemID = '$wishlistItemID'";

    if ($conn->query($sql) === TRUE) {
        header("Location: wishlist.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
        integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css" />
    <!-- --------------------------------------------- -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../assets/css/styles.css"> -->
    <link rel="stylesheet" href="../assets/css/range.css">
    <link rel="stylesheet" href="style.css">



    <style>
        /* ---------------------------------------------------------------------------- */

        ul {
            padding-left: 0rem;
        }

        .img-account-profile {
            height: 15rem;
            /* height: 10rem; */
        }

        .rounded-circle {
            border-radius: 50% !important;
        }


        .form-control,
        .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 500;
            line-height: 1;
            color: #0068ff;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        /* ------------------------------------------------------------------------------ */


        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }

        .card .card-header {
            font-weight: 500;
        }

        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }

        .btn-danger-soft {
            color: #000;
            background-color: #f1e0e3;
            border-color: #f1e0e3;
        }

        #cancelButton,
        #confirmButton {
            display: none;
        }

        /* img {
            display: block;
            max-width: 100%;
        } */
        .preview {
            overflow: hidden;
            width: 200px;
            height: 200px;
            margin: 10px;
            border: 1px solid red;
        }
    </style>
</head>

<body>

    <?php include ('navbar.php'); ?>
    <!-- Modal -->
    <div class="modal fade" id="deleteAccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteAccountModalLabel">Delete Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="process.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <input name="userID" type="hidden" value="<?php echo $adminId; ?>" />
                            <label for="confirmationInput" class="form-label">Type "DELETE" to confirm:</label>
                            <input type="text" class="form-control" id="confirmationInput" name="confirmationInput"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" name="deleteAccount">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- SIDEBAR -->
    <!-- /SIDEBAR -->

    <section class="content" id="content">

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <!-- <a href="#" class="btn-download">
            <i class="bx bxs-cloud-download"></i>
            <span class="text">Download PDF</span>
          </a> -->
            </div>
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

            <div class="newCard row col gap-2 col-md-9"
            style="display: flex;flex-wrap: wrap;justify-content: flex-start;align-content: flex-start;">
            <?php

           

            $query = "SELECT * FROM wishlistitems WHERE UserID = $adminId";

            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($userData = mysqli_fetch_assoc($result)) {
                    $id = $userData["ProductID"];
                    $wishId = $userData["WishlistItemID"];

                    $sql = "SELECT * FROM products where ProductID = $id";

                    $result5 = mysqli_query($conn, $sql);
                    if ($result5 && mysqli_num_rows($result5) > 0) {
                        while ($row = mysqli_fetch_assoc($result5)) {
                            echo "<div class='p-2 my-3 mx-2 rounded 'style='width: 15rem; height:15rem ;line-height:2px; background-color:white;position:relative ;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;' >";

                            echo "<img src='../uploads/" . $row['ProductImage'] . "' style='width:100% ; height:59%;object-fit: contain;' class=' rounded'>";
                            echo "<p style='white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' class='py-2'>" . $row['Name'] . "</p>";
                            echo "<p><b>" . $row['Price'] . "Dhs</b></p>";



                            echo "    <div style='display: flex;justify-content: flex-end;gap: 5px;'>";
                            echo "        <button class='btn btn-outline-primary'><i class='fa-solid fa-cart-shopping'></i></button>";
                            echo "       <form method='post'>";
                            echo "          <input type='hidden' name='wishlist_item_id' value='" . $wishId . "'>";
                            echo "          <button class='btn btn-outline-danger' name='remove_from_wishlist' id='favorite'><i class='fa-solid fa-heart'></i></button>";
                            echo "        </form>";
                            echo "    </div>";
                            echo "</div>  ";


                        }
                    }
                }
                ?>



                <?php
            } else {
                echo "User not found or database error!";
            }
            ?>
</div>
<!-- it offCavans is HIDEEN !!!! -->
<div class="offcanvas offcanvas-end" data-bs-scroll="false" tabindex="-1" id="Id2"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="staticBackdropLabel">
        Cart
      </h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <hr>
      <div class="row align-items-center">
        <div class="col-4 p-1 ">
          <!-- <img src="../img/Fashion.jpg" alt="herrr" class="rounded-2 " style="width: 100px; height: 100px; object-fit: cover;"> -->
        </div>

        <div class="col-auto">
          <div class="text-center">
            <div><strong> Xiamio n-12</strong></div>
            <div><strong>Prix : </strong>15Dh</div>
            <div><strong>Categorie : </strong>Phone & Tablets</div>
            <div class="row gap-1 ">
              <button class="btn btn-primary col-3"><i class="fa-solid fa-plus"></i></button>
              <p class="col-2">1</p>
              <button class="btn btn-primary col-3"><i class="fa-solid fa-minus"></i></button>
              <div class="btn btn-danger col-3">del</div>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row align-items-center">
        <div class="col-4 p-1 ">
          <!-- <img src="../img/Fashion.jpg" alt="here" class="rounded-2 " style="width: 100px; height: 100px; object-fit: cover;"> -->
        </div>

        <div class="col-auto">
          <div class="text-center">
            <div><strong> Xiamio n-12</strong></div>
            <div><strong>Prix : </strong>15£</div>
            <div><strong>Categorie : </strong>Phone & Tablets</div>
            <div class="row gap-1 ">
              <button class="btn btn-primary col-3"><i class="fa-solid fa-plus"></i></button>
              <p class="col-2">1</p>
              <button class="btn btn-primary col-3"><i class="fa-solid fa-minus"></i></button>
              <div class="btn btn-danger col-3">del</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
        </main>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
    <script type="text/javascript" src="../assets/JS/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script>
        $(document).ready(function () {
            $('input[type="file"]').change(function () {
                if ($(this).val()) {
                    $('#cancelButton').show();
                    $('#confirmButton').show();
                } else {
                    $('#cancelButton').hide();
                    $('#confirmButton').hide();
                }
            });

        });
    </script>

    <script>
        setTimeout(function () {
            var infoAlert = document.getElementById('infoAlert');
            if (infoAlert) {
                var bsAlert = new bootstrap.Alert(infoAlert);
                bsAlert.close();
            }
        }, 2500);

        // Automatically dismiss the error alert after 3 seconds
        setTimeout(function () {
            var errorAlert = document.getElementById('errorAlert');
            if (errorAlert) {
                var bsAlert = new bootstrap.Alert(errorAlert);
                bsAlert.close();
            }
        }, 2500);
    </script>
</body>

</html>