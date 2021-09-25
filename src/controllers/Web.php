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

    public function __construct()
    {
        try {
            $this->model = new Web_Model();
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

    public function autenticacao(): void
    {
        $login = $_POST;

        $email = $_POST['email'];

        $admin = $this->model->getAdmin($email);

        if(trim($admin['email_admin']) == trim($email)) {
            if(password_verify($login['senha'], $admin['senha_admin'])) {
                $name = explode(" ", $admin['nome_admin']);

                $_SESSION['usuario_autenticado'] = $admin;
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
        unset($_SESSION['usuario_autenticado']);
        unset($_SESSION['firstname']);

        $this->redirect("");
    }

    public function index(): void
    {   
        if(empty($_SESSION['usuario_autenticado'])) $this->redirect("");

        $this->view(["message" => "Welcome to the system..."]);
    }

    public function cadastrar(): void
    {
        if(empty($_SESSION['usuario_autenticado'])) $this->redirect("");
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

    public function listar(): void
    {
        if(empty($_SESSION['usuario_autenticado'])) $this->redirect("");
        if (!isset($this->model)) $this->redirect("home");

        $usuarios = $this->model->getUsers();

        $data = array(
            "title" => "Listar",
            "usuarios" => $usuarios,
        );

        $this->view($data,"listar");
    }

    public function alterar(): void
    {
        if(empty($_SESSION['usuario_autenticado'])) $this->redirect("");
        if (!isset($this->model)) $this->redirect("home");

        try {
            $id = $_POST['id'];
            $usuario = $this->model->getUserById($id);
        } catch(Throwable $e) {
            $this->redirect("home");
        }

        $data = array(
            "title" => "Alterar",
            "usuario" => $usuario
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

    public function buscar(): void
    {
        $filtro = $_POST['filtro'];
        $usuarios = $this->model->search($filtro);

        $data = array(
            "title" => "Listar",
            "usuarios" => $usuarios,
        );

        $this->view($data, "listar");
    }

    public function error(): void
    {
        $data = array(
            "title" => "Página não Encontrada!",
            "message" => "Ooops! Página não encontrada"
        );

        $this->view($data, "erro");
    }
}