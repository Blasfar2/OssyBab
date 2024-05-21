<?php
    session_start();
    if(!isset($_SESSION['id']) && !isset($_SESSION['username'])){
        header("Location: ../../login/");
    }
?>