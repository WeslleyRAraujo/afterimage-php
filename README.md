# Rotas - Afterimage

Como posso definir e executar rotas no meu projeto?
- Para esse exemplo rotas são definidas no arquivo **/public/index.php**;
- A classe principal é a **/app/src/Router.php**
- As rotas trabalham com os métodos GET e POST.
<br>

A declaração simples de rota é feita da seguinte maneira:

- Arquivo **/app/http/routes/router.php**
```php
<?php
include_once "./bootstrap.php";

$route = new Router();

// rota via get
$route->get('/', 'App\Controller\HomeController:index');

// rota via post
$route->post('/message', 'App\Controller\HomeController:json');

// rota via ambos os métodos
$route->any('/message', 'App\Controller\HomeController:json');
```

O Objeto ***Router*** é responsável pelo roteamento da aplicação, os métodos **get** , **post** e **any** são os auxiliares para esse tipo de tarefa.

Os parâmetros para ambos são:
> 1. A rota que vai ser acessada;
> 2. A Classe + método. 'Path\To\Class:method'

<br>

Parâmetro na rota:

É possível utilizar um *route param* por rota declara, conforme o exemplo abaixo.
os parâmetros precisam estar declarados com **:p**
- Arquivo **/app/http/routes/router.php**
```php
<?php
include_once "./bootstrap.php";

$route = new Router();

// :p representa que esse dado da rota é um parâmetro
$route->get('/message/:p', 'App\Controller\HomeController:json');
```

Para capturar o parâmetro o método da classe recebe um parâmetro
- Arquivo **/app/controller/HomeController.php**
```php
<?php

namespace App\Controller;

class HomeController
{
	public function json($arg)
	{
		header('Content-type: application/json');
		echo json_encode([
			'message' => 'Thanks!!!!',
			'github' => 'WeslleyRAraujo',
			'arg' => $arg
		], JSON_PRETTY_PRINT);
	}
}
```
<br>


Os métodos **get**, **post** e **any** podem ser encadeados como no exemplo abaixo. **Por questões de semântica é recomendado usar apenas para agrupamento de rotas**

```php
<?php
include_once "./bootstrap.php";

use Afterimage\Core\Router;

$route = new Router();

$route
    ->get('/usuario/cadastro', 'App\Controller\UserController:index')
    ->get('/usuario/excluir', 'App\Controller\UserController:delete')
    ->get('/usuario/salvar', 'App\Controller\UserController:store');
```
