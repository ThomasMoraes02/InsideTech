<?php 

namespace Src\models;

use PDO;
use Src\models\Model;

class LogSingleton_Model extends Model
{
    public $db;

    public function __construct()
    {
        $db = parent::Connection();
        $this->db = $db;
    }

    public function saveLog($fk_id_admin, $message_log, $type_log, $fk_id_user = null)
    {
       $sql = "INSERT INTO log (fk_id_admin, message_log, type_log, fk_id_user) VALUES (:fk_id_admin, :message_log, :type_log, :fk_id_user)";
       
       $stmt = $this->db->prepare($sql);

       $stmt->bindParam(":fk_id_admin", $fk_id_admin);
       $stmt->bindParam(":message_log", $message_log);
       $stmt->bindParam(":type_log", $type_log);
       $stmt->bindParam(":fk_id_user", $fk_id_user);

       $stmt->execute();
    }

    public function getLastInsertId()
    {
        return $this->db->query("SELECT id_user FROM user ORDER BY id_user DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    }
}