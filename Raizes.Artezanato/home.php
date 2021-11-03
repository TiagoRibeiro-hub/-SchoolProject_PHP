<?php
include_once 'header.php';
$top3CW = top3CW($conn);
$top3HP = top3HP($conn);
$categorias = allCategory($conn);
?>


<!-- Login e Welcome-->
<section id="login-welcom">
  <div class="container">
    <div class="row">
      <div class="col welcom-col">
        <h1>Welcome</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam consequuntur magnam fuga veniam beatae repellendus porro, quam soluta! Id, maiores eveniet quidem saepe voluptas rem cupiditate repellat optio excepturi repudiandae odio iste eos eaque vitae architecto veritatis ut totam tempora eligendi. Suscipit dolorem assumenda cupiditate velit, nihil totam earum, tenetur accusantium eaque, quam ea dicta vel sed itaque nobis repellendus voluptatum ducimus! Dolorum veritatis aliquam vero laborum aspernatur voluptatum, facilis quidem ipsum. Vitae dolores, minima ullam rem optio quia? Consequuntur in eaque ducimus repudiandae aspernatur maiores, vero quia placeat exercitationem iure cupiditate odit cumque et, excepturi quod, voluptatem nam dignissimos.</p>
      </div>
      <!------------------------------------------>
      <!----Se tiver logged out------------------->
      <?php
      if (!isset($_SESSION['user'])) {
      ?>
        <div class="col login-col">
          <div class="login-container">
            <h3 class="login-title">Welcome</h3>
            <form action="database/reg_log_chg.php" method='post'>
              <div class="input-group">
                <label>User Name</label>
                <input type="text" name="username">
              </div>
              <div class="input-group">
                <label>Password</label>
                <input type="password" name="password">
              </div>
              <button type="submit" class="login-button" value="login" name="submitLogin">Log In</button>
              <div>
                <!---------------------------->
                <!-- mensagens de erro login-->
                <!---------------------------->
                <?php
                if (isset($_GET["error"])) {
                  if ($_GET["error"] == "emptyLogInput") {
                ?>
                    <p style="color:red; font-size: 2rem; font-weight: bold; text-align: center">Fill both fields!!!!</p>
                  <?php
                  } else if ($_GET["error"] == "wronginfo") {
                  ?>
                    <p style="color:red; font-size: 2rem; font-weight: bold; text-align: center">Wrong Info!!</p>
                  <?php
                  } else if ($_GET["error"] == "wrongpassword") {
                  ?>
                    <p style="color:red; font-size: 2rem; font-weight: bold; text-align: center">Wrong Password!!</p>
                <?php
                  }
                }
                ?>
                <!--------------------------->
                <!-- FIM mensagens de erro -->
                <!--------------------------->
              </div>
            </form>
          </div>
        </div>
        <!------------------------------------------>
        <!----Se tiver logged in-------------------->
      <?php
      } else {
      ?>
        <div class="col login-col">
          <img src="Imagens/_MG_2146.JPG" alt="" class="fluid">
          <!------Confirmar------->
        </div>
      <?php
      }
      ?>
    </div>
  </div>

</section>
<!---------------------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------- End Login e Welcome---------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------TOP 3 CraftWork Zone---------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------------------->
<section id="craftworkzone">
  <div class="container">
    <div class="row">
      <div class="col">
        <?php
        foreach ($categorias as $cat) {
          if ($cat['nome'] == 'Craft Work') {
        ?>
            <h1><?php echo $cat['nome'] ?></h1>
            <p><?php echo $cat['descricao'] ?></p>
        <?php }
        } ?>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h1>TOP 3</h1>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php
      foreach ($top3CW as $nome) {
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="Imagens/martelo.jpeg" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?php echo $nome['nome'] ?></h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <button type="button" class="btn btn-outline-dark">Comprar</button>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
<!----------------------------------------------------------------------------------------------------------------------------->
<!-----------------------------------------------End CraftWork Zone------------------------------------------------------------>
<!----------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------TOP 3 HerbalProducts Zone-------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<section id="herbalproductskzone">
  <div class="container">
    <div class="row">
      <div class="col">
        <?php
        foreach ($categorias as $cat) {
          if ($cat['nome'] == 'Herbal Products') {
        ?>
            <h1><?php echo $cat['nome'] ?></h1>
            <p><?php echo $cat['descricao'] ?></p>
        <?php }
        } ?>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h1>TOP 3</h1>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php
      foreach ($top3HP as $nome) {
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="Imagens/martelo.jpeg" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?php echo $nome['nome'] ?></h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <button type="button" class="btn btn-outline-dark">Comprar</button>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
<!---------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------------End HerbalProducts Zone----------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------AboutUS------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------------------->
<section id="aboutus">
  <div class="container">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="Imagens/_MG_3253.JPG" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="Imagens/_MG_3252.JPG" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="Imagens/IMG-0442_2.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <div class="row">
      <div class="col">
        <h1>AboutUS</h1><br>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita ratione eligendi enim eum, accusantium dolor quisquam asperiores iusto ullam quam beatae quas voluptatem, est atque sapiente consequatur autem libero. Nihil est, voluptas dicta eveniet similique suscipit saepe, officiis ratione quia minima dolorum perferendis odit dignissimos quas dolorem sapiente quasi neque qui odio a ut quam repudiandae modi? Corporis saepe officiis temporibus placeat, sit animi quia facilis? Vero maiores, corrupti accusantium ducimus rem nesciunt, eius expedita culpa perferendis quos sed quidem? Adipisci, provident harum nam asperiores autem a maiores aut aperiam! Doloremque laudantium, soluta animi mollitia pariatur odio eius molestiae! In.</p>
      </div>
    </div>
  </div>
</section>
<!--End AboutUS-->

<?php
include_once 'footer.php';
?>