<?php
session_start();
require_once '../connect.php';
require_once 'opcoes/funcoesAdmin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link href="styleAdmin.css" rel="stylesheet">
  <script type="text/javascript" src="script.js"></script>
</head>

<body>
  <!------------------------------------------>
  <!----Se tiver logged in-------------------->
  <?php
  if (isset($_SESSION['email'])) {
  ?>
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand"><img src="Imagens/R transparente preto - peq..png" />Raizes.Artezanato</a>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="criar.php">CREATE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="produtos.php">READ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="ctg_chg_log.php">UPDATE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="ctg_chg_log.php">DELETE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="opcoes/logout.php?lgout">Log Out</a>
            </li>
          </ul>
          <form action="ctg_chg_log.php" method="post" class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-dark btn btn-dark" name="searchbtn" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  <?php
  } else {
  ?>
    <!------------------------------------------>
    <!----Se tiver logged out------------------->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="opcoes/logout.php"><img src="Imagens/R transparente preto - peq..png" />Raizes.Artezanato</a>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">CREATE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">READ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">UPDATE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">DELETE</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <?php
  }
  ?>