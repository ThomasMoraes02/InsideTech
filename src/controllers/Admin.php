<?php 

namespace Src\controllers;

use Src\helpers\CPF_Helper;
use Src\models\Admin_Model;
use Src\helpers\Global_Helper;

class Admin
{
    use Global_Helper;
    use CPF_Helper;

    public $model;

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

    public function insert()
    {
        $admin = $_POST;

        if($this->validaCPF($admin['cpf_admin']) != TRUE) {
            $this->flashMessage("danger", "CPF no formato inválido");
        } else {
            $admin['cpf_admin'] = $this->removeFormatacaoCPF($admin['cpf_admin']);
            $admin['telefone_admin'] = $this->removeFormatacaoTelefone($admin['telefone_admin']);
            $admin['senha_admin'] = password_hash($admin['senha_admin'], PASSWORD_DEFAULT);

            $this->model->insertAdm($admin);
        }

        $this->redirect("admin");
    }

    public function delete()
    {
        $adm_id = trim($_POST['adm_id']);

        if(!empty($adm_id)) {
            $this->model->deleteAdm($adm_id);
        }

        $this->redirect("admin");
    }
}