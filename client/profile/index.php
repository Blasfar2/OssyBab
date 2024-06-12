<?php
require_once '../../includes/session_test.php';
include ("../../includes/connection.php");
$adminId = $_SESSION['id'];
include ("../proccess.php");
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

    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../../assets/css/styles.css"> -->
    <link rel="stylesheet" href="../../assets/css/range.css">
    <link rel="stylesheet" href="../style.css">



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

    <?php include ('../navbar.php'); ?>
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
    <!-- Image Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- default image where we will set the src via jquery -->
                                <img id="image" class="img-fluid">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancelModalImg" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="cropped">Crop</button>
                </div>
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

            $query = "SELECT * FROM users WHERE UserID = $adminId";

            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $userData = mysqli_fetch_assoc($result);
                ?>

                <!-- ------------------------------------------------------------------------------  -->

                <div class="container-l px-4 mt-4">
                    <!-- <hr class="mt-0 mb-4" /> -->
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>

                                <div class="card-body text-center">

                                    <img id="imgPreview" class="img-account-profile rounded-circle mb-2"
                                        src="../../uploads/<?php echo $userData['UserImage']; ?>" alt />
                                    <div class="small font-italic text-muted mb-4">
                                        JPG or PNG no larger than 5 MB
                                    </div>
                                    <form action="process.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" id="imagePreviewInput" name="imagePreview">
                                        <input type="hidden" name="userId" value="<?php echo $userData['UserID']; ?>">
                                        <input type="hidden" name="oldImage" value="<?php echo $userData['UserImage']; ?>">
                                        <input type="file" name="userImage" class="userImg form-control">

                                        <br>
                                        <button class="btn btn-success" type="submit" name="confirmButton"
                                            id="confirmButton">Upload new
                                            image</button>
                                        <button type="button" id="cancelButton" class="btn btn-danger">Cancel</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="card mb-4">
                                <div class="card-header">Account Details</div>
                                <div class="card-body">
                                    <form action="process.php" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
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

                                        </div>
                                        <div class="mb-3">
                                            <input name="userID" type="hidden" value="<?php echo $adminId; ?>" />
                                            <label class="small mb-1" for="inputUsername">Username </label>
                                            <input class="form-control" id="inputUsername" name="username" type="text"
                                                placeholder="Enter your username"
                                                value="<?php echo $userData['Username']; ?>" />
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputFirstName">First name</label>
                                                <input class="form-control" id="inputFirstName" name="firstName" type="text"
                                                    placeholder="Enter your first name"
                                                    value="<?php echo $userData['FirstName']; ?>" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputLastName">Last name</label>
                                                <input class="form-control" id="inputLastName" name="lastName" type="text"
                                                    placeholder="Enter your last name"
                                                    value="<?php echo $userData['LastName']; ?>" />
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputCity">City</label>
                                                <input class="form-control" id="inputCity" name="city" type="text"
                                                    placeholder="Enter your location"
                                                    value="<?php echo $userData['City']; ?>" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputZipCode">Zip Code</label>
                                                <input class="form-control" id="inputZipCode" name="zipCode" type="text"
                                                    placeholder="Enter your ZipCode"
                                                    value="<?php echo $userData['ZipCode']; ?>" />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputFullAddress">Full Address</label>
                                            <input class="form-control" id="inputFullAddress" name="fullAddress" type="text"
                                                placeholder="Enter your location"
                                                value="<?php echo $userData['Address']; ?>" />
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                                <input class="form-control" id="inputEmailAddress" name="emailAddress"
                                                    type="email" name="birthday" placeholder="name@example.com"
                                                    value="<?php echo $userData['Email']; ?>" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPhoneNumber">Phone number</label>
                                                <input class="form-control" id="inputPhoneNumber" name="phoneNumber"
                                                    type="tel" placeholder="+212-XXXXXXXXX"
                                                    value="<?php echo $userData['PhoneNumber']; ?>" />
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit" name="updateDetails">
                                            Save changes
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ------------------------------------------------------------------------------ -->
                <div class="container-l px-4 mt-4">
                    <div class="row">
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-8">
                            <!-- Change password card-->
                            <div class="card mb-4">
                                <div class="card-header">Change Password</div>
                                <div class="card-body">
                                    <form action="process.php" method="post" enctype="multipart/form-data">
                                        <!-- Form Group (current password)-->
                                        <div class="mb-3">
                                            <input name="userID" type="hidden" value="<?php echo $adminId; ?>" />
                                            <label class="small mb-1" for="currentPassword">Current Password</label>
                                            <input class="form-control" id="currentPassword" name="currentPassword"
                                                type="password" placeholder="Enter current password" required />
                                        </div>
                                        <!-- Form Group (new password)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="newPassword">New Password</label>
                                            <input class="form-control" id="newPassword" name="newPassword" type="password"
                                                placeholder="Enter new password" required />
                                        </div>
                                        <!-- Form Group (confirm password)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                                            <input class="form-control" id="confirmPassword" name="confirmPassword"
                                                type="password" placeholder="Confirm new password" required />
                                        </div>
                                        <button class="btn btn-primary" type="submit" name="updatePassword">Save</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Delete account card-->
                            <div class="card mb-4">
                                <div class="card-header">Delete Account</div>
                                <div class="card-body">
                                    <p>
                                        Deleting your account is a permanent action and cannot be
                                        undone. If you are sure you want to delete your account, select
                                        the button below.
                                    </p>
                                    <button class="btn btn-danger-soft text-danger" type="button" data-bs-toggle="modal"
                                        data-bs-target="#deleteAccountModal">
                                        I understand, delete my account
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <?php
            } else {
                echo "User not found or database error!";
            }
            ?>

        </main>
    </section>
    <script src="../../assets/JS/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
    <script type="text/javascript" src="../../assets/JS/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="../script.js"></script>
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

            $('#navBarHome').each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', '../' + href);
            });
            $('#dropdown-menu1 a').each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', '../' + href);
            });
            $('.profile-menu1 img').each(function () {
                var src = $(this).attr('src');
                $(this).attr('src', '../' + src);
            });
            

            $('#cancelButton, #cancelModalImg').click(function () {
                $('input[type="file"]').val('');
                $('#imgPreview').attr('src', '../../assets/img/profile.jpg');
                $('#cancelButton').hide();
                $('#confirmButton').hide();
            });
        });
    </script>
    <script>

        var bs_modal = $('#modal');
        var image = document.getElementById('image');
        var cropper, reader, file;

        $("body").on("change", ".userImg", function (e) {
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                bs_modal.modal('show');
            };

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        bs_modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $("#cropped").click(function () {
            canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200,
            });

            canvas.toBlob(function (blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "crop_image_upload.php",
                        data: { image: base64data },
                        success: function (data) {
                            done(data.image_path);
                            bs_modal.modal('hide');
                        }
                    });
                };
            });
        });

        function done(url) {
            $('#imgPreview').attr('src', url);
            $("#imagePreviewInput").val(url);
            // var filename = url.substring(url.lastIndexOf('/') + 1);
            // $("#imagePreviewInput").val(filename);
        }



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