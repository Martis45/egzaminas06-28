<?php 
session_start();
if(isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = $email";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: nenaudojamas.php");
                    die();
                } else{
                    echo "<div class='alert alert-danger'>Slaptazodziai nesutampa</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Vartotojas nerastas duomenu bazeje!</div>";
            }
        }
        ?>
        <form action="nenaudojamas.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Iveskite el.pasta:" name="email" class="form-control">
    </div>
    <div class="form-group">
                <input type="password" placeholder="Iveskite slaptazodi:" name="password" class="form-control">
    </div>
    <div class="form-btn">
        <input type="submit" value="Login" name="login" class="btn btn-primary">
    </div>
    </form>
    <div><p>Neuzsiregistraves - <a href="registation.php">Uzsiregistruok cia</a></p></div>
    </div>
</body>
</html>