<?php

namespace Src\models;

use PDO;

class Web_Model extends Model
{
    public $db;

    public function __construct()
    {  
        $db = parent::Connection();
        $this->db = $db;
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM user u LEFT JOIN address a ON u.id_user = a.fk_id_user";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM user u LEFT JOIN address a ON u.id_user = a.fk_id_user WHERE id_user = $id";
    
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($user)
    {
        extract($user);

        $sql_user = "INSERT INTO user (name, email, cpf, phone) VALUES (:nome, :email, :cpf, :telefone)";
        $stmt = $this->db->prepare($sql_user);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telefone", $telefone);

        $continue = $stmt->execute();

        if($continue) {
            $sql_address = "INSERT INTO address (fk_id_user, zipcode, address, number, compl, city, state) VALUES (LAST_INSERT_ID(), :cep, :endereco, :numero, :complemento, :cidade, :estado)";
            $stmt = $this->db->prepare($sql_address);
    
            $stmt->bindParam(":cep", $cep);
            $stmt->bindParam(":endereco", $endereco);
            $stmt->bindParam(":numero", $numero);
            $stmt->bindParam(":complemento", $complemento);
            $stmt->bindParam(":cidade", $cidade);
            $stmt->bindParam(":estado", $estado);
    
            $stmt->execute();
        }
    }

    public function update($user, $id)
    {
        extract($user);

        $sql = "UPDATE user u LEFT JOIN address a ON u.id_user = a.fk_id_user SET u.name = :nome, u.email = :email, u.cpf = :cpf, u.phone = :telefone, a.zipcode = :cep, a.address = :endereco, a.number = :numero, a.compl = :complemento, a.city = :cidade, a.state = :estado WHERE u.id_user = :id";

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
        $sql = "DELETE FROM user WHERE id_user = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function search($user)
    {
        $sql = "SELECT * FROM user WHERE name LIKE '%".$user."%' OR email LIKE '%".$user."%' OR phone LIKE '%".$user."%' OR cpf LIKE '%".$user."%' ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}