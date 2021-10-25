<?php 

namespace Src\models;

use PDO;
use Src\models\Model;

class Facebook_Model extends Model
{
    public $db;

    public function __construct()
    {
        $db = parent::Connection();
        $this->db = $db;
    }

    public function insertUserFacebook($user)
    {
        extract($user);

        $sql = "INSERT INTO admin (name, email, fb_token, fb_picture) VALUES (:name, :email, :fb_token, :fb_picture)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":fb_token", $fb_token);
        $stmt->bindParam(":fb_picture", $fb_picture);

        $stmt->execute();
    }

    public function getUserFacebook($email)
    {
        $sql = "SELECT * FROM admin WHERE email LIKE '%".$email."%'";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastIdFacebook()
    {
        $sql = "SELECT id_admin FROM admin ORDER BY id_admin DESC LIMIT 1";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserFacebookId($id)
    {
        $sql = "SELECT * FROM admin WHERE id_admin = $id";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}