<?php 

namespace Src\models;

use PDO;

class Admin_Model extends Model
{
    public $db;

    public function __construct()
    {
        $db = parent::Connection();
        $this->db = $db;
    }

    public function getAdmins()
    {
        $sql = "SELECT * FROM admin";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertAdm($admin)
    {
        extract($admin);

        $sql = "INSERT INTO admin (name, email, cpf, phone) VALUES (:nome_admin, :email_admin, :cpf_admin, :telefone_admin)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":nome_admin", $nome_admin);
        $stmt->bindParam(":email_admin", $email_admin);
        $stmt->bindParam(":cpf_admin", $cpf_admin);
        $stmt->bindParam(":telefone_admin", $telefone_admin);

        $continue = $stmt->execute();

        if($continue) {
            $sql = "INSERT INTO auth (fk_id_admin, password) VALUES (LAST_INSERT_ID(), :senha_admin)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":senha_admin", $senha_admin);
    
            $stmt->execute(); 
        }
    }

    public function deleteAdm($adm_id)
    {
        $sql = "DELETE FROM admin WHERE id_admin = $adm_id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();
    }

}