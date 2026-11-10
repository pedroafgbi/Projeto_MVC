# Projeto MVC em PHP

Projeto da disciplina **Programação de Sistemas para Web I** (IF Baiano – Campus Guanambi).
Aplicação em PHP seguindo o padrão **MVC**, com template **Bootstrap 5**.

Tema: Educação Ambiental e Educação para consumo

## Equipe

| Integrante |
1- Pedro Amaral Fernandes
2- Guilherme Moreira
3- Vitor Gabriel


## Organização em MVC

```
projeto_mvc/
├── .htaccess              <- só na opção A (subpasta)
├── config/
│   ├── database.php       <- credenciais reais (NÃO versionar)
│   └── database.example.php
├── database/
│   ├── database.sql       <- criação do banco e da tabela
│   └── create_user.sql
├── app/
│   ├── helpers.php        <- funções e(), url(), asset()
│   ├── Controllers/       <- UserController
│   ├── Models/            <- Database, User
│   ├── Validators/        <- UserValidator
│   └── Views/
│       ├── layouts/main.php   <- template Bootstrap (navbar, container)
│       └── users/             <- index.php, form.php
└── public/                <- única pasta acessível pelo navegador
    ├── index.php          <- front controller
    ├── router.php         <- só para o servidor embutido (php -S)
    ├── .htaccess
    ├── css/               <- bootstrap.min.css, estilo.css
    ├── js/                <- bootstrap.bundle.min.js, app.js
    └── img/               <- logo.png
```

| Camada | Responsabilidade | No projeto |
|---|---|---|
| Model | Acessa os dados | `User`, `Database` |
| View | Apresenta o HTML | `Views/users/*.php` |
| Controller | Recebe a requisição, usa o Model e escolhe a View | `UserController` |

## Como rodar

1. Copie a pasta para `htdocs` (XAMPP) e inicie **Apache** e **MySQL**.
2. Importe `database/database.sql` (phpMyAdmin → aba SQL).
3. Copie `config/database.example.php` para `config/database.php` e preencha com os dados do seu MySQL.
4. Acesse `http://localhost/NOME_DA_PASTA/`.

Alternativa sem Apache: `php -S localhost:8000 -t public public/router.php`.

## Divisão inicial das tarefas

| # | Tarefa | Responsável | Entrega |
|---|---|---|---|
| 1 | Criar o repositório e organizar a estrutura MVC | Todos | 1 |
| 2 | Adicionar o template Bootstrap ao layout e às views | Integrante 3 | 1 |
| 3 | Escrever o README e a divisão de tarefas | Integrante 3 | 1 |
| 4 | Revisar o banco (`database.sql`) e a conexão (`Database`) | Integrante 1 | 1 |
| 5 | Revisar rotas, controller e validação | Integrante 2 | 1 |
| 6 | *(a definir conforme as próximas entregas)* | — | 2 em diante |

> Atualizar esta tabela a cada entrega semanal.

## Combinados do grupo

- Cada integrante trabalha em uma **branch** própria e abre *pull request* para a `main`.
- Mensagens de commit curtas e no imperativo (ex.: "Adiciona validação de e-mail").
- O arquivo `config/database.php` **nunca** vai para o repositório.
