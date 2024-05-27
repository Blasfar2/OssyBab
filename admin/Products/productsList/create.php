<?php
require_once '../../includes/session_test.php';
include ("../../../includes/connection.php");
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" />

    <link rel="stylesheet" href="../../assets/css/nav_sidebar.css" />
    <!-- <link rel="stylesheet" href="../assets/css/style.css" /> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        crossorigin="anonymous" />

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

    <style>
        ul {
            padding-left: 0rem;
        }

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
        table,
        th,
        td {
            height: 20px;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>

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
                    <h1>Add Product</h1>
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
                            <a href="#">Add Products</a>
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
                                    style="display: flex; align-items: center;">Back
                                    to home</a>
                            </div>
                            <br>

                            <div class="card">
                                <div class="card-body">
                                    <div class="both" style="display: flex;">
                                        <div style="width: 25%; margin: 5px; padding: 5px;">
                                            <div class="form-element my-4">
                                                <p class="image-text">Preview Image : </p>
                                                <img id="imgPreview" src="../../assets/img/placeholder-image.jpg"
                                                    alt="Preview" class="preview-image">
                                            </div>
                                        </div>
                                        <div style="width: 75%; margin: 80px 10px;">
                                            <form action="process.php" method="post" enctype="multipart/form-data"
                                                class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">product Name</label>
                                                    <input type="text" name="productName" class="form-control"
                                                        placeholder="product Name " required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">product Description</label>
                                                    <input type="text" name="productDescription" class="form-control"
                                                        placeholder="product Description " required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Price</label>
                                                    <input type="number" step="0.01" name="productPrice"
                                                        class="form-control" placeholder="Price" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">product in Stock</label>
                                                    <input type="number" name="productStock" class="form-control"
                                                        placeholder="product Stock " required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">product Image</label>
                                                    <input type="file" name="productImage" class="form-control"
                                                        required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">product Type</label>
                                                    <select class="form-select"  id="productTypeSelect" aria-label="Select product type" name="ProductTypeId">
                                                        <option selected>Open this select menu</option>
                                                        <?php

                                                        $sql = "SELECT * FROM producttypes";
                                                        $result = mysqli_query($conn, $sql);
                                                        // Check if records exist
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo '<option value="' . $row['ProductTypeID'] . '">' . $row['TypeName'] . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option disabled>No product types found</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div id="attributeFields"></div>

                                                <div class="col-12" style="display: flex;justify-content: center;">
                                                    <input type="submit" class="btn btn-success" name="create"
                                                        value="Add Product">
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
    <script src="../../assets/js/script.js"></script>
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
    <script>
$(document).ready(function() {
    $('#productTypeSelect').change(function() {
        var productTypeID = $(this).val();
        if (productTypeID !== '') {
            $.ajax({
                url: 'fetch_attributes.php',
                type: 'post',
                data: { productTypeID: productTypeID },
                dataType: 'json',
                success: function(response) {
                    // Clear previous attributes
                    $('#attributeFields').empty();
                    // Dynamically generate labels and inputs for each attribute within a table
                    var table = $('<table>').addClass('table');
                    $.each(response, function(index, attribute) {
                        var row = $('<tr>');
                        var labelCell = $('<td>').append($('<label>').addClass('form-label').text(attribute.AttributeName));
                        var inputCell = $('<td>');
                        var inputAttributes = {
                            type: 'text', // default to text input
                            name: 'attribute_' + attribute.AttributeID,
                            class: 'form-control',
                            placeholder: 'Sample text'
                        };
                        if (attribute.DataType === 'integer') {
                            inputAttributes.type = 'number';
                            inputAttributes.step = '1';
                            inputAttributes.placeholder = 'Example: 123';
                        } else if (attribute.DataType === 'decimal') {
                            inputAttributes.type = 'number';
                            inputAttributes.step = '0.01';
                            inputAttributes.placeholder = 'Example: 123.45';
                        } else if (attribute.DataType === 'boolean') {
                            inputAttributes.type = 'checkbox';
                            inputAttributes.class = 'form-check-input';
                        } else if (attribute.DataType === 'date') {
                            inputAttributes.type = 'date';
                        }
                        inputCell.append($('<input>').attr(inputAttributes));
                        row.append(labelCell, inputCell);
                        table.append(row);
                    });
                    $('#attributeFields').append(table);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error fetching attributes. Please try again.');
                }
            });
        } else {
            // Clear attributes if no product type is selected
            $('#attributeFields').empty();
        }
    });
});
</script>



</body>

</html>