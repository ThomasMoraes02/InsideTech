<?php 

namespace Src\controllers;

use Src\models\model;
use Src\helpers\Global_Helper;
use Src\models\Facebook_Model;
use Src\services\LogSingleton;

class FacebookAuthenticate
{
    use Global_Helper;

    public $fb_email;
    public $model;

    public function __construct()
    {
        try {
            $this->model = new Facebook_Model();
        } catch(Exception $e) {
            $this->view(["message" => "Erro: {$e->getMessage()}"]);
        }
        $instanceLog = LogSingleton::getInstance();
    }

    public function FacebookAuthentication()
    {
        $this->fb_email = trim($_POST['fb_email']);
        $fb_user = $this->model->getUserFacebook($this->fb_email);

        if($fb_user) {
            $this->FacebookSetUserSession($fb_user);
        } else {
            $fb_data = [
                "name" => $_POST['fb_name'],
                "email" => $_POST['fb_email'],
                "fb_token" => $_POST['fb_token'],
                "fb_picture" => $_POST['fb_picture']
            ];

            $this->model->insertUserFacebook($fb_data);

            $lastId = $this->model->getLastIdFacebook();

            $fb_user = $this->model->getUserFacebookId($lastId['id_admin']);

            if($fb_user) {
                $this->FacebookSetUserSession($fb_user);
            }
        }

        $this->flashMessage("danger", "Usuário de Facebook inválido!");
        $this->redirect("");
    }

    public function FacebookSetUserSession($fb_user)
    {
        $name = explode(" ", $fb_user[0]['name']);

        $_SESSION['user_auth'] = $fb_user[0];
        $_SESSION['user_type'] = "facebook_admin";
        $_SESSION['firstname'] = $name[0];
        $_SESSION['picture'] = $fb_user[0]['fb_picture'];

        $data = [
            "auth" => $_SESSION['user_auth']
        ];

        LogSingleton::createLog($data, "auth-login-facebook");

        $this->redirect("home");
        exit;
    }
}