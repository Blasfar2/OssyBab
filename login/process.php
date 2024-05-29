<?php
    include "../includes/connection.php";

    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);


        $sql = "SELECT * FROM users WHERE Email = '$email'";
        $res = mysqli_query($conn,$sql);
        $rowCount = mysqli_num_rows($res);
        if($rowCount>0){
            echo"<div class='alert alert-success'>Email already exists</div>";
        }

        $sql = "INSERT INTO users (Username, PasswordHash, Email) VALUES ('$username', '$passwordHash', '$email')";
        if(mysqli_query($conn, $sql)){
                echo"<div class='alert alert-success'>Registered successfully</div>";
                session_start();

            $_SESSION['username']= $username;

            // Get the ID of the inserted user
            $userId = mysqli_insert_id($conn);
            $_SESSION['user_id'] = $userId;

            header("Location: ../index.php");
            die();
        }else{
            echo "Registration failed";
        }
        }

        if(isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM users WHERE Email = '$email' AND archived = 0";
            $result = mysqli_query($conn,$sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user){
                 if(password_verify($password,$user["PasswordHash"])){
                    session_start();
                    
                   
                    $_SESSION['username']=$user["Username"];
                    $_SESSION['id']=$user["UserID"];
                    $_SESSION['UserImage']=$user["UserImage"];
                    if ($user["is_admin"]) {
                        header("Location: ../admin/dashboard/");
                    } else {
                        // $_SESSION['user']="yes";
                        $_SESSION['username']=$user["Username"];
                        $_SESSION['id']=$user["UserID"];
                        header("Location: ../index.php");
                    }
                    
                    
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password doesn t match </div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email or Password doesn t match </div>";
            }
        }
    
?>