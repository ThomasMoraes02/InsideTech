<?php

namespace Src\config;

use Exception;
use Src\controllers\Web;
use Src\controllers\Admin;

class Route
{
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

        $parseUrl = parse_url(BASE_URL);
        $path = $parseUrl['path'];
        
        if(!$path) {
            throw new Exception("Rota não configurada! Defina a URL em: src\config\config.php -> BASE_URL", 1);
        }

        switch($request) {
            case "$path/":
                $controller->login();
                break;

            case "$path/autenticacao":
                $controller->autenticacao();
                break;

            case "$path/logout":
                $controller->logout();
                break;

            case "$path/admin":
                $controller_admin->index();
                break;

            case "$path/adm-cadastrar":
                $controller_admin->cadastrar();
                break;

            case "$path/home":
                $controller->index();
                break;
            
            case "$path/cadastrar":
                $controller->cadastrar();
                break;
            
            case "$path/insert":
                $controller->insert();
                break;
            
            case "$path/listar":
                $controller->listar();
                break;
            
            case "$path/alterar":
                $controller->alterar();
                break;
            
            case "$path/update":
                $controller->update();
                break;
            
            case "$path/delete":
                $controller->delete();
                break;
            
            case "$path/buscar":
                $controller->buscar();
                break;
            
            default:
                $controller->error();
                break;
        }
        return;
    }
}

