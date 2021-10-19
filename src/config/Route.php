<?php

namespace Src\config;

use Exception;
use Src\controllers\Web;
use Src\controllers\Auth;
use Src\controllers\Admin;

class Route
{
    public $url;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->setRoute($url);
    }

    public function getRoute(): string
    {
        return $this->url;
    }

    private function setRoute($request):void 
    {
        $controller = new Web();
        $controller_admin = new Admin();
        $controller_auth = new Auth();

        $parseUrl = parse_url(BASE_URL);
        $path = $parseUrl['path'];
        
        if(!$path) {
            throw new Exception("Rota não configurada! Defina a URL em: src\config\config.php -> BASE_URL", 1);
        }

        switch($request) {
            case "$path/":
                $controller_auth->login();
                break;

            case "$path/autenticacao":
                $controller_auth->authentication();
                break;

            case "$path/logout":
                $controller_auth->logout();
                break;

            case "$path/admin":
                $controller_admin->index();
                break;

            case "$path/adm-cadastrar":
                $controller_admin->insert();
                break;

            case "$path/adm-deletar":
                $controller_admin->delete();
                break;

            case "$path/adm-logs":
                $controller_admin->logs();
                break;

            case "$path/home":
                $controller->index();
                break;
            
            case "$path/cadastrar":
                $controller->insertView();
                break;
            
            case "$path/insert":
                $controller->insert();
                break;
            
            case "$path/listar":
                $controller->list();
                break;
            
            case "$path/alterar":
                $controller->updateView();
                break;
            
            case "$path/update":
                $controller->update();
                break;
            
            case "$path/delete":
                $controller->delete();
                break;
            
            case "$path/buscar":
                $controller->searchView();
                break;
            
            default:
                $controller_auth->error();
                break;
        }
        return;
    }
}

