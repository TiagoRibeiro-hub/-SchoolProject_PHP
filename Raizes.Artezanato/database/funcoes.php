<?php
function closeDB($conn)
{
    return mysqli_close($conn);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//   REGISTER    //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

function emptyRegister($firstname, $secondname, $username, $email, $password, $adress, $postcode, $localidade)
{

    if (empty($firstname) || empty($secondname) || empty($username) || empty($email) || empty($password) || empty($adress) || empty($postcode) || empty($localidade)) {
        $endergebnis = true;
    } else {
        $endergebnis = false;
    }
    return $endergebnis;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//    Validate user     //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

function invalidUser($username)
{

    if (!preg_match('/^[a-zA-Z0-9]*$/', $username)) {   // ver se o user se encontra dentro dos parametos (preg_match)
        $endergebnis = true;
    } else {
        $endergebnis = false;
    }
    return $endergebnis;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//    Validate email    //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $endergebnis = true;
    } else {
        $endergebnis = false;
    }
    return $endergebnis;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//     Confirm Pass     //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

function passConfirm($password, $repeatpassword)
{

    if ($password !== $repeatpassword) {
        $endergebnis = true;
    } else {
        $endergebnis = false;
    }
    return $endergebnis;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//     Confirm User     //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

function userExist($conn, $username)
{

    $sql = "SELECT * FROM cliente WHERE user = ? ;";
    $stmt = mysqli_prepare($conn, $sql); ///  prepares statement

    if (!$stmt) {
        header('location:../register.php?error=stmtuserexist');
    }

    mysqli_stmt_bind_param($stmt, "s", $username);   // s > 1 strings (user)
    mysqli_stmt_execute($stmt);

    $endergebnisdata = mysqli_stmt_get_result($stmt);

    if ($data = mysqli_fetch_assoc($endergebnisdata)) {
        return $data;
    } else {
        $endergebnis = false;
        return $endergebnis;
    }
    mysqli_stmt_close($stmt);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//    Confirm E-mail    //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

function emailExist($conn, $email)
{

    $sql = "SELECT * FROM cliente WHERE email = ?;";
    $stmt = mysqli_prepare($conn, $sql); ///  prepares statement

    if (!$stmt) {
        header('location:../register.php?error=stmtemailexist');
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $endergebnisdata = mysqli_stmt_get_result($stmt);

    if ($data = mysqli_fetch_assoc($endergebnisdata)) {
        return $data;
    } else {
        $endergebnis = false;
        return $endergebnis;
    }
    mysqli_stmt_close($stmt);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//  Create User  // 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function createUser($conn, $firstname, $secondname, $username, $email, $password, $adress, $postcode, $localidade)
{

    $sql = "INSERT INTO cliente (primeiro_nome, apelido, user, email, pass, morada, codigo_postal, localidade) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql); ///  prepares statement

    if (!$stmt) {
        header('location:../register.php?error=stmtfailed');
    }

    $hashpass = password_hash($password, PASSWORD_DEFAULT); // hash pass


    mysqli_stmt_bind_param($stmt, "ssssssss", $firstname, $secondname, $username, $email, $hashpass, $adress, $postcode, $localidade);
    mysqli_stmt_execute($stmt) or exit(mysqli_stmt_error($stmt));
    mysqli_stmt_close($stmt);
    header("location:../home.php?error=none");
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//     LOGIN     //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function emptyLogin($username, $password)
{


    if (empty($username) || empty($password)) {
        $endergebnis = true;
    } else {
        $endergebnis = false;
    }
    return $endergebnis;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Confirmar Dados //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function loginUser($conn, $username, $password)
{
    $userExist = userExist($conn, $username);

    if ($userExist === false) {
        header("location: ../home.php?error=wronginfo");
        exit();
    }

    $hashpass = $userExist['pass'];    // associative array position (pass, db)
    $checkpass = password_verify($password, $hashpass); // confirmar se as passwords coincidem nao hash com hash

    if ($checkpass === false) {
        header("location: ../home.php?error=wrongpassword");
        exit();
    } else if ($checkpass === true) {
        session_start();
        $_SESSION["id"] = $userExist['id'];
        $_SESSION["user"] = $userExist; // array dentro de array..passa toda a informacao

        header("location: ../home.php?error=sucess");
        exit();
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//   Update Info  //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function updateInfo($conn, $username, $adress, $postcode, $localidade, $id)
{

    $sql = "UPDATE cliente SET user = ?, morada = ?, codigo_postal = ?, localidade = ? where id = ?";

    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_param($stmt, "ssssi", $username, $adress, $postcode, $localidade, $id) or exit('Error in stmt_bind_resul');
    $res = mysqli_stmt_execute($stmt) or exit(mysqli_stmt_error($stmt));

    mysqli_stmt_close($stmt);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//   Delete Account    //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function deleteAccount($conn, $id)
{

    $sql = "DELETE FROM cliente WHERE id = $id";
    mysqli_query($conn, $sql) or exit(mysqli_error($conn));

    session_unset();
    session_destroy();
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//   Buy / Shooping Car  //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////
//     Read    //
////////////////

function allProducts($conn)
{

    $sql = "SELECT produtos.id AS id, produtos.nome AS nome, tamanho AS tamanho, preco AS preco, iva AS iva, produtos.descricao AS descricao,
    categoria.nome AS categoria, subcategoria.nome AS subcategoria, categoria_pro.nome AS categoria_pro,   
    stock.quantidade AS quantidade 
        FROM categoria AS categoria INNER JOIN categoria AS subcategoria ON categoria.id = subcategoria.parent
            INNER JOIN categoria AS categoria_pro  ON subcategoria.id = categoria_pro.parent     
            INNER JOIN produtos ON categoria_pro.id = produtos.categoria_id
            INNER JOIN stock ON produtos.id = stock.produtos_id";


    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_result($stmt, $id, $nome, $tamanho, $preco, $iva, $descricao, $categoria, $subcategoria, $categoria_pro, $quantidade) or exit('Error in stmt_bind_resul');
    mysqli_stmt_execute($stmt) or exit('Error:' . mysqli_stmt_error($stmt));

    $produtos = [];
    while (mysqli_stmt_fetch($stmt)) {
        $produto = [
            'id' => $id,
            'nome' => $nome,
            'tamanho' => $tamanho,
            'preco' => $preco,
            'iva' => $iva,
            'descricao' => $descricao,
            'categoria' => $categoria,
            'subcategoria' => $subcategoria,
            'categoria_pro' => $categoria_pro,
            'quantidade' => $quantidade
        ];
        array_push($produtos, $produto);
    }
    mysqli_stmt_close($stmt);
    return $produtos;
}
function allCategory($conn)
{

    $sql = "SELECT categoria.id AS id, categoria.nome AS nome, categoria.descricao AS descricao FROM categoria";

    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_result($stmt, $id, $nome, $descricao) or exit('Error in stmt_bind_resul');
    mysqli_stmt_execute($stmt) or exit('Error:' . mysqli_stmt_error($stmt));

    $categorias = [];
    while (mysqli_stmt_fetch($stmt)) {
        $categoria = [
            'id' => $id,
            'nome' => $nome,
            'descricao' => $descricao
        ];
        array_push($categorias, $categoria);
    }
    mysqli_stmt_close($stmt);
    return $categorias;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//      Home      //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//refazer
function top3CW($conn)
{

    $sql = "SELECT produtos.nome AS nome 
            FROM produtos INNER JOIN categoria ON produtos.categoria_id = categoria.id
            WHERE categoria.id IN (SELECT categoria_pro.id AS id 
                                FROM categoria AS categoria INNER JOIN categoria AS subcategoria ON categoria.id = subcategoria.parent
                                    INNER JOIN categoria AS categoria_pro  ON subcategoria.id = categoria_pro.parent 
                                WHERE categoria.nome = 'Craft Work')  
            LIMIT 3";

    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_result($stmt, $nome) or exit('Error in stmt_bind_resul');
    mysqli_stmt_execute($stmt) or exit('Error:' . mysqli_stmt_error($stmt));

    $top3CW = [];
    while (mysqli_stmt_fetch($stmt)) {
        $top = [
            'nome' => $nome,
        ];
        array_push($top3CW, $top);
    }
    mysqli_stmt_close($stmt);
    return $top3CW;
}
//refazer
function top3HP($conn)
{

    $sql = "SELECT produtos.nome AS nome 
            FROM produtos INNER JOIN categoria ON produtos.categoria_id = categoria.id
            WHERE categoria.id IN (SELECT categoria_pro.id AS id 
                                FROM categoria AS categoria INNER JOIN categoria AS subcategoria ON categoria.id = subcategoria.parent
                                    INNER JOIN categoria AS categoria_pro  ON subcategoria.id = categoria_pro.parent 
                                WHERE categoria.nome = 'Herbal Products')  LIMIT 3";

    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_result($stmt, $nome) or exit('Error in stmt_bind_resul');
    mysqli_stmt_execute($stmt) or exit('Error:' . mysqli_stmt_error($stmt));

    $top3HP = [];
    while (mysqli_stmt_fetch($stmt)) {
        $top = [
            'nome' => $nome,
        ];
        array_push($top3HP, $top);
    }
    mysqli_stmt_close($stmt);
    return $top3HP;
}
