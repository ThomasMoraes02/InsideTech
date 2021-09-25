<?php 

namespace Src\helpers;

Trait Global_Helper
{
    public function view($data = NULL, $page = "home")
    {
        $title = "Home";
        extract($data);

        include_once __DIR__ . "/../views/template/header.php";
        include_once __DIR__ . "/../views/pages/{$page}.php";
        include_once __DIR__ . "/../views/template/scripts.php";
        include_once __DIR__ . "/../views/template/footer.php";
    }

    public function flashMessage($type = NULL, $message)
    {
        $_SESSION['type'] = $type;
        $_SESSION['message'] = $message;

        return;
    }

    public function redirect($page)
    {
        header("Location: " . BASE_URL . "/{$page}");
    }

    public function removeFormatacaoTelefone($telefone)
    {
        return str_replace(["(", ")"," ","-"], "", $telefone);
    }

    public function removeFormatacaoCEP($cep)
    {
        return str_replace([".","-"], "", $cep);
    }

    public function pre($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

