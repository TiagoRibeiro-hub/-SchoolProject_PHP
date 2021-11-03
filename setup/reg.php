<?php

if (isset($_POST['register'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatpassword = $_POST['repeatpassword'];

    require_once 'connect.php';
    require_once 'func.php';

    if (invalidEmail($email) !== false) {
        header('location:../register.php?error=invalidEmail');
        exit();
    }
    if (passConfirm($password, $repeatpassword) !== false) {
        header('location:../register.php?error=wrongPass');
        exit();
    }
    if (emailExist($conn, $email) !== false) {
        header('location:../register?error=adminExist');
        exit();
    }
    createAdmin($conn, $email, $password);
} else {
    header('location:../register.php?error=failed');
    exit(); // parar por completo
}
