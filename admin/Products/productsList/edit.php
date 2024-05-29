<?php
require_once '../../includes/session_test.php';
include ("../../../includes/connection.php");

$adminId = $_SESSION['id'];
if (isset($_GET['token']) && isset($_GET['prod_id'])) {
    if ($_GET['token'] === $_SESSION['token']) {

        $product_id = $_GET['prod_id'];

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
                    max-width: 50%;
                    max-height: 50%;
                    width: auto;
                    height: auto;
                    border-radius: 10px;
                    margin-left: 15%;
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

                #cancelButton {
                    display: none;
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
                                    <?php
                                    echo "<script>var productId = $product_id;</script>";

                                    $sql = "SELECT * FROM products WHERE ProductID = '$product_id'";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="both" style="display: flex;">
                                                    <div style="width: 25%; margin: 5px; padding: 5px; margin-right:-5%;">
                                                        <div class="form-element my-4">
                                                            <p class="image-text">Current Image : </p>
                                                            <?php echo "<img src='../../../uploads/" . $row['ProductImage'] . "' class='preview-image' alt='Preview'>"; ?>
                                                        </div>
                                                        <div class="form-element my-4">
                                                            <p class="image-text">New Image : </p>
                                                            <div>
                                                                <div>

                                                                    <img id="imgPreview"
                                                                        src="../../assets/img/placeholder-image.jpg" alt="Preview"
                                                                        class="preview-image">
                                                                </div>
                                                                <br>
                                                                <div style="width: 85%;text-align: center;">
                                                                    <!-- Cancel Button -->
                                                                    <button type="button" id="cancelButton"
                                                                        class="btn btn-danger">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="width: 75%; margin: 80px 10px;">
                                                        <form id="formId" action="process.php" method="post"
                                                            enctype="multipart/form-data" class="row g-3">

                                                            <div class="col-md-6">
                                                                <input type="hidden" name="productID"
                                                                    value="<?php echo $row['ProductID']; ?>">
                                                                <input type="hidden" name="oldImage"
                                                                    value="<?php echo $row['ProductImage']; ?>">
                                                                <p class="form-label">product Name</p>
                                                                <input type="text" name="productName" class="form-control"
                                                                    placeholder="product Name" value="<?php echo $row['Name']; ?>"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="form-label">product Description</p>
                                                                <input type="text" name="productDescription" class="form-control"
                                                                    placeholder="product Description"
                                                                    value="<?php echo $row['Description']; ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="form-label">Price</p>
                                                                <input type="number" step="0.01" name="productPrice"
                                                                    class="form-control" placeholder="Price"
                                                                    value="<?php echo $row['Price']; ?>" required>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <p class="form-label">product in Stock</p>
                                                                <input type="number" name="productStock" class="form-control"
                                                                    placeholder="product Stock "
                                                                    value="<?php echo $row['Stock']; ?>" required>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <p class="form-label">product Image</p>
                                                                <input type="file" name="productImage" class="form-control">
                                                            </div>

                                                            <?php

                                                            // Fetch the product type ID associated with the product
                                                            $sql = "SELECT ProductTypeID FROM products WHERE ProductID = $product_id";
                                                            $result = mysqli_query($conn, $sql);

                                                            // Check if the query was successful and if the product type ID was found
                                                            if ($result && mysqli_num_rows($result) > 0) {
                                                                $row = mysqli_fetch_assoc($result);
                                                                $productTypeID = $row['ProductTypeID'];

                                                                // Output the dropdown menu with the selected option
                                                                echo '<div class="col-md-6">';
                                                                echo '<p class="form-label">Product Type</p>';
                                                                echo '<select class="form-select" id="productTypeSelect" aria-label="Select product type" name="ProductTypeId">';
                                                                echo '<option value="" selected>Select product type</option>';

                                                                $sql = "SELECT * FROM producttypes";
                                                                $result = mysqli_query($conn, $sql);
                                                                if ($result && mysqli_num_rows($result) > 0) {
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        $selected = ($productTypeID == $row['ProductTypeID']) ? 'selected' : '';
                                                                        echo '<option value="' . $row['ProductTypeID'] . '" ' . $selected . '>' . $row['TypeName'] . '</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option disabled>No product types found</option>';
                                                                }

                                                                echo '</select>';
                                                                echo '</div>';

                                                            } else {
                                                                // Handle case where product type ID is not found
                                                                echo "Product type ID not found for the given product ID.";
                                                            }
                                                            ?>

                                                            <div id="attributeFields"></div>

                                                            <div class="col-12" style="display: flex;justify-content: center;">
                                                                <input type="submit" class="btn btn-success" name="update"
                                                                    value="Update Product">
                                                            </div>
                                                        </form>
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

                    // Function to handle file input change
                    $('input[type="file"]').change(function () {
                        if ($(this).val()) {
                            $('#cancelButton').show();
                        } else {
                            $('#cancelButton').hide();
                        }
                    });

                    // Function to handle cancel button click
                    $('#cancelButton').click(function () {
                        $('input[type="file"]').val('');
                        $('#imgPreview').attr('src', '../../assets/img/placeholder-image.jpg');
                        $(this).hide();
                    });
                });
            </script>
            <script>
                $(document).ready(function () {
                    // Define a function to fetch attributes and generate inputs
                    function fetchAndDisplayAttributes(productTypeID, productID) {
                        if (productTypeID !== '') {
                            $.ajax({
                                url: 'fetch_attributes_update.php',
                                type: 'post',
                                data: { productTypeID: productTypeID, productID: productID }, // Sending both productTypeID and productID to server
                                dataType: 'json',
                                success: function (response) {
                                    console.log('Response:', response);
                                    $('#attributeFields').empty();
                                    var table = $('<table>').addClass('table');
                                    $.each(response, function (index, attribute) {
                                        var row = $('<tr>');
                                        var labelCell = $('<td>').append($('<p>').addClass('form-label').text(attribute.AttributeName));
                                        var inputCell = $('<td>');
                                        var inputAttributes = {
                                            type: 'text', // default to text input
                                            name: 'attribute_' + attribute.AttributeID,
                                            class: 'form-control',
                                        };
                                        // Set input attributes based on attribute data type
                                        switch (attribute.DataType) {
                                            case 'string':
                                                inputAttributes.value = attribute.Values[0].ValueString; // Update with appropriate value
                                                inputCell.append($('<input>').attr(inputAttributes));
                                                break;
                                            case 'integer':
                                                inputAttributes.type = 'number';
                                                inputAttributes.value = attribute.Values[0].ValueInteger; // Update with appropriate value
                                                inputCell.append($('<input>').attr(inputAttributes));
                                                break;
                                            case 'decimal':
                                                inputAttributes.type = 'number';
                                                inputAttributes.step = '0.01';
                                                inputAttributes.value = attribute.Values[0].ValueDecimal; // Update with appropriate value
                                                inputCell.append($('<input>').attr(inputAttributes));
                                                break;
                                            case 'boolean':
                                                inputAttributes.type = 'checkbox';
                                                inputAttributes.class = 'form-check-input';
                                                inputAttributes.name = '';
                                                if (attribute.Values[0].ValueBoolean == 1) {
                                                    inputAttributes.checked = true;
                                                }
                                                // Add the checkbox input
                                                var checkbox = $('<input>').attr(inputAttributes);
                                                // Add a hidden input to hold the unchecked value
                                                var hiddenInput = $('<input>').attr({
                                                    type: 'hidden',
                                                    name: 'attribute_' + attribute.AttributeID,
                                                    value: '0'
                                                });
                                                inputCell.append(hiddenInput).append(checkbox);
                                                // Update the hidden input value on change
                                                checkbox.change(function () {
                                                    hiddenInput.val(this.checked ? 1 : 0);
                                                });
                                                break;
                                            case 'date':
                                                inputAttributes.type = 'date';
                                                inputAttributes.value = attribute.Values[0].ValueDate; // Update with appropriate value
                                                inputCell.append($('<input>').attr(inputAttributes));
                                                break;
                                        }
                                        // inputCell.append($('<input>').attr(inputAttributes));
                                        row.append(labelCell, inputCell);
                                        table.append(row);
                                    });
                                    $('#attributeFields').append(table);
                                },
                                error: function (xhr, status, error) {
                                    console.error(xhr.responseText);
                                    alert('Error fetching attributes. Please try again.');
                                }
                            });
                        } else {
                            // Clear attributes if no product type is selected
                            $('#attributeFields').empty();
                        }
                    }

                    var productTypeID = $('#productTypeSelect').val();
                    fetchAndDisplayAttributes(productTypeID, productId); // Pass productId here

                    $('#productTypeSelect').change(function () {
                        var productTypeID = $(this).val();
                        // Call the function when product type is changed
                        fetchAndDisplayAttributes(productTypeID, productId); // Pass productId here
                    });
                    // Convert only decimal inputs to the correct format on form submission
                    $('#formId').submit(function () {
                        $('input[type="number"][step="0.01"]').each(function () {
                            var decimalValue = parseFloat($(this).val()).toFixed(2);
                            $(this).val(decimalValue);
                        });
                    });
                });


            </script>
            <?php
    }

} else {
    header("Location: ./");
}
?>
</body>

</html>