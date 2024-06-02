<?php
require_once '../../includes/session_test.php';
include ("../../../includes/connection.php");

if (isset($_POST['create'])) {
    // Retrieve form data
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productStock = $_POST['productStock'];
    $ProductTypeId = isset($_POST['ProductTypeId']) ? $_POST['ProductTypeId'] : NULL;

    $fileName = $_FILES['productImage']['name'];
    $fileTmpName = $_FILES['productImage']['tmp_name'];
    $uniqueFileName = uniqid() . '_' . $fileName;
    $targetFilePath = "../../../uploads/" . $uniqueFileName;

    if (move_uploaded_file($fileTmpName, $targetFilePath)) {
        if ($ProductTypeId === NULL) {
            $sql = "INSERT INTO products (Name, Description, Price, Stock, ProductImage) VALUES ('$productName', '$productDescription', '$productPrice', '$productStock', '$uniqueFileName')";
        } else {
            $sql = "INSERT INTO products (Name, Description, Price, Stock, ProductImage, ProductTypeID) VALUES ('$productName', '$productDescription', '$productPrice', '$productStock', '$uniqueFileName', '$ProductTypeId')";
        }

        if (mysqli_query($conn, $sql)) {
            $productId = mysqli_insert_id($conn);

            // Process attributes
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'attribute_') === 0) {
                    $attributeId = str_replace('attribute_', '', $key);
                    $attributeValue = mysqli_real_escape_string($conn, $value);

                    // Check and insert based on the type of attribute value
                    if ($attributeValue === '0' || $attributeValue === '1') {
                        $sqlAttr = "INSERT INTO productattributevalues (ProductID, AttributeID, ValueBoolean) VALUES ('$productId', '$attributeId', '$attributeValue')";
                    } elseif (is_numeric($attributeValue) && strpos($attributeValue, '.') !== false) {
                        $sqlAttr = "INSERT INTO productattributevalues (ProductID, AttributeID, ValueDecimal) VALUES ('$productId', '$attributeId', '$attributeValue')";
                    } elseif (is_numeric($attributeValue)) {
                        $sqlAttr = "INSERT INTO productattributevalues (ProductID, AttributeID, ValueInteger) VALUES ('$productId', '$attributeId', '$attributeValue')";
                    } elseif (strtotime($attributeValue)) {
                        $sqlAttr = "INSERT INTO productattributevalues (ProductID, AttributeID, ValueDate) VALUES ('$productId', '$attributeId', '$attributeValue')";
                    } else {
                        $sqlAttr = "INSERT INTO productattributevalues (ProductID, AttributeID, ValueString) VALUES ('$productId', '$attributeId', '$attributeValue')";
                    }

                    // Execute the query and check for errors
                    if (!mysqli_query($conn, $sqlAttr)) {
                        echo "Error inserting attribute value: " . mysqli_error($conn);
                    }
                }
            }
            $_SESSION['info'] = "The Product has been added successfully!";
            header("Location: ./");
        } else {
            $_SESSION['error'] = "Failed to updated product.";
            header("Location: ./");
            // echo "Error: Data not inserted into products table: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading file";
        exit;
    }
}
if (isset($_POST['update'])) {
    // Retrieve form data
    $productId = $_POST['productID'];
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productStock = $_POST['productStock'];
    $productTypeId = isset($_POST['ProductTypeId']) ? $_POST['ProductTypeId'] : NULL;
    $oldImage = $_POST['oldImage'];

    // Check if a new image file is uploaded
    if ($_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['productImage']['name'];
        $fileTmpName = $_FILES['productImage']['tmp_name'];
        $uniqueFileName = uniqid() . '_' . $fileName;
        $targetFilePath = "../../../uploads/" . $uniqueFileName;

        // Move the uploaded file to the destination folder
        if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            // Update the product image in the database
            if ($oldImage) {
                $oldImagePath = "../../uploads/" . $oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Remove old image file
                }
            }
            $sql = "UPDATE products SET Name = '$productName', Description = '$productDescription', Price = '$productPrice', Stock = '$productStock', ProductImage = '$uniqueFileName', ProductTypeID = '$productTypeId' WHERE ProductID = '$productId'";
        } else {
            // Handle file upload error
            echo "Error uploading file";
            exit;
        }
    } else {
        // No new image file uploaded, only update other fields
        $sql = "UPDATE products SET Name = '$productName', Description = '$productDescription', Price = '$productPrice', Stock = '$productStock', ProductTypeID = '$productTypeId' WHERE ProductID = '$productId'";
    }

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        // Process attributes
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'attribute_') === 0) {
                $attributeId = str_replace('attribute_', '', $key);
                $attributeValue = mysqli_real_escape_string($conn, $value);

                // Determine the column and value based on the attribute type
                if ($attributeValue === '0' || $attributeValue === '1') {
                    $column = 'ValueBoolean';
                } elseif (is_numeric($attributeValue) && strpos($attributeValue, '.') !== false) {
                    $column = 'ValueDecimal';
                } elseif (is_numeric($attributeValue)) {
                    $column = 'ValueInteger';
                } elseif (strtotime($attributeValue)) {
                    $column = 'ValueDate';
                } else {
                    $column = 'ValueString';
                }

                // Check if the attribute value already exists for the product
                $checkQuery = "SELECT * FROM productattributevalues WHERE ProductID = '$productId' AND AttributeID = '$attributeId'";
                $checkResult = mysqli_query($conn, $checkQuery);

                if (mysqli_num_rows($checkResult) > 0) {
                    // Update the attribute value
                    $sqlAttr = "UPDATE productattributevalues SET $column = '$attributeValue' WHERE ProductID = '$productId' AND AttributeID = '$attributeId'";
                } else {
                    // Insert the attribute value
                    $sqlAttr = "INSERT INTO productattributevalues (ProductID, AttributeID, $column) VALUES ('$productId', '$attributeId', '$attributeValue')";
                }

                // Execute the query and check for errors
                if (!mysqli_query($conn, $sqlAttr)) {
                    echo "Error updating attribute value: " . mysqli_error($conn);
                }
            }
        }
        $_SESSION['info'] = "The Product has been updated successfully!";
        header("Location: ./");
    } else {
        $_SESSION['error'] = "Failed to updated product.";
        header("Location: ./");
        // echo "Error: Data not updated in products table: " . mysqli_error($conn);
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['ProductyId'];
    $sql = "UPDATE `products` SET IsDeleted = 1 WHERE ProductID = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['info'] = "Product deleted successfully.";
        header("Location: ./");
    } else {
        $_SESSION['error'] = "Failed to delete Product.";
        // echo "Error: " . mysqli_error($conn);
    }

}

?>