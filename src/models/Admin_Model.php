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

    public function getLogs()
    {
        $sql = "SELECT l.id_log, l.fk_id_admin, a.name as name_admin, l.message_log, l.fk_id_user, u.name as name_user, l.type_log, l.timestamp_create_log FROM log l 
        LEFT JOIN user u ON u.id_user = l.fk_id_user
        JOIN admin a ON a.id_admin = l.fk_id_admin
        ORDER BY id_log DESC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}