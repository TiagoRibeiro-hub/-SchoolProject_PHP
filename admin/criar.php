<?php
include_once 'headerAdmin.php';

$produtos = allProducts($conn);
$categorias = allProdCategory($conn);

?>
<section class="container">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">Produto-Categoria</th>
                <th scope="col">Sub-Categoria</th>
                <th scope="col">Categoria</th>
                <th scope="col">Nome</th>
                <th scope="col">Tamanho</th>
                <th scope="col">Preço</th>
                <th scope="col">IVA</th>
                <th scope="col">Stock</th>
                <th></th>
            </tr>
        </thead>
        <?php
        if (empty($_POST)) {
        ?>
            <form action="" method="post" enctype="multipart/form-data">
                <tbody>
                    <tr>
                        <td><select id="categoria_id" name="categoria_id">
                                <?php foreach ($categorias as $categoria) {
                                    echo  "<option value=\"{$categoria['id']}\">{$categoria['nome']}</option>";
                                } ?>
                            </select>
                        </td>
                        <td>sub</td>
                        <td>cat</td>
                        <td><input class="boxtext" type="text" name="nome" id="nome"></td>
                        <td><input class="boxtext" type="text" name="tamanho" id="tamanho"></td>
                        <td><input class="boxtext" type="text" name="preco" id="preco"></td>
                        <td><input class="boxtext" type="text" name="iva" id="iva"></td>
                        <td><input class="boxtext" type="text" name="quantidade" id="quantidade"></td>
                    </tr>
                    <tr>
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th class="d-flex justify-content-center" scope="col">Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <textarea name="descricao" id="descricao" cols="177" rows="5"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </tr>
                    <tr>
                        <table class="table">
                            <thead>
                                <tr>
                                    <!--<th class="d-flex justify-content-center" scope="col">
                                        <div>
                                            <img src="" class="card-img-top" alt="...">
                                        </div>
                                    </th>-->
                                </tr>
                                <tr>
                                    <th class="d-flex justify-content-center">
                                        <input type="file" name="imagem" id="imagem" hidden="hidden">
                                        <button type="button" id="custom_btn" class="btn btn-outline-dark">Choose A Image</button>
                                        <span id="text_btn" style="margin-left: 10px; padding-top: 6px">No Image chosen, yet!</span>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </tr>
                    <tr>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="d-flex justify-content-center" scope="col">
                                        <button style="padding-left:30px; padding-right:30px" type="submit" class="btn btn-outline-dark" name="create">Create</button>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </tr>
                </tbody>
            </form>
        <?php
        } else {
            $produto_id = createProd($conn, [
                'nome' => $_POST['nome'],
                'tamanho' => $_POST['tamanho'],
                'preco' => $_POST['preco'],
                'iva' => $_POST['iva'],
                'descricao' => $_POST['descricao'],
                'categoria_id' => $_POST['categoria_id']
            ]);
            createStock($conn, [
                'quantidade' => $_POST['quantidade'],
                'produtos_id' => $produto_id
            ]);
            insertImage($conn, $_FILES['imagem'], $produto_id);
        }
        ?>
    </table>
</section>

<script>
clickChooseImage('imagem', 'custom_btn', 'text_btn');
</script>

<?php
include_once 'footerAdmin.php';
?>