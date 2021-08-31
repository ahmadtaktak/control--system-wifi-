<?php
    require_once "./classes/database.php";
    session_start();

    if(!isset($_SESSION["teacher"])){
        header("Location: login.php");
    }
    $user = $obj->read("user","*","WHERE id =".$_SESSION["teacher"]);

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
    <div class="container text-center">
        <form action="actions/a_delete_student.php" method="POST">
            <h1>Are you sure you want to delete this student?</h1>
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
            <input class="btn btn-danger" type="submit" value="Yes">
            <a class="btn btn-success" href="index.php">No</a>
        </form>
    </div>
</body>
</html>