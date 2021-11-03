<?php
include_once 'headerAdmin.php';
if (isset($_GET['orderBy']))
    $lista = allProducts($conn, [
        'orderBy' => $_GET['orderBy'],
        'orderDir' => $_GET['orderDir']
    ]);
else
    $lista = allProducts($conn);

if (isset($_POST['delete'])) {
    deleteProd($conn, $_POST['id']);
    header('location:produtos.php?error=sucess');
}
if (isset($_POST['update'])) {
    updateProd($conn, $_POST['nome'], $_POST['tamanho'], $_POST['preco'], $_POST['iva'], $_POST['quantidade'], $_POST['descricao'], $_POST['id']);
    header('location:produtos.php?error=sucess');
}
?>

<section class="container">
    <div class="container mt-5">
        <h1 class="texto">Produtos</h1>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">ID</th>
                    <th scope="col">Nome
                        <a href="produtos.php?orderBy=nome&orderDir=DESC"><img src="Imagens/down-arrow.png"></a>
                        <a href="produtos.php?orderBy=nome&orderDir=ASC"><img src="Imagens/up-arrow.png"></a>
                    </th>
                    </th>
                    <th scope="col">Tamanho</th>
                    <th scope="col">Preço
                        <a href="produtos.php?orderBy=preco&orderDir=DESC"><img src="Imagens/down-arrow.png"></a>
                        <a href="produtos.php?orderBy=preco&orderDir=ASC"><img src="Imagens/up-arrow.png"></a>
                    </th>
                    </th>
                    <th scope="col">IVA
                        <a href="produtos.php?orderBy=iva&orderDir=DESC"><img src="Imagens/down-arrow.png"></a>
                        <a href="produtos.php?orderBy=iva&orderDir=ASC"><img src="Imagens/up-arrow.png"></a>
                    </th>
                    </th>
                    <th scope="col">Preço Final</th>
                    <th scope="col">Produto-Categoria
                        <a href="produtos.php?orderBy=categoria_pro&orderDir=DESC"><img src="Imagens/down-arrow.png"></a>
                        <a href="produtos.php?orderBy=categoria_pro&orderDir=ASC"><img src="Imagens/up-arrow.png"></a>
                    </th>
                    </th>
                    <th scope="col">Sub-Categoria
                        <a href="produtos.php?orderBy=subcategoria&orderDir=DESC"><img src="Imagens/down-arrow.png"></a>
                        <a href="produtos.php?orderBy=subcategoria&orderDir=ASC"><img src="Imagens/up-arrow.png"></a>
                    </th>
                    </th>
                    <th scope="col">Categoria
                        <a href="produtos.php?orderBy=categoria&orderDir=DESC"><img src="Imagens/down-arrow.png"></a>
                        <a href="produtos.php?orderBy=categoria&orderDir=ASC"><img src="Imagens/up-arrow.png"></a>
                    </th>
                    </th>
                    <th scope="col">Stock
                        <a href="produtos.php?orderBy=quantidade&orderDir=DESC"><img src="Imagens/down-arrow.png"></a>
                        <a href="produtos.php?orderBy=quantidade&orderDir=ASC"><img src="Imagens/up-arrow.png"></a>
                    </th>
                    </th>
                    <th scope="col">Vendidos</th>
                    <th scope="col">Descrição</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <?php
            foreach ($lista as $produto) {
                if (isset($_GET['WW'])) {
                    if ($produto['subcategoria'] == 'Wooden Wonders') {
            ?>
                        <tbody>
                            <tr>
                                <td>
                                    <form action="produtos.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                                        <button type="submit" class="btn btn-outline-dark" name="delete">Delete</button>
                                    </form>
                                </td>
                                <form action="produtos.php" method="post">
                                    <td><?php echo $produto['id'] ?></td>
                                    <td><input class="boxtext" type="text" name="nome" value="<?php echo $produto['nome'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="tamanho" value="<?php echo $produto['tamanho'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="preco" value="<?php echo $produto['preco'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="iva" value="<?php echo $produto['iva'] ?>"></td>
                                    <td><?php echo precofinal($produto['preco'], $produto['iva']) ?>€</td>
                                    <td><?php echo $produto['categoria_pro'] ?></td>
                                    <td><?php echo $produto['subcategoria'] ?></td>
                                    <td><?php echo $produto['categoria'] ?></td>
                                    <td><input class="boxtext" type="text" name="quantidade" value="<?php echo $produto['quantidade'] ?>"></td>
                                    <td>falta função</td>
                                    <td><a href="produtos.php?WW&descr=<?php echo $produto['id'] ?>#p<?php echo $produto['id'] ?>"><img src="Imagens/lista.png"></a></td>
                                    <td>
                                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                                        <button type="submit" class="btn btn-outline-dark" name="update">Update</button>
                                    </td>
                            </tr>
                            <?php
                            if (isset($_GET['descr']) && ($_GET['descr'] == $produto['id'])) {
                            ?>
                                <tr id="p<?php echo $produto['id']; ?>">
                                    <td colspan="14">
                                        <textarea name="descricao" id="descricao" cols="177" rows="5"><?php echo $produto['descricao'] ?></textarea>
                                    </td>
                                </tr>
                            <?php  } ?>
                            </form>
                        </tbody>
                    <?php
                    }
                } else if (isset($_GET['MW'])) {
                    if ($produto['subcategoria'] == 'Magick Wonders') {
                    ?>
                        <tbody>
                            <tr>
                                <td>
                                    <form action="produtos.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                                        <button type="submit" class="btn btn-outline-dark" name="delete">Delete</button>
                                    </form>
                                </td>
                                <form action="produtos.php" method="post">
                                    <td><?php echo $produto['id'] ?></td>
                                    <td><input class="boxtext" type="text" name="nome" value="<?php echo $produto['nome'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="tamanho" value="<?php echo $produto['tamanho'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="preco" value="<?php echo $produto['preco'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="iva" value="<?php echo $produto['iva'] ?>"></td>
                                    <td><?php echo precofinal($produto['preco'], $produto['iva']) ?>€</td>
                                    <td><?php echo $produto['categoria_pro'] ?></td>
                                    <td><?php echo $produto['subcategoria'] ?></td>
                                    <td><?php echo $produto['categoria'] ?></td>
                                    <td><input class="boxtext" type="text" name="quantidade" value="<?php echo $produto['quantidade'] ?>"></td>
                                    <td>falta função</td>
                                    <td><a href="produtos.php?MW&descr=<?php echo $produto['id'] ?>#p<?php echo $produto['id'] ?>"><img src="Imagens/lista.png"></a></td>
                                    <td>
                                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                                        <button type="submit" class="btn btn-outline-dark" name="update">Update</button>
                                    </td>
                            </tr>
                            <?php
                            if (isset($_GET['descr']) && ($_GET['descr'] == $produto['id'])) {
                            ?>
                                <tr id="p<?php echo $produto['id']; ?>">
                                    <td colspan="14">
                                        <textarea name="descricao" id="descricao" cols="177" rows="5"><?php echo $produto['descricao'] ?></textarea>
                                    </td>
                                </tr>
                            <?php  } ?>
                            </form>
                        </tbody>
                    <?php
                    }
                } else if (isset($_GET['TW'])) {
                    if ($produto['subcategoria'] == 'Tiny Wonders') {
                    ?>
                        <tbody>
                            <tr>
                                <td>
                                    <form action="produtos.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                                        <button type="submit" class="btn btn-outline-dark" name="delete">Delete</button>
                                    </form>
                                </td>
                                <form action="produtos.php" method="post">
                                    <td><?php echo $produto['id'] ?></td>
                                    <td><input class="boxtext" type="text" name="nome" value="<?php echo $produto['nome'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="tamanho" value="<?php echo $produto['tamanho'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="preco" value="<?php echo $produto['preco'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="iva" value="<?php echo $produto['iva'] ?>"></td>
                                    <td><?php echo precofinal($produto['preco'], $produto['iva']) ?>€</td>
                                    <td><?php echo $produto['categoria_pro'] ?></td>
                                    <td><?php echo $produto['subcategoria'] ?></td>
                                    <td><?php echo $produto['categoria'] ?></td>
                                    <td><input class="boxtext" type="text" name="quantidade" value="<?php echo $produto['quantidade'] ?>"></td>
                                    <td>falta função</td>
                                    <td><a href="produtos.php?TW&descr=<?php echo $produto['id'] ?>#p<?php echo $produto['id'] ?>"><img src="Imagens/lista.png"></a></td>
                                    <td>
                                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                                        <button type="submit" class="btn btn-outline-dark" name="update">Update</button>
                                    </td>
                            </tr>
                            <?php
                            if (isset($_GET['descr']) && ($_GET['descr'] == $produto['id'])) {
                            ?>
                                <tr id="p<?php echo $produto['id']; ?>">
                                    <td colspan="14">
                                        <textarea name="descricao" id="descricao" cols="177" rows="5"><?php echo $produto['descricao'] ?></textarea>
                                    </td>
                                </tr>
                            <?php  } ?>
                            </form>
                        </tbody>
                    <?php
                    }
                } else if (isset($_GET['NW'])) {
                    if ($produto['subcategoria'] == 'Natural Wonders') {
                    ?>
                        <tbody>
                            <tr>
                                <td>
                                    <form action="produtos.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                                        <button type="submit" class="btn btn-outline-dark" name="delete">Delete</button>
                                    </form>
                                </td>
                                <form action="produtos.php" method="post">
                                    <td><?php echo $produto['id'] ?></td>
                                    <td><input class="boxtext" type="text" name="nome" value="<?php echo $produto['nome'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="tamanho" value="<?php echo $produto['tamanho'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="preco" value="<?php echo $produto['preco'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="iva" value="<?php echo $produto['iva'] ?>"></td>
                                    <td><?php echo precofinal($produto['preco'], $produto['iva']) ?>€</td>
                                    <td><?php echo $produto['categoria_pro'] ?></td>
                                    <td><?php echo $produto['subcategoria'] ?></td>
                                    <td><?php echo $produto['categoria'] ?></td>
                                    <td><input class="boxtext" type="text" name="quantidade" value="<?php echo $produto['quantidade'] ?>"></td>
                                    <td>falta função</td>
                                    <td><a href="produtos.php?NW&descr=<?php echo $produto['id'] ?>#p<?php echo $produto['id'] ?>"><img src="Imagens/lista.png"></a></td>
                                    <td>
                                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                                        <button type="submit" class="btn btn-outline-dark" name="update">Update</button>
                                    </td>
                            </tr>
                            <?php
                            if (isset($_GET['descr']) && ($_GET['descr'] == $produto['id'])) {
                            ?>
                                <tr id="p<?php echo $produto['id']; ?>">
                                    <td colspan="14">
                                        <textarea name="descricao" id="descricao" cols="177" rows="5"><?php echo $produto['descricao'] ?></textarea>
                                    </td>
                                </tr>
                            <?php  } ?>
                            </form>
                        </tbody>
                    <?php
                    }
                } else if (isset($_GET['HI'])) {
                    if ($produto['subcategoria'] == 'Herbal Incenses') {
                    ?>
                        <tbody>
                            <tr>
                                <td>
                                    <form action="produtos.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                                        <button type="submit" class="btn btn-outline-dark" name="delete">Delete</button>
                                    </form>
                                </td>
                                <form action="produtos.php" method="post">
                                    <td><?php echo $produto['id'] ?></td>
                                    <td><input class="boxtext" type="text" name="nome" value="<?php echo $produto['nome'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="tamanho" value="<?php echo $produto['tamanho'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="preco" value="<?php echo $produto['preco'] ?>"></td>
                                    <td><input class="boxtext" type="text" name="iva" value="<?php echo $produto['iva'] ?>"></td>
                                    <td><?php echo precofinal($produto['preco'], $produto['iva']) ?>€</td>
                                    <td><?php echo $produto['categoria_pro'] ?></td>
                                    <td><?php echo $produto['subcategoria'] ?></td>
                                    <td><?php echo $produto['categoria'] ?></td>
                                    <td><input class="boxtext" type="text" name="quantidade" value="<?php echo $produto['quantidade'] ?>"></td>
                                    <td>falta função</td>
                                    <td><a href="produtos.php?HI&descr=<?php echo $produto['id'] ?>#p<?php echo $produto['id'] ?>"><img src="Imagens/lista.png"></a></td>
                                    <td>
                                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                                        <button type="submit" class="btn btn-outline-dark" name="update">Update</button>
                                    </td>
                            </tr>
                            <?php
                            if (isset($_GET['descr']) && ($_GET['descr'] == $produto['id'])) {
                            ?>
                                <tr id="p<?php echo $produto['id']; ?>">
                                    <td colspan="14">
                                        <textarea name="descricao" id="descricao" cols="177" rows="5"><?php echo $produto['descricao'] ?></textarea>
                                    </td>
                                </tr>
                            <?php  } ?>
                            </form>
                        </tbody>
                    <?php }
                } else {
                    ?>
                    <tbody>
                        <tr>
                            <td>
                                <form action="produtos.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                                    <button type="submit" class="btn btn-outline-dark" name="delete">Delete</button>
                                </form>
                            </td>
                            <form action="produtos.php" method="post">
                                <td><?php echo $produto['id'] ?></td>
                                <td><input class="boxtext" type="text" name="nome" value="<?php echo $produto['nome'] ?>"></td>
                                <td><input class="boxtext" type="text" name="tamanho" value="<?php echo $produto['tamanho'] ?>"></td>
                                <td><input class="boxtext" type="text" name="preco" value="<?php echo $produto['preco'] ?>"></td>
                                <td><input class="boxtext" type="text" name="iva" value="<?php echo $produto['iva'] ?>"></td>
                                <td><?php echo precofinal($produto['preco'], $produto['iva']) ?>€</td>
                                <td><?php echo $produto['categoria_pro'] ?></td>
                                <td><?php echo $produto['subcategoria'] ?></td>
                                <td><?php echo $produto['categoria'] ?></td>
                                <td><input class="boxtext" type="text" name="quantidade" value="<?php echo $produto['quantidade'] ?>"></td>
                                <td>falta função</td>
                                <td><a id="popUpLink" value="<?php echo $produto['id'] ?>"><img src="Imagens/lista.png"></a></td>
                                <td>
                                    <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                                    <button type="submit" class="btn btn-outline-dark" name="update">Update</button>
                                </td>
                        </tr>
                        <tr id="popUpDescricao" value="<?php echo $produto['id'] ?>" style="display: none;">
                            <td colspan="14">
                                <textarea name="descricao" cols="177" rows="5"><?php echo $produto['descricao'] ?></textarea>
                            </td>
                        </tr>
                        </form>
                    </tbody>    
            <?php
                }
            }
            ?>
        </table>
    </div>
</section>
<script>

let popUpDescricao = document.getElementById('popUpDescricao');
let popUpLink = document.getElementById('popUpLink');

    popUpLink.addEventListener("click", function() {
        popUpDescricao.style.display = 'block';
        event.preventDefault();
    });

</script>
<?php
include_once 'footerAdmin.php';
/*?>
                    <tbody>
            <tr>
                <td>
                    <form action="produtos.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                        <button type="submit" class="btn btn-outline-dark" name="delete">Delete</button>
                    </form>
                </td>
                <form action="produtos.php" method="post">
                    <td><?php echo $produto['id'] ?></td>
                    <td><input class="boxtext" type="text" name="nome" value="<?php echo $produto['nome'] ?>"></td>
                    <td><input class="boxtext" type="text" name="tamanho" value="<?php echo $produto['tamanho'] ?>"></td>
                    <td><input class="boxtext" type="text" name="preco" value="<?php echo $produto['preco'] ?>"></td>
                    <td><input class="boxtext" type="text" name="iva" value="<?php echo $produto['iva'] ?>"></td>
                    <td><?php echo precofinal($produto['preco'], $produto['iva']) ?>€</td>
                    <td><?php echo $produto['categoria_pro'] ?></td>
                    <td><?php echo $produto['subcategoria'] ?></td>
                    <td><?php echo $produto['categoria'] ?></td>
                    <td><input class="boxtext" type="text" name="quantidade" value="<?php echo $produto['quantidade'] ?>"></td>
                    <td>falta função</td>
                    <td><a href="produtos.php?descr=<?php echo $produto['id'] ?>#p<?php echo $produto['id'] ?>" onclick="abrirDescricao()"><img src="Imagens/lista.png"></a></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                        <button type="submit" class="btn btn-outline-dark" name="update">Update</button>
                    </td>
            </tr>
            <?php
            if (isset($_GET['descr']) && ($_GET['descr'] == $produto['id'])) {
            ?>
                <tr id="p<?php echo $produto['id']; ?>">
                    <td colspan="14">
                        <textarea name="descricao" id="descricao" cols="177" rows="5"><?php echo $produto['descricao'] ?></textarea>
                    </td>
                </tr>
            <?php  } ?>
            </form>
        </tbody>    
            <?php*/
