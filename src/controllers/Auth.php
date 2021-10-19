<?php 

namespace Src\controllers;

use Exception;
use Src\models\Auth_Model;
use Src\helpers\Global_Helper;
use Src\services\LogSingleton;

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

        $instanceLog = LogSingleton::getInstance();
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
        $this->email = $_POST['email'];
        $this->password = $_POST['senha'];

        $admin = $this->model->getAuth($this->email);
        
        if(!empty($admin)) {
            $password = $this->model->getAuthPassword($admin['id_admin']);
            if(!empty($password)) {
                $admin['password'] = $password['password'];
            }
        }

        if(trim($admin['email']) == trim($this->email)) {
            if(password_verify($this->password, $admin['password'])) {
                $name = explode(" ", $admin['name']);

                $_SESSION['user_auth'] = $admin;
                $_SESSION['firstname'] = $name[0];

                $data = [
                    "auth" => $_SESSION['user_auth']
                ];

                LogSingleton::createLog($data, "auth-login");

                $this->redirect("home");
                exit;
            }
        }

        $this->flashMessage("danger", "E-mail ou senha inválido!");
        $this->redirect("");
    }

    public function logout(): void
    {
        $data = [
            "auth" => $_SESSION['user_auth']
        ];

        LogSingleton::createLog($data, "auth-logout");

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