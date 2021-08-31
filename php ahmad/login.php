<?php 
    require_once "classes/database.php";
    session_start();

    if(isset($_SESSION["teacher"])){
        header("Location: index.php");
    }
    $result = array("","");
    $email = "";
    $passwordError = "";
    $emailError = "";
    if(isset($_POST["submit"])){
        $error = false;
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(empty($password)){
            $error = true;
            $passwordError = "Please type your password";
        }

        if(empty($email)){
            $error = true;
            $emailError = "Please type your email";
        }

        if(!$error){
            $result = $obj->login($email, $password);
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
    <link rel="stylesheet" href="css/style.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <title>Document</title>
</head>
<body id="body">
    <div class="container mt-5">
        <h1 class="text-center animate__animated animate__wobble">Login Page</h1>
        <div class="alert alert-<?= $result[0] ?>">
            <p><?= $result[1] ?></p>
        </div>
        <form method="POST">
            <div class="form-group mt-3 animate__animated animate__delay-1s animate__backInLeft">
                <input placeholder="Email" class="form-control" type="email" name="email" value="<?= $email ?>">
                <div class="text-danger"><?= $emailError ?></div>
            </div>
            <div class="form-group mt-3 animate__animated animate__delay-2s animate__backInLeft">
                <input placeholder="Password" class="form-control" type="password" name="password">
                <div class="text-danger"><?= $passwordError ?></div>
            </div>
            <input class="btn btn-primary btn-lg fullBtn animate__backInUp animate__animated animate__delay-3s mt-3 " name="submit" type="submit" value="Login">
        </form>
        <a class="btn btn-success btn-lg fullBtn animate__backInUp animate__animated animate__delay-4s mt-3" href="register.php">Register Here ...</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>