<?php 

namespace Src\models;

use PDO;

class Admin_Model extends Model
{
    public function __construct()
    {
        $db = parent::Connection();
        $this->db = $db;
    }

    public function getAdmins()
    {
        $sql = "SELECT * FROM tb_admin";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertAdm($admin)
    {
        extract($admin);

        $sql = "INSERT INTO tb_admin (nome_admin, email_admin, senha_admin) VALUES (:nome_admin, :email_admin, :senha_admin)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":nome_admin", $nome_admin);
        $stmt->bindParam(":email_admin", $email_admin);
        $stmt->bindParam(":senha_admin", $senha_admin);

        $stmt->execute();
    }

}