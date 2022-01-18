# Afterimage
Afterimage é um pequeno projeto em php para utilização de rotas

# Introdução
O Afterimage é um facilitador para trabalhar com rotas de uma forma super simples.

**Warning:** O Projeto ainda está em desenvolvimento, então quando se deparar com um  bug sugira correção ou melhoria sempre que puder = )  


## Estrutura de Diretórios
O Projeto possui dois diretórios, o **'/app'** onde fica armazenado toda a lógica da aplicação e o **'/public'** que fica responsável pelo conteúdo visível ao usuário.
<br>

## Mini Doc
Conheça o uso básico das rotas e controladores nesse link: <https://github.com/WeslleyRAraujo/afterimage-doc>

## Views [Twig template Engine]

As views estão localizadas em **/app/views**

- A template engine usada para as views é o Twig na versão 3.0, link para consulta: https://twig.symfony.com/doc/3.x/
- As views precisam estar com a extensão **.twig** para funcionar.
	> O template é retornado da forma abaixo, assim como a estrutura básica da documentação oficial do Twig.
	> exemplo: ``` return view('home', ['title' => 'Home']);```

## Configurações do .env

As configurações da aplicação podem ser alteradas ou adicionadas no arquivo **/app/config/.env**

- *O diretório /app/class são para classes de depêndencias que não estão amarradas ao core como a Twig e do Whoops, a Database é opcional.*