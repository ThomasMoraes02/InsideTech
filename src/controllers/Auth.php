<?php 

namespace Src\controllers;

use Exception;
use Src\models\Auth_Model;
use Src\helpers\Global_Helper;

class Auth
{
    use Global_Helper;

    public $email;
    public $password;
    public $model;

    public function __construct()
    {
        try {
            $this->model = new Auth_Model();
        } catch(Exception $e) {
            $this->view(["message" => "Erro: {$e->getMessage()}"]);
        }
    }

    public function login(): void
    {
        $data = array(
            "title" => "Login",
            "header" => "disabled",
        );

        $this->view($data, "login");
    }
    

    public function authentication(): void
    {
        $login = $_POST;

        $email = $_POST['email'];

        $admin = $this->model->getAuth($email);
        
        if(!empty($admin)) {
            $password = $this->model->getAuthPassword($admin['id_admin']);
            if(!empty($password)) {
                $admin['password'] = $password['password'];
            }
        }

        if(trim($admin['email']) == trim($email)) {
            if(password_verify($login['senha'], $admin['password'])) {
                $name = explode(" ", $admin['name']);

                $_SESSION['user_auth'] = $admin;
                $_SESSION['firstname'] = $name[0];

                $this->redirect("home");
                exit;
            }
        }

        $this->flashMessage("danger", "E-mail ou senha inválido!");
        $this->redirect("");
    }

    public function logout(): void
    {
        unset($_SESSION['user_auth']);
        unset($_SESSION['firstname']);

        $this->redirect("");
    }

    public function error(): void
    {
        $data = array(
            "title" => "Página não Encontrada!",
            "message" => "Ooops! Página não encontrada",
            "header" => "disabled"
        );

        $this->view($data, "error");
    }
}