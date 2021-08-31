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
    <script src="https://kit.fontawesome.com/ade639ac96.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
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
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" id="student" name="student" type="text" value="" placeholder="Search ...">
                </form>

                <a class="btn btn-outline-success" href="logout.php?logout">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container">


        <h1 class="text-center">Students List</h1>
        <a class="btn btn-success fullBtn" href="create_student.php">Create Student</a><br><hr>
        <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Details</th>
                  <th scope="col">Update</th>
                  <th scope="col">Enroll</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody id="result">
        <?php
            foreach($students as $student) {
              echo '
                <tr>
                  <th scope="row">'.$student["id"].'</th>
                  <td>'. $student['first_name'] .'</td>
                  <td><a class="btn btn-secondary" href="details.php?id='.$student["id"].'"><i class="fas fa-info"></i></a></td>
                  <td><a class="btn btn-warning" href="update_student.php?id='.$student["id"].'"><i class="fas fa-edit"></i></a></td>
                  <td><a class="btn btn-primary" href="enroll_students_to_course.php?id='.$student["id"].'"><i class="fas fa-user-plus"></i></a></td>
                  <td><a class="btn btn-danger" href="delete_student.php?id='.$student["id"].'"><i class="far fa-trash-alt"></i></a></td>
                </tr>
              ';
            }
        ?>
        </tbody>
    </table>
    </div>

    <script>
        document.getElementById("student").addEventListener("keyup", getStudents, false); //create an eventlistener to call getUsers() function when button clicked

        function getStudents() {
        
        let search = document.getElementById("student").value;
        let param = `student=${search}`;
        const request = new XMLHttpRequest(); //create new request
        request.open( "POST", "actions/search.php", true); //set request as a GET method connecting to users.php
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