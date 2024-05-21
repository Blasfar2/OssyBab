<?php
require_once '../includes/session_test.php';
include ("../../includes/connection.php");

if (isset($_POST['create'])) {
    $name = mysqli_real_escape_string($conn, $_POST['categoryName']);
    $categoryDescription = mysqli_real_escape_string($conn, $_POST['categoryDescription']);

    $fileName = $_FILES['categoryImage']['name'];
    $fileTmpName = $_FILES['categoryImage']['tmp_name'];
    $uniqueFileName = uniqid() . '_' . $fileName;
    $targetFilePath = "../../uploads/" . $uniqueFileName;

    $checkExistence = "SELECT * FROM categories WHERE LOWER(CategoryName) = LOWER('$name')";
    $result = mysqli_query($conn, $checkExistence);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0) {
        echo "Category exists";
        exit;
    } else {

        if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            $sql = "INSERT INTO categories (CategoryName, Description, CategoryImage) VALUES ('$name', '$categoryDescription','$uniqueFileName')";
            if (mysqli_query($conn, $sql)) {
                // session_start();
                // $_SESSION['create'] = "The category has been added successfully!";
                header("Location: ./");
            } else {
                echo "Error: Data not inserted";
            }
        } else {
            echo "Error uploading file";
            exit;
        }

    }
}
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['categoryId']);
    $name = mysqli_real_escape_string($conn, $_POST['categoryName']);
    $categoryDescription = mysqli_real_escape_string($conn, $_POST['categoryDescription']);
    $oldImage = $_POST['oldImage'];


    if ($_FILES['categoryImage']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['categoryImage']['name'];
        $fileTmpName = $_FILES['categoryImage']['tmp_name'];
        $uniqueFileName = uniqid() . '_' . $fileName;
        $targetFilePath = "../../uploads/" . $uniqueFileName;

        if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            // Delete old image file if it exists
            // $oldImage = mysqli_fetch_assoc(mysqli_query($conn, "SELECT CategoryImage FROM categories WHERE CategoryID='$id'"))['CategoryImage'];
            if ($oldImage) {
                $oldImagePath = "../../uploads/" . $oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Remove old image file
                }
            }

            // Update category information including image
            $sql = "UPDATE categories SET CategoryName='$name', Description='$categoryDescription', CategoryImage='$uniqueFileName' WHERE CategoryID='$id'";
        } else {
            echo "Error uploading file";
            exit;
        }
    } else {
        $sql = "UPDATE categories SET CategoryName='$name', Description='$categoryDescription' WHERE CategoryID='$id'";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: ./");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>