<?php
require_once '../includes/session_test.php';
include ("../../includes/connection.php");
$adminId = $_SESSION['id'];

if (isset($_GET['token']) && isset($_GET['order_id'])) {
    if ($_GET['token'] === $_SESSION['token']) {
        $order_id = $_GET['order_id'];
        $_SESSION['token']='';
    } else {
        header("Location: ./");
    }
} else {
    header("Location: ./");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    hi
</body>
</html>