# Movement Ranking

## Objetivo

Endpoint REST que retorne o ranking de um determinado movimento, trazendo o nome do movimento e uma lista ordenada com os usuários, seu respectivo recorde pessoal (maior valor), posição e data.

## Stack
Foi utilizado no projeto o framework Laravel 8, que tem como pré-requisito o PHP na versão 7.3+, juntamente com MySql 5.7+.
- PHP 7.3+
    - Laravel 8
- MySql 5.7+

---

## Instalação

Clone o projeto disponibilizado no repositório:

    git clone git@github.com:aleonidas/movement-ranking

Crie o schema do seu DB:

    CREATE DATABASE `movement-ranking` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

Faça uma cópia do arquivo `.env-example` e renomeie para `.env`.
Configure os dados do seu DB no `.env`:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=movement-ranking
    DB_USERNAME=root
    DB_PASSWORD=

Na raiz do projeto, instale as dependências do composer:

    composer install


Execute a migration junto do `seed` para criar as tabelas e inserir a carga inicial.

    php artisan migrate --seed

Para acessar o endpoint, suba o server local que preferir:

    php -S localhost:8000 -t public

    php artisan serve


## Endpoint
Verifique o host conforme o server utilizado.

    http://127.0.0.1:8000/api/v1/ranking/movement/{id}


## Testes
Para executar os testes pode-se utilizar o `bin/phpunit` ou o comando `artisan`. 

    ./vendor/bin/phpunit

    php artisan test
