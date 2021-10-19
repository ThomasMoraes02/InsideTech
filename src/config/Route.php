<?php

namespace Src\config;

use Exception;
use Src\controllers\Web;
use Src\controllers\Auth;
use Src\controllers\Admin;

class Route
{
    public $url;

    public function __construct($url)
    {
        $this->url = $url;
        $this->setRoute($url);
    }

    public function getRoute(): string
    {
        return $this->url;
    }

    private static function GenerateInstances(): array
    {
        return [
            "Auth" => new Auth(),
            "Admin" => new Admin(),
            "Web" => new Web()
        ];
    }

    private function setRoute($request):void 
    {
        $parseUrl = parse_url(BASE_URL);
        $path = $parseUrl['path'];
        
        $controller = Route::GenerateInstances();

        if(!$path) {
            throw new Exception("Rota não configurada! Defina a URL em: src\config\config.php -> BASE_URL", 1);
        }

        switch($request) {
            case "$path/":
                $controller['Auth']->login();
                break;

            case "$path/autenticacao":
                $controller['Auth']->authentication();
                break;

            case "$path/logout":
                $controller['Auth']->logout();
                break;

            case "$path/admin":
                $controller['Admin']->index();
                break;

            case "$path/adm-cadastrar":
                $controller['Admin']->insert();
                break;

            case "$path/adm-deletar":
                $controller['Admin']->delete();
                break;

            case "$path/adm-logs":
                $controller['Admin']->logs();
                break;

            case "$path/home":
                $controller['Web']->index();
                break;
            
            case "$path/cadastrar":
                $controller['Web']->insertView();
                break;
            
            case "$path/insert":
                $controller['Web']->insert();
                break;
            
            case "$path/listar":
                $controller['Web']->list();
                break;
            
            case "$path/alterar":
                $controller['Web']->updateView();
                break;
            
            case "$path/update":
                $controller['Web']->update();
                break;
            
            case "$path/delete":
                $controller['Web']->delete();
                break;
            
            case "$path/buscar":
                $controller['Web']->searchView();
                break;
            
            default:
                $controller['Auth']->error();
                break;
        }
        return;
    }
}

