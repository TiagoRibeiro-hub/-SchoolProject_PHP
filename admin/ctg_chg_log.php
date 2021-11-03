<?php
include_once 'headerAdmin.php';
//  LOG IN 
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (emptyLogin($email, $password) !== false) {
        header('location: ctg_chg_log.php?error=emptyLogInput');
        exit();
    }

    loginUser($conn, $email, $password);
}
// DELETE
if (isset($_POST['delete'])) {
    deleteProd($conn, $_POST['id']);
    header('location:ctg_chg_log.php?error=sucess');
}
// UPDATE
if (isset($_POST['update'])) {
    updateProd($conn, $_POST['nome'], $_POST['tamanho'], $_POST['preco'], $_POST['iva'], $_POST['quantidade'], $_POST['descricao'], $_POST['id']);
    header('location:produtos.php?error=sucess');
}
//<!----------------------------------------------------------------------------------------------------->
//<!----------------------------------------------LOG IN------------------------------------------------->
//<!----------------------------------------------------------------------------------------------------->

if (isset($_GET['log'])) {
?>
    <form action="" method="post" class="container mx-auto" style="width: 50vw; margin-top: 25vh;">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
            <div id="emailHelp" class="form-text">Administrative e-mail</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <button type="submit" class="btn btn-outline-dark" name="login">Log In</button>
    </form>
    <?php
    //<!----------------------------------------------------------------------------------------------------->
    //<!-----------------------------------------SEARCH------------------------------------------------------>
    //<!----------------------------------------------------------------------------------------------------->
} else if (isset($_POST['searchbtn'])) {

    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT produtos.id AS id, produtos.nome AS nome, tamanho AS tamanho, preco AS preco, iva AS iva, 
                    categoria.nome AS categoria, subcategoria.nome AS subcategoria, categoria_pro.nome AS categoria_pro,   
                    stock.quantidade AS quantidade 
             FROM categoria AS categoria INNER JOIN categoria AS subcategoria ON categoria.id = subcategoria.parent
                    INNER JOIN categoria AS categoria_pro  ON subcategoria.id = categoria_pro.parent     
                    INNER JOIN produtos ON categoria_pro.id = produtos.categoria_id
                    INNER JOIN stock ON produtos.id = stock.produtos_id
            WHERE categoria.nome LIKE '%$search%' OR produtos.nome LIKE '%$search%' OR preco LIKE '%$search%'";

    $res = mysqli_query($conn, $sql) or exit('Error' . mysqli_error($conn));

    if (empty($_POST['search'])) {
    ?>
        <h3 style="color:red; display: flex; justify-content:center"><?php echo "Result not found" ?></h3>
    <?php
    } else if (mysqli_num_rows($res) > 0) {
    ?> <section class="container info-container">
            <div class="row row-cols-1 row-cols-md-3 g-4"> <?php
                                                            while ($row = mysqli_fetch_assoc($res)) {
                                                            ?>
                    <div class="col-sm-6">
                        <div class="card">
                            <img src="Imagens/WhatsApp Image 2020-03-24 at 21.09.49.jpeg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <form action="" method="post">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Nome</th>
                                            <td><input class="boxtext" type="text" name="nome" value="<?php echo $row['nome'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>Tamanho</th>
                                            <td><input class="boxtext" type="text" name="tamanho" value="<?php echo $row['tamanho'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>Preço</th>
                                            <td><input class="boxtext" type="text" name="preco" value="<?php echo $row['preco'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>IVA</th>
                                            <td><input class="boxtext" type="text" name="iva" value="<?php echo $row['iva'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>Preço Final</th>
                                            <td><?php echo precofinal($row['preco'], $row['iva']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Produto-Categoria</th>
                                            <td><?php echo $row['categoria_pro'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Sub-categoria</th>
                                            <td><?php echo $row['subcategoria'] ?></td>
                                        </tr>
                                        <tr>
                                        </tr>
                                        <tr>
                                            <th>Categoria</th>
                                            <td><?php echo $row['categoria'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Stock</th>
                                            <td><input class="boxtext" type="text" name="quantidade" value="<?php echo $row['quantidade'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>Vendidos</th>
                                            <td>falta funcao</td>
                                        </tr>
                                    </table>
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <button type="submit" class="btn btn-outline-dark" name="delete">Delete</button>
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <button type="submit" class="btn btn-outline-dark" name="update">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                                                            } ?>
            </div>
        </section> <?php
                } else {
                    ?>
        <h3 style="color:red; display: flex; justify-content:center"><?php echo "Result not found" ?></h3>
    <?php
                }
            } else if (isset($_GET['CW'])) {
                //<!----------------------------------------------------------------------------------------------------->
                //<!-----------------------------------------CRAFT WORK-------------------------------------------------->
                //<!----------------------------------------------------------------------------------------------------->
    ?>
    <section class="container">
        <div class="row">
            <div class="col d-inline-flex d-flex justify-content-center">
                <a class="textosub" href="produtos.php?WW">WOODEN WONDERS</a>
            </div>
            <div class="col d-inline-flex d-flex justify-content-center">
                <a class="textosub" href="produtos.php?MW">MAGICK WONDERS</a>
            </div>
            <div class="col d-inline-flex d-flex justify-content-center">
                <a class="textosub" href="produtos.php?TW">TINY WONDERS</a>
            </div>
        </div>
    </section>
<?php } else if (isset($_GET['HP'])) {
                //<!----------------------------------------------------------------------------------------------------->
                //<!-----------------------------------------HERBAL PRODUCTS--------------------------------------------->
                //<!----------------------------------------------------------------------------------------------------->
?> <section class="container">
        <div class="row align-items-center">
            <div class="col d-inline-flex d-flex justify-content-center">
                <a class="textosub" href="produtos.php?NW">NATURAL WONDERS</a>
            </div>
            <div class="col d-inline-flex d-flex justify-content-center">
                <a class="textosub" href="produtos.php?HI">HERBAL INCENSES</a>
            </div>
            <div class="col d-inline-flex d-flex justify-content-center">
                <a class="textosub" href="produtos.php?C">CANDLES</a>
            </div>
        </div>
    </section>
<?php } else {
                //<!----------------------------------------------------------------------------------------------------->
                //<!-------------------------------CRAFT WORK / HERBAL PRODUCTS------------------------------------------>
                //<!----------------------------------------------------------------------------------------------------->
?><section class="container">
        <div class="row align-items-center">
            <div class="col d-inline-flex d-flex justify-content-center">
                <a class="texto" href="ctg_chg_log.php?CW" name="CW">CRAF TWORK</a>
            </div>
            <div class="col d-inline-flex d-flex justify-content-center">
                <a class="texto" href="ctg_chg_log.php?HP" name="HP">HERBAL PRODUCT</a>
            </div>
        </div>
    </section>
<?php } ?>

<?php
require_once 'footerAdmin.php';
?>