## Requisitos

* PHP 8.2 ou superior
* MySQL 8 ou superior
* Composer

## Como rodar o projeto

Duplicar o arquivo ".env.example" e renomear para ".env"
Alterar no arqquivo .env as credenciais do banco de dados.

Instalar as dependências do PHP
```
composer install
```
Gerar a chave no arquivo .env
```
php artisan key:generate
```

## Sequência para criar o projeto
Criar o projeto com Laravel
```
composer create-project laravel/laravel .
```

Alterar no arqquivo .env as credenciais do banco de dados

Criar o arquivo de rotas para API
```
php artisan install:api
```
