<?php
require_once '../../includes/session_test.php';
include ("../../../includes/connection.php");


// process.php
if (isset($_POST['Generate'])) {

    $type_name = $_POST['type_name'];
    $inputs = $_POST['inputs'];
    $cats = $_POST['category'];

    // Insert the type into the database
    $sql = "INSERT INTO producttypes (TypeName ) VALUES ('$type_name')";
    if ($conn->query($sql) === TRUE) {
        $type_id = $conn->insert_id; // Get the ID of the newly inserted type

        // Insert each input into the database
        foreach ($inputs as $input) {
            $name = $input['value'];
            $type = $input['type'];
            $sql = "INSERT INTO productattributes (ProductTypeID, AttributeName, DataType) VALUES ('$type_id', '$name', '$type')";
            $conn->query($sql);
        }

        foreach ($cats as $selectedCategory) {
            $sql_ = "INSERT INTO ProductTypeCategories (ProductTypeID, CategoryID) VALUES ('$type_id', '$selectedCategory')";
            $conn->query($sql_);
        }

        echo "Data inserted successfully!";
    $_SESSION['info'] = "Product Type is added successfully.";

    } else {
        echo "Error: " . $conn->error;
    }
    header("Location: ./");
    exit();
}

if (isset($_POST['Update'])) {
    // Extracting values from the form submission
    $productTypeId = $_POST['type_id'];
    $typeName = $_POST['type_name'];

    $selectedCategories = isset($_POST['category']) ? $_POST['category'] : [];

    // Update product type name
    $sqlUpdateType = "UPDATE producttypes SET TypeName = '$typeName' WHERE ProductTypeID = $productTypeId";
    mysqli_query($conn, $sqlUpdateType);

    // Retrieve existing attribute IDs associated with the product type
    $existingAttributeIds = [];
    $sqlExistingAttributes = "SELECT AttributeID FROM productattributes WHERE ProductTypeID = $productTypeId";
    $resultExistingAttributes = mysqli_query($conn, $sqlExistingAttributes);
    while ($row = mysqli_fetch_assoc($resultExistingAttributes)) {
        $existingAttributeIds[] = $row['AttributeID'];
    }

    // Retrieve existing categories associated with the product type
    $existingCategoryIDs = [];
    $existingCategoriesQuery = "SELECT CategoryID FROM ProductTypeCategories WHERE ProductTypeID = $productTypeId";
    $existingCategoriesResult = mysqli_query($conn, $existingCategoriesQuery);
    while ($row = mysqli_fetch_assoc($existingCategoriesResult)) {
        $existingCategoryIDs[] = $row['CategoryID'];
    }

    // Update or insert product attributes
    if (isset($_POST['inputs'])) {
        $submittedAttributeIds = [];
        foreach ($_POST['inputs'] as $index => $input) {
            $attributeId = $input['attribute_id'];
            $attributeName = $input['value'];
            $dataType = $input['type'];

            if (!empty($attributeId) && $attributeId !== "undefined") {
                // Update existing attribute
                $sqlUpdateAttribute = "UPDATE productattributes SET AttributeName = '$attributeName', DataType = '$dataType' WHERE AttributeID = $attributeId";
                mysqli_query($conn, $sqlUpdateAttribute);
                $submittedAttributeIds[] = $attributeId;
            } else if (!empty($attributeName)) {
                // Insert new attribute
                $sqlInsertAttribute = "INSERT INTO productattributes (ProductTypeID, AttributeName, DataType) VALUES ($productTypeId, '$attributeName', '$dataType')";
                mysqli_query($conn, $sqlInsertAttribute);
                $submittedAttributeIds[] = mysqli_insert_id($conn);
            }
        }

        // Find attribute IDs that exist in the database but not in the submitted form inputs
        $missingAttributeIds = array_diff($existingAttributeIds, $submittedAttributeIds);

        // Delete attributes that are in the database but not in the submitted form inputs
        if (!empty($missingAttributeIds)) {
            $sqlDeleteAttributes = "DELETE FROM productattributes WHERE AttributeID IN (" . implode(',', $missingAttributeIds) . ")";
            mysqli_query($conn, $sqlDeleteAttributes);
        }
    }

    // Add new categories
    foreach ($selectedCategories as $selectedCategory) {
        if (!in_array($selectedCategory, $existingCategoryIDs)) {
            $insertQuery = "INSERT INTO ProductTypeCategories (ProductTypeID, CategoryID) VALUES ($productTypeId, $selectedCategory)";
            mysqli_query($conn, $insertQuery);
        }
    }

    // Remove deselected categories
    foreach ($existingCategoryIDs as $existingCategoryID) {
        if (!in_array($existingCategoryID, $selectedCategories)) {
            $deleteQuery = "DELETE FROM ProductTypeCategories WHERE ProductTypeID = $productTypeId AND CategoryID = $existingCategoryID";
            mysqli_query($conn, $deleteQuery);
        }
    }

    // Redirect to a success page or display a success message
    $_SESSION['info'] = "Product Type is Updated successfully.";
    header("Location: ./");
    exit();
}

if (isset($_POST['delete'])) {
    $id = $_POST['product_type_id'];
    $sql = "UPDATE `producttypes` SET IsDeleted = 1 WHERE ProductTypeID = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['info'] = "Product Type is deleted successfully.";
        header("Location: ./");
    } else {
        $_SESSION['error'] = "Failed to delete Product Type.";
        // echo "Error: " . mysqli_error($conn);
    }

}

// Close database connection
mysqli_close($conn);
?>