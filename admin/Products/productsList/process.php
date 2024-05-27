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
                    if (is_numeric($attributeValue) && strpos($attributeValue, '.') !== false) {
                        $sqlAttr = "INSERT INTO productattributevalues (ProductID, AttributeID, ValueDecimal) VALUES ('$productId', '$attributeId', '$attributeValue')";
                    } elseif (is_numeric($attributeValue)) {
                        $sqlAttr = "INSERT INTO productattributevalues (ProductID, AttributeID, ValueInteger) VALUES ('$productId', '$attributeId', '$attributeValue')";
                    } elseif ($attributeValue === '0' || $attributeValue === '1') {
                        $sqlAttr = "INSERT INTO productattributevalues (ProductID, AttributeID, ValueBoolean) VALUES ('$productId', '$attributeId', '$attributeValue')";
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
            header("Location: ./");
        } else {
            echo "Error: Data not inserted into products table: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading file";
        exit;
    }
}
?>
