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
?>