<?php
session_start();
require_once '../connect.php';
require_once 'database/funcoes.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>R.Arte.ShoppingCar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link href="style.css" rel="stylesheet">

</head>

<body>

  <header id="topo">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand" href="../admin/ctg_chg_log.php?log"><img src="Imagens/R transparente preto - peq..png" />Raizes.Artezanato</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!------------------------------------------>
        <!----Se tiver logged in-------------------->
        <?php
        if (isset($_SESSION['user'])) {
        ?>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="buy.php" name="CraftWorkLink" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Hi <?php echo $_SESSION['user']['user']; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="shoppingcar.php" name="shoppingcar">Shopping Car</a></li>
                  <li><a class="dropdown-item" href="register_changeinfo.php?chg" name="accountinfo">Account Info</a></li>
                  <li><a class="dropdown-item" href="database/logout.php" name="logout">Log out</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="home.php#aboutus">AboutUS</a>
                <!--------MUDAR DEPENDE DA PAGINA------->
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="buy.php" name="CraftWorkLink" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  CraftWork
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="buy.php?CW=WoodenWonders" name="WoodenWonders">Wooden Wonders</a></li>
                  <li><a class="dropdown-item" href="buy.php?CW=MagickWonders" name="MagickWonders">Magick Wonders</a></li>
                  <li><a class="dropdown-item" href="buy.php?CW=TinyWonders" name="TinyWonders">Tiny Wonders</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="buy.php" name="HerbalProductsLink" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  HerbalProducts
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="buy.php?HP=NaturalWonders" name="NaturalWonders">Natural Wonders</a></li>
                  <li><a class="dropdown-item" href="buy.php?HP=HerbalIncenses" name="HerbalIncenses">Herbal Incenses</a></li>
                  <li><a class="dropdown-item" href="buy.php?HP=Candles" name="Candles">Candles</a></li>
                </ul>
              </li>
            </ul>
          </div>
        <?php
        } else {
        ?>
          <!------------------------------------------>
          <!----Se tiver logged out------------------->
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="register_changeinfo.php?reg">Register</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="home.php#aboutus">AboutUS</a>
                <!--------MUDAR DEPENDE DA PAGINA------->
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" name="CraftWorkLink" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  CraftWork
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="buy.php?CW=WoodenWonders" name="WoodenWonders">Wooden Wonders</a></li>
                  <li><a class="dropdown-item" href="buy.php?CW=MagickWonders" name="MagickWonders">Magick Wonders</a></li>
                  <li><a class="dropdown-item" href="buy.php?CW=TinyWonders" name="TinyWonders">Tiny Wonders</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" name="HerbalProductsLink" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  HerbalProducts
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="buy.php?HP=NaturalWonders" name="NaturalWonders">Natural Wonders</a></li>
                  <li><a class="dropdown-item" href="buy.php?HP=HerbalIncenses" name="HerbalIncenses">Herbal Incenses</a></li>
                  <li><a class="dropdown-item" href="buy.php?HP=Candles" name="Candles">Candles</a></li>
                </ul>
              </li>
            </ul>
          </div>
        <?php
        }
        ?>
        <!------------------------------------------>
        <!------------------------------------------>
      </div>
    </nav>
  </header>