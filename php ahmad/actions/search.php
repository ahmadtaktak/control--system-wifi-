<?php 
    require_once "../classes/database.php";
    $search = $_POST["student"];
    $students = $obj->search("student",array("last_name"=>$search."%", "first_name"=>$search."%"));
?>