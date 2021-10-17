<?php 

namespace Src\controllers;

use Exception;
use Src\helpers\CPF_Helper;
use Src\helpers\Global_Helper;
use Src\models\Web_Model;
use Throwable;

class Web
{   
    use Global_Helper;
    use CPF_Helper;

    public $model;

    public function __construct()
    {
        try {
            $this->model = new Web_Model();
        } catch(Exception $e) {
            $this->view(["message" => "Erro: {$e->getMessage()}"]);
        }
    }

    public function index(): void
    {   
        if(empty($_SESSION['user_auth'])) $this->redirect("");

        $this->view(["message" => "Welcome to the system..."]);
    }

    public function insertView(): void
    {
        if(empty($_SESSION['user_auth'])) $this->redirect("");
        if(!isset($this->model)) $this->redirect("home");
           
        $this->view(["title" => "Cadastrar"],"cadastrar");
    }

    public function insert(): void
    {
        $user = $_POST;
        
        if($this->validaCPF($user['cpf']) != TRUE) {
            $this->flashMessage("danger", "CPF no Formato Inválido!");

        } else { 
            $user['cpf'] = $this->removeFormatacaoCPF($_POST['cpf']);
            $user['telefone'] = $this->removeFormatacaoTelefone($_POST['telefone']);
            $user['cep'] = $this->removeFormatacaoCEP($_POST['cep']);
            
            $this->model->insert($user);
            $this->flashMessage("success", "Usuário cadastrado com sucesso!");
        }

        $this->redirect("cadastrar");
    }

    public function list(): void
    {
        if(empty($_SESSION['user_auth'])) $this->redirect("");
        if (!isset($this->model)) $this->redirect("home");

        $users = $this->model->getUsers();

        $data = array(
            "title" => "Listar",
            "users" => $users,
        );

        $this->view($data,"listar");
    }

    public function updateView(): void
    {
        if(empty($_SESSION['user_auth'])) $this->redirect("");
        if (!isset($this->model)) $this->redirect("home");

        try {
            $id = $_POST['id'];
            $user = $this->model->getUserById($id);
        } catch(Throwable $e) {
            $this->redirect("home");
        }

        $data = array(
            "title" => "Alterar",
            "user" => $user
        );

        $this->view($data,"alterar");
    }

    public function update(): void
    {
        $user = $_POST;

        if($this->validaCPF($user['cpf']) != TRUE) {
            $this->flashMessage("danger", "CPF no Formato Inválido!");
            $this->redirect("alterar");

        } else {
            $user['cpf'] = $this->removeFormatacaoCPF($_POST['cpf']);
            $user['telefone'] = $this->removeFormatacaoTelefone($_POST['telefone']);
            $user['cep'] = $this->removeFormatacaoCEP($_POST['cep']);

            $this->model->update($user, $user['id']);

            $this->flashMessage("success", "Usuário alterado com sucesso!");
            $this->redirect("listar");
        }
    }

    public function delete(): void 
    {
        $id = $_POST['id'];

        $this->model->delete($id);
        $this->redirect("listar");
    }

    public function searchView(): void
    {
        $filtro = $_POST['filtro'];
        $users = $this->model->search($filtro);

        $data = array(
            "title" => "Listar",
            "users" => $users,
        );

        $this->view($data, "listar");
    }
}