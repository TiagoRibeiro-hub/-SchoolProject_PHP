<?php

require_once '../../connect.php';
require_once 'funcoes.php';

// se nao submeter da maneira correta volta para a pagina de registo
if(isset($_POST['submit'])){

    $firstname = $_POST['firstname'];
    $secondname = $_POST['secondname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; $repeatpassword = $_POST['repeatpassword'];
    $adress = $_POST['adress'];
    $postcode = $_POST['postcode'];
    $localidade = $_POST['localidade'];

    if(emptyRegister($firstname, $secondname, $username, $email, $password, $adress, $postcode, $localidade) !== false){
        header('location:../register.php?error=emptyInput');
        exit();
    }
    if(invalidUser($username) !== false){
        header('location:../register.php?error=invalidUsername');
        exit();
    }
    if(invalidEmail($email) !== false){
        header('location:../register.php?error=invalidEmail');
        exit();
    }
    if(passConfirm($password, $repeatpassword) !== false){
        header('location:../register.php?error=wrongPass');
        exit();
    }
    if(userExist($conn, $username, $email) !== false){
        header('location:../register.php?error=useridExist');
        exit();
    }
    if(emailExist($conn, $email) !== false){
        header('location:../register.php?error=emailExist');
        exit();
    }
    createUser($conn, $firstname, $secondname, $username, $email, $password, $adress, $postcode, $localidade);
}
else if(isset($_POST['submitLogin'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once '../../connect.php';
    require_once 'funcoes.php';

    if(emptyLogin($username, $password) !== false){
        header('location:../home.php?error=emptyLogInput');
        exit();
    }

    loginUser($conn, $username, $password);
}
else if(isset($_POST['change'])){

    session_start();

    $username = $_POST['user'];
    $adress = $_POST['adress'];
    $postcode = $_POST['postcode'];
    $localidade = $_POST['localidade'];

    if(isset($_POST['user'])){
        updateInfo($conn, $username, $adress, $postcode, $localidade, $_SESSION['id']);
        header('location:../home.php?error=sucess');
    }
 
    $_SESSION['user'] = userExist($conn, $username);
    
}else if(isset($_POST['delete'])){

    session_start();

    deleteAccount($conn, $_SESSION['id']);
    header('location:../home.php?error=sucess');       
}
else{
    header("location: ../home.php");
    exit();
}
