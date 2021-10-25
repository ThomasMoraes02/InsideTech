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
    <link rel="apple-touch-icon" sizes="180x180" href="public/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="public/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="public/img/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>

<nav>
    <div class="navegacao">
        <h2 class="logo"><a href="<?= BASE_URL ?>/home">Home</a></h2>
        <ul>
            <li><a href="<?= BASE_URL ?>/cadastrar">Cadastrar</a></li>
            <li><a href="<?= BASE_URL ?>/listar">Listar</a></li>
            <li>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Preferências
                </a>
                <div class="dropdown-menu text-center color-he" aria-labelledby="navbarDropdown">
                    <?php if($_SESSION['picture'] != false): ?>
                    <div>
                        <img class="fb_picture" src="<?= $_SESSION['picture'] ?>">
                    </div>
                    <?php endif; ?>
                    <a class="dropdown-item" href="#"><?= $_SESSION['firstname'] ?></a>
                    <a class="dropdown-item" href="<?= BASE_URL ?>/admin">Admin</a>
                    <a class="dropdown-item" href="<?= BASE_URL ?>/adm-logs">Logs</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" onclick="logout()" href="<?= BASE_URL ?>/logout">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>


<body>