<?php
    require_once "classes/database.php";
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $student = $obj->read("student","*","", " WHERE student.id = ".$id);
        $courses = $obj->read("courses","*","INNER JOIN student_to_course ON courses.id = student_to_course.fk_course_id INNER JOIN student ON student.id = student_to_course.fk_student_id", " WHERE student.id = ".$id);
        // var_dump(count($courses));
    }
    session_start();

    $user = $obj->read("user","*","WHERE id =".$_SESSION["teacher"]);

    if(!isset($_SESSION["teacher"])){
        header("Location: login.php");
    }
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
    <div class="container"><center>
        <h1>Student Info</h1>
        <?php
            echo '<div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">'. $student['first_name'] .' '. $student['last_name'] .'</h5>
              <p class="card-text">Address: '. $student['address'] . '</p>
              <a class="btn btn-warning" href="update_student.php?id='.$student["id"].'">Update</a><br>
                <a class="btn btn-primary" href="enroll_students_to_course.php?id='.$student["id"].'">Enroll student</a><br>
                <a class="btn btn-danger" href="delete_student.php?id='.$student["id"].'">Delete</a>
            </div>
          </div>';
        ?>
        </center>
        <h1 class="text-center">Courses that this student enrolled to</h1>
        <?php
            if($courses == "No result"){
                echo $courses;
            }elseif(count($courses) == 9){
                echo "<div>
                    <p>Course name: ". $courses['name'] . " </p>
                    <p>Course year: ". $courses['course_year'] . " </p>
                    <hr>
                </div>";
            }else {
                foreach($courses as $course) {
                    echo "<div>
                        <p>Course name: ". $course['name'] . " </p>
                        <p>Course year: ". $course['course_year'] . " </p>
                        <hr>
                    </div>";
                }
            }
        ?>
        </div>
    </div>
</body>
</html>