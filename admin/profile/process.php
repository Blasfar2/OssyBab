<?php
require_once '../includes/session_test.php';
include ("../../includes/connection.php");

if (isset($_POST['updateDetails'])) {
    // Escape user inputs for security
    $userID = mysqli_real_escape_string($conn, $_POST['userID']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $zipCode = mysqli_real_escape_string($conn, $_POST['zipCode']);
    $fullAddress = mysqli_real_escape_string($conn, $_POST['fullAddress']);
    $email = mysqli_real_escape_string($conn, $_POST['emailAddress']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);

    // Check if the new email already exists in the database
    $emailCheckQuery = "SELECT UserID FROM users WHERE Email='$email' AND UserID != $userID";
    $emailCheckResult = mysqli_query($conn, $emailCheckQuery);
    if (mysqli_num_rows($emailCheckResult) > 0) {
        // Email already exists, set error message
        $error = "The email address is already in use.";
        $_SESSION['error'] = $error;
        $query = "UPDATE users SET username='$username',FirstName='$firstName', LastName='$lastName', City='$city', ZipCode='$zipCode', Address='$fullAddress', PhoneNumber='$phoneNumber' WHERE UserID=$userID";

        if (mysqli_query($conn, $query)) {
            $info = "Your account details have been successfully updated!";
            $_SESSION['info'] = $info;
        }
    } else {
        // Update user details in the database
        $query = "UPDATE users SET username='$username',FirstName='$firstName', LastName='$lastName', City='$city', ZipCode='$zipCode', Address='$fullAddress', Email='$email', PhoneNumber='$phoneNumber' WHERE UserID=$userID";

        if (mysqli_query($conn, $query)) {
            // Set success message if update succeeds
            $info = "Your account details have been successfully updated!";
            $_SESSION['info'] = $info;
        } else {
            // Set error message if update fails
            $error = "Failed to update account details. Please try again later.";
            $_SESSION['error'] = $error;
        }
    }
    // Redirect back to the profile page
    header("Location: ./");
    exit();
}

if (isset($_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword'])) {
    // $userID = $_SESSION['id'];
    $userID = $_POST['userID'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "New password and confirm password do not match.";
        header("Location: ./");
        exit();
    }

    // Retrieve current password hash from the database
    $query = "SELECT PasswordHash FROM users WHERE UserID = $userID";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $currentPasswordHash = $row['PasswordHash'];

    // Verify if the current password is correct
    if (password_verify($currentPassword, $currentPasswordHash)) {
        // Hash the new password
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $updateQuery = "UPDATE users SET PasswordHash = '$newPasswordHash' WHERE UserID = $userID";
        if (mysqli_query($conn, $updateQuery)) {
            $_SESSION['info'] = "Password updated successfully.";
            header("Location: ./");
            exit();
        } else {
            $_SESSION['error'] = "Failed to update password. Please try again later.";
            header("Location: ./");
            exit();
        }
    } else {
        $_SESSION['error'] = "Incorrect current password.";
        header("Location: ./");
        exit();
    }
} 
if (isset($_POST['confirmationInput'])) {
    $confirmationInput = $_POST['confirmationInput'];
    $userID =$_POST['userID'];
    
    // Check if the confirmation input matches the required value
    if ($confirmationInput === "DELETE") {
        // Delete the account
        $deleteQuery = "UPDATE users SET archived = 1 WHERE UserID = $userID";
        if (mysqli_query($conn, $deleteQuery)) {
            // Account deleted successfully, logout and redirect to a logout page
            session_destroy();
            header("Location: ../logout.php");
            exit();
        } else {
            // Failed to delete account, set error message and redirect back
            $_SESSION['error'] = "Failed to delete account. Please try again later.";
            header("Location: ./");
            exit();
        }
    } else {
        // Confirmation input doesn't match required value, set error message and redirect back
        $_SESSION['error'] = "Confirmation input incorrect. Account not deleted.";
        header("Location: ./");
        exit();
    }
} 

if (isset($_POST['confirmButton'])) {
    $id = $_POST['userId'];
    $oldImage = $_POST['oldImage'];

    // Check if the image preview is set
    if (isset($_POST['imagePreview'])) {
        $tempImagePath = $_POST['imagePreview']; // Get the path of the temporary image
        // Generate a unique filename for the image
        $uniqueFileName = uniqid() . '.png';
        $targetFilePath = "../../uploads/" . $uniqueFileName;

        // Copy the temporary image to the uploads folder
        if (copy($tempImagePath, $targetFilePath)) {
            // Delete old image file if it exists
            if ($oldImage) {
                $oldImagePath = "../../uploads/" . $oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Remove old image file
                }
            }

            // Update user information including image
            $sql = "UPDATE users SET UserImage='$uniqueFileName' WHERE UserID='$id'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['UserImage'] = "../../uploads/" . $uniqueFileName;
                header("Location: ./");
                exit;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error copying file";
            exit;
        }
    } else {
        echo "Image preview not set";
        exit;
    }
}
// else {
//     // Redirect to the change password page if form fields are not submitted
//     header("Location: ./");
//     exit();
// }






?>
