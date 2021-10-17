<?php 

namespace Src\models;

use PDO;
use Src\models\Model;

class Auth_Model extends Model
{
    public $db;

    public function __construct()
    {
        $db = parent::Connection();
        $this->db = $db;
    }

    public function getAuth($email)
    {
        $sql = "SELECT * FROM admin WHERE email LIKE '%".$email."%'";

        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function getAuthPassword($fk_id_admin)
    {
        $sql = "SELECT * FROM auth WHERE fk_id_admin = $fk_id_admin";

        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
}