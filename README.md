## Laravel 13, GraphQL, rebing/graphql-laravel, Postman

### GraphQL запросы в Postman

### 1) запрос на получение всех постов:
либо прямо из браузера:
GET  https://graphql.loc/graphql?query={posts{id,title,description,author}}
либо через Postman:

POST  https://graphql.loc/graphql  (в боди - raw и JSON)

`
{
  "query": "{ posts { id title description author } }"
}
`

### 2) запрос на получение одного поста по id (или по title, но что-то одно) :
GET  https://graphql.loc/graphql?query={post(id:1){id,title,description,author}}
либо через Postman:

POST  https://graphql.loc/graphql (в боди - raw и JSON)
`
{
  "query": "{ post(id:1) { id title description author } }"
}
`
`
{
  "query": "{ posts(title: \"Created title\") { id title description author } }"
}
`

### 3) Создание нового поста:
POST  https://graphql.loc/graphql (в боди поставлено - raw и JSON)

`
{
  "query": "mutation CreatePostsMutation($title: String!,$description: String!,$author: String!) { storePost(title: $title, description: $description, author: $author) { id title description author } }",
  "variables": {
    "title": "Created title 1",
    "description": "Created title description",
    "author": "John Bowli Spenser"
  }
}
`

### 4) Удаление поста по id:
POST  https://graphql.loc/graphql (в боди поставлено - raw и JSON)

`
{
  "query": "mutation DeletePostMutation($id: Int!) { deletePost(id: $id) }",
  "variables": {
    "id": 21
  }
}
`
