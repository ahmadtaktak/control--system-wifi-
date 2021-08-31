<?php 
    require_once "../classes/database.php";
    session_start();
    $user = $obj->read("user","*","WHERE id =".$_SESSION["teacher"]);

    if(!isset($_SESSION["teacher"])){
        header("Location: login.php");
    }

    if($_POST){
        $id = $_POST["id"];
        $course = $_POST["course"];
        
        $obj->insert("student_to_course", array("fk_student_id","fk_course_id"), array($id,$course));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>


    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">System Control</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./students-dashboard.php">Students dashboard</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./teachers-dashboard.php">teachers dashboard</a>
                </li>
            </ul>
                <a class="btn" href="#">Hello <?= $user["first_name"] ?></a>

                <a class="btn btn-outline-success" href="logout.php?logout">Logout</a>
            </div>
        </div>
    </nav>


    <div class="alert alert-success text-center" role="alert">
        <h3>Enrolled Successfuly</h3>
        <a class="btn btn-danger" href="../students-dashboard.php">Back to Home page</a>
    </div>

</body>
</html>