<?php 

namespace Src\services;

use DateTime;
use Src\models\LogSingleton_Model;

class LogSingleton
{
    protected static $instanceLog;
    private static $instanceLogModel;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if(empty(self::$instanceLog)) {
            return self::$instanceLog = new self();
        }
    }

    private static function getInstanceModel()
    {
        if(empty(self::$instanceLogModel)) {
            return self::$instanceLogModel = new LogSingleton_Model();
        }
    }

    public function createLog($data, $type): void
    {
        $instanceLogModel = LogSingleton::getInstanceModel();

        switch ($type) {
            case 'auth-login':
                $log_message = "acessou o sistema";
                break;
            
            case 'auth-logout':
                $log_message = "saiu do sistema";
                break;

            case 'web-insert':
                $log_message = "cadastrou um novo usuario";
                $id = $instanceLogModel->getLastInsertId();
                $id_user = $id['id_user'];
                break;
            
            case 'web-update':
                $log_message = "atualizou o cadastro do usuario";
                $id_user = $data['user']['id'];
                break; 

            case 'web-delete':
                $log_message = "deletou o cadastro do usuario " . $data['user']['name'];
                $id_user = $data['user']['id_user'];
                break;    
        }

        if(empty($id_user)) {
            $id_user = null;
        }

        $id_admin = $data['auth']['id_admin'];

        $logJson = json_encode($log_message);

        $instanceLogModel->saveLog($id_admin, $logJson, $type, $id_user);
    }
}