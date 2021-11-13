# Afterimage
Afterimage é um pequeno, mini, minusculo projeto para utilização de rotas em PHP.

# Introdução
O Afterimage é um facilitador para trabalhar com rotas de uma forma super simples aplicando o conceito de URL Amigável.

**Warning:** O Projeto ainda está em desenvolvimento, então quando se deparar com um  bug sugira correção ou melhoria sempre que puder = )  


## Estrutura de Diretórios
O Projeto possui dois diretórios, o **'/app'** onde fica armazenado toda a lógica da aplicação e o **'/public'** que fica responsável pelo conteúdo visível ao usuário.
<br>
## Iniciando o projeto

Há várias maneiras de iniciar o projeto, uma delas é executando o arquivo **index.php** navegando pela url até o diretório public ou configurando o arquivo httpd.conf para iniciar no diretório **/public**

## Rotas

Para criar uma rota é necessário definir um controlador também, como no template de inicialização do projeto.
<br>

arquivo **/public/index.php**
```console
// arquivo que tem como função chamar os includes entre outras depências projeto
include_once  "./bootstrap.php";

// classe do Roteador
use  Afterimage\Core\Router;

$route =  new  Router();

// na rota principal será executado o método index do controlador 
// HomeController que tem a função de retornar a view da paǵina principal
// ----------------------------------------------------------------------
// o 2º parâmetro do método get sempre irá seguir a seguinte ordem:
// 'Path\To\Controller:method'

$route->get('/', 'App\Controller\HomeController:index');
```

## Controlador

A estrutura básica do controlador tem a seguinte interface:
<br>

arquivo **/app/controller/HomeController.php**
```console
namespace  App\Controller; // namespace da aplicação

use  Afterimage\Core\Controller; // core do controlador

// nome do controlador + extensão da classe core
class HomeController  extends  Controller
{
	/**
	* o método index retorna a view home
	* o arquivo 'home' está localizado em /app/views/home.php
	*/
	public  function  index()
	{
		// a função view pode receber o nome da view + variáveis de escape em forma de array
		return  view('home',  ['title'  =>  'Home']);
	}
}
```
# Views


As views estão localizadas em **/app/views**

- As views possuem variáveis de escape para auxiliar na criação da view *[melhorias estão sendo implementadas]*.
	> As variáveis passadas por array em uma view podem ser utilizadas de forma direta dentro da view.
	> exemplo: return view('home', ['title' => 'Home']);
	> dentro do arquivo **/app/views/home.php** você pode utilizar o seguinte recurso: 
	> ```<title> <?=$title?> </title>``` isso irá imprimir 'Home' no lugar.
<br>
- Também há métodos para auxiliar no molde da view.
	> função **extend_view** para auxiliar na extensão de um template.
	> função **asset** para auxiliar na adição de um asset (js, css, ícones, etc).
