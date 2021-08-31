<?php 
    session_start();

    if(isset($_GET["logout"])){
        unset($_SESSION["teacher"]);
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }
?>