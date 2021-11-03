<?php
include_once 'header.php';
$produtos = allProducts($conn);
$categorias = allCategory($conn);
?>

<?php
if (isset($_GET['CW'])) {
  if ($_GET['CW'] == 'WoodenWonders') {
?>
    <section class="container info-container">
      <?php
      foreach ($categorias as $categoria) {
        if ($categoria['nome'] == 'Wooden Wonders') {
      ?>
          <h1><?php echo $categoria['nome'] ?></h1>
          <p><?php echo $categoria['descricao'] ?></p>
      <?php }
      } ?>
    </section>
    <section class="container">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        foreach ($produtos as $produto) {
          if ($produto['subcategoria'] == 'Wooden Wonders') {
        ?>
            <div class="col">
              <div class="card">
                <img src="Imagens/WhatsApp Image 2020-03-24 at 21.09.49.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $produto['nome'] ?></h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <a href="#" class="btn btn-dark">Comprar</a>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </section>
  <?php
  } else if ($_GET['CW'] == 'MagickWonders') {
  ?>
    <section class="container info-container">
      <?php
      foreach ($categorias as $categoria) {
        if ($categoria['nome'] == 'Magick Wonders') {
      ?>
          <h1><?php echo $categoria['nome'] ?></h1>
          <p><?php echo $categoria['descricao'] ?></p>
      <?php }
      } ?>
    </section>
    <section class="container">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        foreach ($produtos as $produto) {
          if ($produto['subcategoria'] == 'Magick Wonders') {
        ?>
            <div class="col">
              <div class="card">
                <img src="Imagens/WhatsApp Image 2020-03-24 at 21.09.49.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $produto['nome'] ?></h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <a href="#" class="btn btn-dark">Comprar</a>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </section>
  <?php
  } else if ($_GET['CW'] == 'TinyWonders') {
  ?>
    <section class="container info-container">
      <?php
      foreach ($categorias as $categoria) {
        if ($categoria['nome'] == 'Tiny Wonders') {
      ?>
          <h1><?php echo $categoria['nome'] ?></h1>
          <p><?php echo $categoria['descricao'] ?></p>
      <?php }
      } ?>
    </section>
    <section class="container">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        foreach ($produtos as $produto) {
          if ($produto['subcategoria'] == 'Tiny Wonders') {
        ?>
            <div class="col">
              <div class="card">
                <img src="Imagens/WhatsApp Image 2020-03-24 at 21.09.49.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $produto['nome'] ?></h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <a href="#" class="btn btn-dark">Comprar</a>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </section>
  <?php }
} else if (isset($_GET['HP'])) {
  if ($_GET['HP'] == 'NaturalWonders') {
  ?>
    <section class="container info-container">
      <?php
      foreach ($categorias as $categoria) {
        if ($categoria['nome'] == 'Natural Wonders') {
      ?>
          <h1><?php echo $categoria['nome'] ?></h1>
          <p><?php echo $categoria['descricao'] ?></p>
      <?php }
      } ?>
    </section>
    <section class="container">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        foreach ($produtos as $produto) {
          if ($produto['subcategoria'] == 'Natural Wonders') {
        ?>
            <div class="col">
              <div class="card">
                <img src="Imagens/WhatsApp Image 2020-03-24 at 21.09.49.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $produto['nome'] ?></h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <a href="#" class="btn btn-dark">Comprar</a>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </section>
  <?php
  } else if ($_GET['HP'] == 'HerbalIncenses') {
  ?>
    <section class="container info-container">
      <?php
      foreach ($categorias as $categoria) {
        if ($categoria['nome'] == 'Herbal Incenses') {
      ?>
          <h1><?php echo $categoria['nome'] ?></h1>
          <p><?php echo $categoria['descricao'] ?></p>
      <?php }
      } ?>
    </section>
    <section class="container">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        foreach ($produtos as $produto) {
          if ($produto['subcategoria'] == 'Herbal Incenses') {
        ?>
            <div class="col">
              <div class="card">
                <img src="Imagens/WhatsApp Image 2020-03-24 at 21.09.49.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $produto['nome'] ?></h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <a href="#" class="btn btn-dark">Comprar</a>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </section>
  <?php
  } else if ($_GET['HP'] == 'Candles') {
  ?>
    <section class="container info-container">
      <?php
      foreach ($categorias as $categoria) {
        if ($categoria['nome'] == 'Candles') {
      ?>
          <h1><?php echo $categoria['nome'] ?></h1>
          <p><?php echo $categoria['descricao'] ?></p>
      <?php }
      } ?>
    </section>
    <section class="container">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        foreach ($produtos as $produto) {
          if ($produto['subcategoria'] == 'Candles') {
        ?>
            <div class="col">
              <div class="card">
                <img src="Imagens/WhatsApp Image 2020-03-24 at 21.09.49.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $produto['nome'] ?></h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <a href="#" class="btn btn-dark">Comprar</a>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </section>
<?php }
}  ?>


<?php
include_once 'footer.php';
?>