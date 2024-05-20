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
                    <h1>Add Category</h1>
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
                            <a href="#">Add Category</a>
                        </li>
                    </ul>
                </div>

            </div>
            <div style="
    display: flex;
    justify-content: center;
">
                <div class="table-data" style="width: 90%;">
                    <div class="order">
                        <div class="container-fluid admin">
                            <div style="display: flex;flex-direction: row;justify-content: flex-end;">
                                <a href="./" class="btn btn-primary bt-sm"
                                    style="display: flex; align-items: center;">Back
                                    to home</a>
                            </div>
                            <br>

                            <div class="card">
                                <div class="card-body">
                                    <div class="both" style="
    display: flex;
">
                                        <div style="
   
   width: 25%;
    margin: 5px;
    padding: 5px;

">
                                            <div class="form-element my-4">
                                                <p class="image-text">Preview Image : </p>
                                                <img id="imgPreview" src="../assets/img/placeholder-image.jpg" alt="Preview"
                                                    class="preview-image">
                                            </div>
                                        </div>
                                        <div style="
    width: 75%;
    margin: 80px 10px;
">
                                            <form action="process.php" method="post" enctype="multipart/form-data">
                                                <div class="form-element my-4">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Category Name " required>
                                                </div>
                                                <div class="form-element my-4">
                                                    <input type="text" name="categoryDescription" class="form-control"
                                                        placeholder="Category Description " required>
                                                </div>
                                                <div class="form-element my-4">
                                                    <input type="file" name="image" class="form-control" required>
                                                </div>

                                                <div class="form-element"
                                                    style="display: flex;justify-content: center;">
                                                    <input type="submit" class="btn btn-success" name="create"
                                                        value="Add Category">
                                                </div>
                                            </form>
                                        </div>
                                    </div>




                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </main>
    </section>
    <script src="../assets/js/script.js"></script>
    <script>
        $(document).ready(function () {
            // Function to preview image
            function previewImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#imgPreview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // Convert to base64 string
                }
            }

            // Trigger the function when a file is selected
            $('input[type="file"]').change(function () {
                var file = this.files[0];
                var fileExtension = file.name.split('.').pop().toLowerCase();
                var allowedExtensions = ['jpg', 'jpeg', 'png', 'svg'];

                // Check if the file type is an image with allowed extension
                if ($.inArray(fileExtension, allowedExtensions) !== -1) {
                    previewImage(this);
                } else {
                    // Reset the file input if it's not an image with allowed extension
                    $(this).val('');
                    alert('Please select a valid image file with extension .jpg, .jpeg, .png, or .svg.');
                }
            });
        });
    </script>

</body>

</html>