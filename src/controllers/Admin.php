<?php 

namespace Src\controllers;

use Src\models\Admin_Model;
use Src\helpers\Global_Helper;

class Admin
{
    use Global_Helper;

    public function __construct()
    {
        try {
            $this->model = new Admin_Model();
        } catch(Exception $e) {
            $this->view(["message" => "Erro: {$e->getMessage()}"]);
        }
    }

    public function index()
    {
        $admins = $this->model->getAdmins();

        $data = array(
            "title" => "Admin",
            "admins" => $admins
        );

        $this->view($data, "admin");
    }

    public function cadastrar()
    {
        $admin = $_POST;
        $admin['senha_admin'] = password_hash($admin['senha'], PASSWORD_DEFAULT);
        
        $this->model->insertAdm($admin);

        $this->redirect("admin");
    }
}