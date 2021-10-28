<?php 

// Configurações para acesso ao banco de dados
define("DB_DRIVER", "mysql");

// define("DB_HOST", "techinsideaws.cpmmtmvm6bii.us-east-2.rds.amazonaws.com");
define("DB_HOST", "127.0.0.1");

define("DB_NAME", "tech_inside");

// define("DB_USER", "admtech");
define("DB_USER", "root");

define("DB_PASS", "");
// define("DB_PASS", "awstech123");


// Remova a última barra "/" da URL
// A integração requer HTTPS
define("BASE_URL", "https://localhost/projetos/techinside");
// define("BASE_URL", "https://insidetechtgti.000webhostapp.com");

define("REQUEST", $_SERVER['REQUEST_URI']);