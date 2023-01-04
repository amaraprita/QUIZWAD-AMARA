<?php
include 'connect.php';

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = "user";

    $regis = "INSERT INTO users(email,username,password,role) VALUES ('$email','$username','$password','$role')";
    $insert = mysqli_query($conn, $regis);
    header('location: home.php');
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' OR username='$email'");
    $user = mysqli_fetch_assoc($login);

    if (mysqli_num_rows($login) == 1) {
        if ($user['password'] == $password){
            if ($user['role'] == 'user') {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['logged'] = true;
    
                header('location: home.php');
                if (isset($_POST['remember'])) {
                    setcookie("email", $email, time() + 3600);
                    setcookie("pass", $password, time() + 3600);
    
                    header('Location: home.php');
                }
            }elseif ($user['role'] == 'admin') {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['logged'] = true;
                if (isset($_POST['remember'])) {
                    setcookie("email", $email, time() + 3600);
                    setcookie("pass", $password, time() + 3600);
    
                    header('Location: admin.php');
                }
    
                header('location: admin.php');
            }
        } 
    }
}

if (isset($_GET['logout'])) {
    session_start();
    session_destroy();
    setcookie("email",'', time() - 3600);
    setcookie("pass",'', time() - 3600);

    header('location: home.php');
    exit();
}

if (isset($_POST['update'])) {
    session_start();
    $id = $_SESSION['id'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
    $checking = mysqli_fetch_assoc($query);

    if ($password == $checking['password']) {
        $update = mysqli_query($conn, "UPDATE users SET username='$username',email='$email' WHERE id='$id'");

        header('location: home.php');
    }
}
