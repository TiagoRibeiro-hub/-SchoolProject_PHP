<?php
/////////////////// 
//   REGISTER    //
///////////////////
///////////////////////////
//    Validate email    //
/////////////////////////
function invalidEmail($email)
{

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $endergebnis = true;
    } else {
        $endergebnis = false;
    }
    return $endergebnis;
}
//////////////////////////
//     Confirm Pass     //
/////////////////////////
function passConfirm($password, $repeatpassword)
{

    if ($password !== $repeatpassword) {
        $endergebnis = true;
    } else {
        $endergebnis = false;
    }
    return $endergebnis;
}
//////////////////////////
//    Confirm E-mail    //
/////////////////////////
function emailExist($conn, $email)
{

    $sql = "SELECT * FROM admin WHERE email = ?;";
    $stmt = mysqli_prepare($conn, $sql); ///  prepares statement

    if (!$stmt) {
        header('location: ../register.php?error=stmtemailexist');
    }
    // passagem de dados

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resdata = mysqli_stmt_get_result($stmt);

    if ($data = mysqli_fetch_assoc($resdata)) {
        return $data;
    } else {
        $endergebnis = false;
        return $endergebnis;
    }
    mysqli_stmt_close($stmt);
}
//////////////////// 
//  Create Admin  // 
///////////////////
function createAdmin($conn, $email, $password)
{

    $sql = "INSERT INTO admin (email, pass) VALUES(?, ?)";
    $stmt = mysqli_prepare($conn, $sql); ///  prepares statement

    if (!$stmt) {
        header('location:../register.php?error=stmtfailed');
    }
    // hash pass

    $hashpass = password_hash($password, PASSWORD_DEFAULT);
    // passagem de dados

    mysqli_stmt_bind_param($stmt, "ss", $email, $hashpass);
    mysqli_stmt_execute($stmt) or exit(mysqli_stmt_error($stmt));



    mysqli_stmt_close($stmt);
    header("location:../produtos.php?error=none");
}
