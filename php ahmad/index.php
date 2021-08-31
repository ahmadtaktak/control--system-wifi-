<?php
    require_once "classes/database.php";
    session_start();

    if(!isset($_SESSION["teacher"])){
        header("Location: login.php");
    }
    $user = $obj->read("user","*","WHERE id =".$_SESSION["teacher"]);

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
    <title>Document</title>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
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
    <hr>
    <form method="post">
        <select class="form-select" id="select" aria-label="Default select example">
            <option selected value="">Open this select menu</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
        </select>
    </form>
    <hr>
        <div class="row" id="result">
            <?php
                $i = -2;
                foreach($courses as $course) {
                    echo '
                    <div class="col-4 mt-3 animate__animated animate__fadeInDown animate__delay-'.$i.'s">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">'. $course['name'] . '</h5>
                                <p class="card-text">This course will be happening on '. $course['course_year'] .' and the teacher who be responsible of this course will be '. $course['first_name'] .' '.$course["last_name"].'</p>
                            </div>
                        </div>
                    </div>';
                    $i= $i + 1;
                }
            ?>
        </div>
    </div>

    <script>
        document.getElementById("select").addEventListener("click", getCoutses, false); //create an eventlistener to call getUsers() function when button clicked

        function getCoutses() {
        
        let select = this.value;
        let param = `select=${select}`;
        const request = new XMLHttpRequest(); //create new request
        request.open( "POST", "actions/showcourses.php", true); //set request as a GET method connecting to users.php
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //setting header for POST method
        request.onload = function () {
                if (this.status == 200) {

                    document.getElementById("result").innerHTML = this.responseText;
            }
        }
        request.send(param); //send request
        }
</script>
              
</body>
</html>