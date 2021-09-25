<?php 

// Configurações para acesso ao banco de dados
define("DB_DRIVER", "mysql");

// define("DB_HOST", "127.0.0.1");
define("DB_HOST", "awsmysqlserver.cpmmtmvm6bii.us-east-2.rds.amazonaws.com");

// define("DB_NAME", "users");
define("DB_NAME", "test_database_aws");

// define("DB_USER", "root");
define("DB_USER", "admin");

// define("DB_PASS", "");
define("DB_PASS", "aws123456");


// Remova a última barra "/" da URL
define("BASE_URL", "http://localhost/projetos/insidetech");
// define("BASE_URL", "https://insidetechtgti.000webhostapp.com");

define("REQUEST", $_SERVER['REQUEST_URI']);