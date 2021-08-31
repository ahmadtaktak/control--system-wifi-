<?php 
    require_once "classes/database.php";
    session_start();

    if(isset($_SESSION["teacher"])){
        header("Location: index.php");
    }
    $result = array("","");
    $fName = "";
    $lName = "";
    $email = "";
    $password = "";
    $fNameError = "";
    $lNameError = "";
    $passwordError = "";
    $emailError = "";
    if(isset($_POST["submit"])){
        $error = false;
        $fName = $_POST["first_name"];
        $lName = $_POST["last_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        if(empty($fName)){
            $error = true;
            $fNameError = "Please type your first name";
        }

        if(empty($lName)){
            $error = true;
            $lNameError = "Please type your last name";
        }

        if(empty($password)){
            $error = true;
            $passwordError = "Please type your password";
        }

        if(empty($email)){
            $error = true;
            $emailError = "Please type your email";
        }else{
            $result = $obj->read("user","*",""," WHERE email = '".$email."' ");
            if($result != "No result"){
                $result = array("","");
                $error = true;
                $emailError= "This email is already exist ..";
            }
        }

        if(!$error){
            $result = $obj->register($fName, $lName, $email, $password);
        }
        
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
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

</head>
<body id="body">
    <div class="container">
        <h1 class="text-white mt-5 text-center animate__fadeIn animate__animated">Register a teacher</h1>
        <div class="alert alert-<?= $result[0] ?>">
            <p><?= $result[1] ?></p>
        </div>
        <form method="POST">
            <div class="form-group mt-3 animate__fadeInDown animate__animated">
                <input placeholder="First name" class="form-control" type="text" name="first_name" value="<?= $fName ?>">
                <div class="text-danger"><?= $fNameError ?></div>
            </div>
            <div class="form-group mt-3 animate__fadeInLeft animate__animated">
                <input placeholder="Last name" class="form-control" type="text" name="last_name" value="<?= $lName ?>">
                <div class="text-danger"><?= $lNameError ?></div>
            </div>
            <div class="form-group mt-3 animate__fadeInRight animate__animated">
                <input placeholder="Email" class="form-control" type="email" name="email" value="<?= $email ?>">
                <div class="text-danger"><?= $emailError ?></div>
            </div>
            <div class="form-group mt-3 animate__fadeInUp animate__animated">
                <input placeholder="Password" class="form-control" type="password" name="password">
                <div class="text-danger"><?= $passwordError ?></div>
            </div>
            <input class="btn btn-primary fullBtn mt-3 animate__fadeInBottomLeft animate__animated" name="submit" type="submit" value="Register now">
        </form>
        <a class="btn btn-success fullBtn mt-3 animate__animated animate__fadeInBottomRight" href="login.php">Login</a>
    </div>
</body>
</html>