# Documentação da API de Filmes Printi

### Descrição do Projeto 
#### Este documento descreve a API de Filmes Printi, que foi criada para fornecer um serviço de backend para uma aplicação web. A API é baseada no framework Laravel 9 e suporta operações CRUD (criar, ler, atualizar, excluir) em um banco de dados MySQL.
### Como instalar e executar a API
#### Para instalar e executar a API, siga as seguintes etapas:
1. Clone o repositório da API do Github:
``` bash
git clone https://github.com/ThallesLana/cine-printi.git
```
2. Instale as dependências do Composer:
``` bash
composer install
```
3. Crie um arquivo `.env` a partir do arquivo `.env.example` e configure as informações do banco de dados.
``` bash
cp .env.example .env
```
4. Execute as migrações do banco de dados para criar as tabelas necessárias (A adição da flag `--seed` é para registrar um dado para teste de consulta e verificação):
``` bash
php artisan migrate --seed
```
5. Inicie o servidor local da API:
``` bash
php artisan serve
```

## Como usar a API
#### A API é acessível em `http://localhost:8000/api`. Ela suporta as seguintes rotas:

`GET -> /api/list`

Retorna todos os filmes cadastrados no banco de dados;

`GET -> /api/list?title=batm`

Também é possível passar 4 tipos de paramêtro para acessar os filmes.
Para isso é necessário enviar um objeto JSON para a consulta, os paramêtros são: `title`, `category`, `release_year`, `age_range`;
```
{
    title: batm
    category: null
    age_range: null
    release_year: null
}
```

`GET -> /api/list/{id}`

Retorna o produto com o ID especificado.

`POST -> /api/create`
 
Cria um novo filme no banco de dados. É necessário enviar um objeto JSON contendo as seguintes informações:
```
{
    title: Stalker
    category: thriller
    age_range: 13
    release_year: 2004
}
```

`PUT -> /api/update`

Atualiza as informações do filme com o ID especificado. É necessário enviar um objeto JSON contendo as informações atualizadas:

```
{
    id_movie: 1
    title: The Joker
    category: Action
    age_range: 16
    release_year: 2020
}
```

`DELETE -> /api/delete`

Remove o filme com o ID especificado do banco de dados.

```
{
    id_movie: 1
}
```

## Considerações finais
Esta documentação deve fornecer as informações necessárias para usar a API de filmes. Foi montada seguindo todas as instruções passadas.
