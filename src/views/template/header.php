<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<nav class="mt-2">
    <div class="navegacao">
        <h2 class="logo"><a href="<?= BASE_URL ?>/home">Home</a></h2>
        <ul>
            <li><a href="<?= BASE_URL ?>/cadastrar">Cadastrar</a></li>
            <li><a href="<?= BASE_URL ?>/listar">Listar</a></li>
            <li>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Preferências
        </a>
        <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#"><?= $_SESSION['firstname'] ?></a>
          <a class="dropdown-item" href="<?= BASE_URL ?>/admin">Admin</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= BASE_URL ?>/logout">Logout</a>
        </div>
            </li>
        </ul>
    </div>
</nav>

<body>