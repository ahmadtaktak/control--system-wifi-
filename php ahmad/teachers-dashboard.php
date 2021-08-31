<?php
    require_once "classes/database.php";
    session_start();

    if(!isset($_SESSION["teacher"])){
        header("Location: login.php");
    }
    $user = $obj->read("user","*","WHERE id =".$_SESSION["teacher"]);
    $students = $obj->read("student");

    $courses = $obj->read("courses","*","INNER JOIN user ON courses.teacher = user.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="./css/style.css">
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
    <div class="container">
        
        
        <h1 class="text-center">Courses list</h1>
        <a class="btn btn-success btn-lg fullBtn" href="create_course.php">Create Course</a><br>
        <div class="row">
        
            <?php
            $i = -2;
                foreach($courses as $course) {
                    echo '<div class="col-4 mt-5 animate__animated animate__flipInX animate__delay-'.$i.'s">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">'. $course['name'] .'</h5>
                                <h6 class="card-subtitle mb-2 text-muted">'. $course['course_year'] .'</h6>
                                <p class="card-text">'. $course['first_name'] . ' '.$course["last_name"].'</p>
                            </div>
                        </div>
                    </div>';
                    $i++;
                }
            ?>
            
        </div>
    </div>
    
</body>
</html>