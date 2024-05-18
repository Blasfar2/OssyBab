<?php
    $hostName = "localhost";
    $dbUser = "root";
    $dbPassword="";
    $dbName="badrsama";
    
    $conn = mysqli_connect($hostName,$dbUser,$dbPassword,$dbName);

    if(!$conn){
        die("Couldn't connect to the database");
    }

?>