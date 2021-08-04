<center><img src="logo.png" width="350"></center>

# Projeto - Sistema Web Smart Suport.

[![](https://img.shields.io/pypi/status/ok)](https://travis-ci.org/joemccann/dillinger)
## Descrição

- **Projeto de um Help Desk (Suporte em TI) desenvolvido do zero, referente a disciplina de Programação para Internet 2, do curso de Tecnologia em Sistemas para Internet do Instituto Federal de Brasilia.**
    >Esse projeto é um sistema web de gerenciamento de chamados relacionados a TI. O help desk é o primeiro nível de atendimento em
    suporte, isso significa que é comum atender chamados mais simples ou focados em uma única plataforma como, por exemplo, problemas com
    acesso à internet, dificuldade de uso de dispositivos e problemas com algum software em específico. O mais importante é contar com uma plataforma  eficaz e completa para gerenciar as ações e, preferencialmente, uma que ofereça opções de automatização inteligente e de forma simples, otimizando o trabalho da equipe de TI.

## Tecnologias
- **Desenvolvimento**
    >No caso o backend foi aproveitado a partir do projeto do TCC Pontos de Entulhos, do Adjair Bezerra e Rafael Oliveira.
    O desenvolvimento do projeto é a partir do **PHP Orientado a Objetos**, com auxílio da estrutura **PDO**, para aumentar a produtividade. 
    As rotas são definidas pela classe **Slim** em uma arquitetura **API RESTful**.
    Os templates são gerados através da  classe **TPL(Rain TPL)**.
    Essa estrutura delimita o front-end do back-end.
    O sistema gerenciador de banco de dados relacional usado será o [MySQL Workbench](https://www.mysql.com/products/workbench/) e [phpMyAdmin](https://www.phpmyadmin.net/).

## Configuração habilitada

- **Tipo de servidor:** MySQL.
- **Apache/2.4.29**
- **Versão do PHP:** 7.2.24

  
 ## Instalações necessárias:

- [Composer](https://github.com/composer/composer)
- [Rain TPL](https://github.com/feulf/raintpl3)
- [Slim](https://www.slimframework.com/)
- [LAMP](https://www.techtudo.com.br/dicas-e-tutoriais/noticia/2012/11/como-instalar-lamp-no-linux.html) ou [WAMP](https://www.techtudo.com.br/tudo-sobre/wampserver.html) ou [XAMPP]() ou [MAMP](https://www.apachefriends.org/pt_br/index.html)
- [PHPMailler](https://github.com/PHPMailer/PHPMailer)

 ## Configurações necessárias:

- Recomendável configurar uma **Virtual Host** [LINUX](https://odesenvolvedor.com.br/como-configurar-um-dominio-com-lamp-linux-apache-mysql-php.html) ou [WINDOWS](https://hcode.com.br/blog/como-configurar-apache-virtual-hosts-no-windows)
- **Composer .Json**.

## Informações: 

- **Link da página de login adimistrativo no sistema** http://smart-suport-online.atwebpages.com/admin/login
     >**Login:** admin
    **Senha:** admin

- **Link da página de login dos colaboradores no sistema**  http://smart-suport-online.atwebpages.com/
    >O cadastro do colaborador é realizado somente pelo usuário administrador 

- **Link da página do site onde foi hospedado o projeto** https://www.awardspace.com/


