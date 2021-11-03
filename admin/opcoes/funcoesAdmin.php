<?php
function closeDB($conn)
{
    return mysqli_close($conn);
}
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
///////////////////
//     LOGIN     //
///////////////////
///////////////////
//  Empty Login   //
///////////////////
function emptyLogin($email, $password)
{

    if (empty($email) || empty($password)) {
        $endergebnis = true;
    } else {
        $endergebnis = false;
    }
    return $endergebnis;
}
/////////////////////
// Confirmar Dados //
/////////////////////
function loginUser($conn, $email, $password)
{
    $emailExist = emailExist($conn, $email);

    if ($emailExist === false) {
        header("location: ctg_chg_log.php?error=wronginfo");
        exit();
    }

    $hashpass = $emailExist['pass'];    // associative array position (pass, db)
    $checkpass = password_verify($password, $hashpass); // confirmar se as passwords coincidem nao hash com hash

    if ($checkpass === false) {
        header("location: ctg_chg_log.php?error=wrongpassword");
        exit();
    } else if ($checkpass === true) {
        session_start();
        $_SESSION["id"] = $emailExist['id'];
        $_SESSION["email"] = $emailExist['email'];
        header("location: ctg_chg_log.php?error=sucess");
        exit();
    }
}
///////////////////
//    Produtos   //
///////////////////
//////////////////
//     Read    //
////////////////
function allProducts($conn, $order = null)
{

    $sql = "SELECT produtos.id AS id, produtos.nome AS nome, produtos.tamanho AS tamanho, produtos.preco AS preco, produtos.iva AS iva, produtos.descricao AS descricao, 
                categoria.nome AS categoria, subcategoria.nome AS subcategoria, categoria_pro.nome AS categoria_pro,   
                stock.quantidade AS quantidade 
            FROM categoria AS categoria INNER JOIN categoria AS subcategoria ON categoria.id = subcategoria.parent
                INNER JOIN categoria AS categoria_pro  ON subcategoria.id = categoria_pro.parent  
                INNER JOIN produtos ON categoria_pro.id = produtos.categoria_id
                INNER JOIN stock ON produtos.id = stock.produtos_id";

    if ($order) {
        $sql .= " ORDER BY {$order['orderBy']} {$order['orderDir']}";
    }

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

    $sql = "SELECT categoria.id AS id, categoria.nome AS nome categoria.descricao AS descricao FROM categoria";

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
function allProdCategory($conn)
{

    $sql = "SELECT cat_pro.id AS id, cat_pro.nome AS nome,  cat_pro.descricao AS descricao 
            FROM categoria AS cat_pai INNER JOIN categoria AS cat_sub ON cat_pai.id = cat_sub.parent
            INNER JOIN categoria AS cat_pro ON cat_sub.id = cat_pro.parent";

    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_result($stmt, $id, $nome, $descricao) or exit('Error in stmt_bind_resul');
    mysqli_stmt_execute($stmt) or exit('Error:' . mysqli_stmt_error($stmt));

    $catPro = [];
    while (mysqli_stmt_fetch($stmt)) {
        $categoria = [
            'id' => $id,
            'nome' => $nome,
            'descricao' => $descricao
        ];
        array_push($catPro, $categoria);
    }
    mysqli_stmt_close($stmt);
    return $catPro;
}
/////////////////////
//  Preco Final   //
///////////////////
function precofinal($preco, $iva)
{

    return $res = $preco * (1 + $iva / 100);
}
/////////////////
//  Vendas    //
///////////////
function vendas()
{
}
////////////////////
//    Create      //
////////////////////
function createProd($conn, $produto)
{

    $sql = "INSERT INTO produtos(nome, tamanho, preco, iva, descricao, categoria_id) VALUES(?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_param($stmt, "ssiisi", $produto['nome'], $produto['tamanho'], $produto['preco'], $produto['iva'], $produto['descricao'], $produto['categoria_id']) or exit('Error in stmt_bind_param');
    mysqli_stmt_execute($stmt) or exit(mysqli_stmt_error($stmt));

    $insert_id = mysqli_insert_id($conn);

    mysqli_stmt_close($stmt);

    return $insert_id;
}
function createStock($conn, $stock)
{

    $sql = "INSERT INTO stock(quantidade, produtos_id) VALUES(?, ?)";

    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_param($stmt, "ii", $stock['quantidade'], $stock['produtos_id']) or exit('Error in stmt_bind_param');
    mysqli_stmt_execute($stmt) or exit(mysqli_stmt_error($stmt));

    mysqli_stmt_close($stmt);

    header("location:produtos.php?error=none");
}
////////////////////
//    Delete      //
////////////////////
function deleteProd($conn, $id)
{

    $sql = "DELETE FROM produtos WHERE id = $id";
    mysqli_query($conn, $sql) or exit(mysqli_error($conn));

    $sqls = "DELETE FROM stock WHERE produtos_id = $id";
    mysqli_query($conn, $sqls) or exit(mysqli_error($conn));
}
////////////////////
//    Update      //
////////////////////
function updateProd($conn, $nome, $tamanho, $preco, $iva, $quantidade, $descricao, $id)
{

    $sql = "UPDATE produtos SET nome = ?, tamanho = ?, preco = ?, iva = ?, descricao = ? WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_param($stmt, 'ssiisi', $nome, $tamanho, $preco, $iva, $descricao, $id) or exit('Error in stmt_bind_param');
    mysqli_stmt_execute($stmt) or exit('Error:' . mysqli_stmt_error($stmt));

    $res = mysqli_stmt_execute($stmt) or exit(mysqli_stmt_error($stmt));

    mysqli_stmt_close($stmt);

    $sql = "UPDATE stock SET quantidade = ? WHERE produtos_id = ?";

    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_param($stmt, 'ii', $quantidade, $id) or exit('Error in stmt_bind_param');
    mysqli_stmt_execute($stmt) or exit('Error:' . mysqli_stmt_error($stmt));

    mysqli_stmt_execute($stmt) or exit(mysqli_stmt_error($stmt));

    mysqli_stmt_close($stmt);
}
////////////////////
//     Imagens    //
////////////////////
function next_image_id($conn)
{

    $sql = "SHOW table status where name='imagens';";
    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_result($stmt, $imagens) or exit('Error in stmt_bind_resul');
    mysqli_stmt_execute($stmt) or exit('Error:' . mysqli_stmt_error($stmt));

    $res = mysqli_fetch_assoc($stmt);
    $next_id = $res['Auto_increment'] + 1;
    mysqli_stmt_close($stmt);
    return $next_id;
}
function insertImage($conn,  $file_image, $produto_id)
{
    // array $file standard
    $fileName = $file_image["name"];
    $fileType = $file_image["type"];
    $fileTempName = $file_image["tmp_name"];
    $fileError = $file_image["error"];
    $fileSize = $file_image["size"];

    $fileExt = explode(".", $fileName); // buscar a extensao ex: .jpeg
    $fileActualExt = strtolower(end($fileExt)); // fica so jpeg

    $allowed = array("jpg", "jpeg", "cr2");

    if ($fileError === 1) {
        header("location:produtos.php?error=wrong");
        exit();
    }
    if (!in_array($fileActualExt, $allowed)) {
        header("location:produtos.php?error=properfile");
        exit();
    }
    if ($fileSize > 15000) {
        header("location:produtos.php?error=filesize");
        exit();
    }

    $sql = "INSERT INTO imagens(produtos_id) VALUES(?);";
    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_param($stmt, "i", $produto_id) or exit('Error in stmt_bind_param');
    mysqli_stmt_execute($stmt) or exit(mysqli_stmt_error($stmt));

    $insert_id = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);

    $imageName = $insert_id . "." . uniqid("",true). "." . $fileActualExt;
    $fileDestination = "Imagens/imgDown/" . $imageName;

    $sql = "UPDATE imagens SET imagem_nome=? WHERE imagem_id = $insert_id";
    $stmt = mysqli_prepare($conn, $sql) or exit('Error' . mysqli_error($conn));

    mysqli_stmt_bind_param($stmt, "s", $imageName) or exit('Error in stmt_bind_param');
    mysqli_stmt_execute($stmt) or exit(mysqli_stmt_error($stmt));

    mysqli_stmt_close($stmt);

    move_uploaded_file($fileTempName, $fileDestination);
}
