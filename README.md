# Rotas - Afterimage

Como posso definir e executar rotas no meu projeto?
- As rotas são definidas no arquivo **/public/index.php**;
- As rotas trabalham com os métodos GET e POST.
<br>

A declaração simples de rota é feita da seguinte maneira:

- Arquivo **/public/index.php**
```php
<?php
include_once "./bootstrap.php";

use Afterimage\Core\Router;

$route = new Router();

// rota via get
$route->get('/', 'App\Controller\HomeController:index');

// rota via post
$route->post('/message', 'App\Controller\HomeController:json');

```

O Objeto ***Router*** é responsável pelo roteamento da aplicação, os métodos **get** e **post** são os auxiliares para esse tipo de tarefa.

Os parâmetros para ambos são:
> 1. A rota que vai ser acessada;
> 2. O controlador + método. 'Path\To\Controller:method'

<br>

Os métodos **get** e **post** fazem uso do ```return $this;``` por isso é possível utilizados de forma encadeada como no exemplo abaixo. **Por questões de semântica é recomendado usar apenas para agrupamento de rotas**

```php
<?php
include_once "./bootstrap.php";

use Afterimage\Core\Router;

$route = new Router();

// rotas encadeadas
$route
    ->get('/usuario/cadastro', 'App\Controller\UserController:index')
    ->get('/usuario/excluir', 'App\Controller\UserController:delete')
    ->get('/usuario/salvar', 'App\Controller\UserController:store');
```
