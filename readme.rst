###################
Semexe
###################

Informações Gerais para utilização do Sistema

**************************
config.php
**************************

Dentro do diretório src\config existe o arquivo de configuração para acesso ao Banco de Dados e de URL Local.
A URL local é a url base do navegador ao acessar o projeto sem a última barra.

*******************
MVC
*******************

Desenvolvido seguindo o padrão de arquitetura de desenvolvimento Model, View e Controller.

**************************
INDEX.PHP
**************************

O arquivo index.php é o que comporta as rotas do sistema. Cada requisição ou manipulação de URL é passada por ele
Caso não encontre a rota necessária, será redirecionada para a página de Erro.

**************************
Helpers
**************************

Para auxiliar no desenvolvimento, utilizei de auxiliares para evitar repetição desnecessária de código, mantendo sempre legível.

**************************
.htaccess
**************************

O arquivo htaccess foi utiizado para manipular a requisição enviada para index.php.

**************************
ORIENTAÇÕES
**************************

Para o correto funcionamento do projeto é preciso a rota e o acesso ao Banco de Dados.

Dentro de: src\config\config.php existe as constantes de configuração do projeto.

A constante BASE_URL é a rota do projeto sem a última barra "/".

As constantes de banco de dados fica a critério de configuração do servidor.



Thomas Moraes - 10/05/2021