<?php

namespace Src\models;

use PDO;

class Web_Model extends Model
{
    public function __construct()
    {  
        $db = parent::Connection();
        $this->db = $db;
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM tb_user";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM tb_user WHERE id = $id";
    
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($user)
    {
        extract($user);

        $sql = "INSERT INTO tb_user (nome, cpf, email, telefone, cep, endereco, numero, complemento, cidade, estado) VALUES (:nome, :cpf, :email, :telefone, :cep, :endereco, :numero, :complemento, :cidade, :estado)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":cep", $cep);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":complemento", $complemento);
        $stmt->bindParam(":cidade", $cidade);
        $stmt->bindParam(":estado", $estado);

        $stmt->execute();
    }

    public function update($user, $id)
    {
        extract($user);

        $sql = "UPDATE tb_user SET nome = :nome, cpf = :cpf, email = :email, telefone = :telefone, cep = :cep, endereco = :endereco, numero = :numero, complemento = :complemento, cidade = :cidade, estado = :estado WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":cep", $cep);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":complemento", $complemento);
        $stmt->bindParam(":cidade", $cidade);
        $stmt->bindParam(":estado", $estado);

        $stmt->execute();
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM tb_user WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();
    }

    public function search($user)
    {
        $sql = "SELECT * FROM tb_user WHERE nome LIKE '%".$user."%' OR email LIKE '%".$user."%' OR telefone LIKE '%".$user."%' OR cpf LIKE '%".$user."%' ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAdmin($email)
    {
        $sql = "SELECT * FROM tb_admin WHERE email_admin LIKE '%".$email."%'";
    
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
}