<?php

use Src\config\Route;

// Carregamento automático das classes
require_once __DIR__ . "/src/config/autoload.php";

// Configurações da aplicação
require_once __DIR__ . "/src/config/config.php";

// Inicializa a sessão
session_start();

// Redireciona para as rotas
$route = new Route(REQUEST);