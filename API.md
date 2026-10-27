# API do ValiTrack

Esta documentação descreve os endpoints da API REST do projeto ValiTrack, com base nas rotas definidas em `routes/api.php` e nos controllers em `app/Http/Controllers/Api`.

## Base URL

A API está disponível em:

- `http://SEU_DOMINIO/api`
- `http://SEU_DOMINIO/api/v1`

Se o projeto estiver rodando em ambiente local com XAMPP, normalmente o caminho será algo como:

- `http://localhost/ValiTrack/public/api`
- `http://localhost/ValiTrack/public/api/v1`

## Observações gerais

- Todos os endpoints retornam JSON.
- A API possui duas variantes de rotas:
  - versão explícita: `/api/v1/...`
  - compatibilidade retroativa: `/api/...`
- Não há autenticação configurada nas rotas da API no momento.
- Em caso de erro de validação, a resposta costuma vir no formato padrão do Laravel.

## 1) Categorias

### Listar categorias

- Método: `GET`
- URL: `/api/v1/categorias`
- URL alternativa: `/api/categorias`

Resposta exemplo:

```json
[
  {
    "id": 1,
    "nome": "Bebidas",
    "descricao": "Produtos líquidos e refrigerantes",
    "created_at": "2026-10-02T12:00:00.000000Z",
    "updated_at": "2026-10-02T12:00:00.000000Z"
  }
]
```

### Buscar categoria por ID

- Método: `GET`
- URL: `/api/v1/categorias/{id}`

Resposta exemplo:

```json
{
  "id": 1,
  "nome": "Bebidas",
  "descricao": "Produtos líquidos e refrigerantes",
  "created_at": "2026-10-02T12:00:00.000000Z",
  "updated_at": "2026-10-02T12:00:00.000000Z"
}
```

### Criar categoria

- Método: `POST`
- URL: `/api/v1/categorias`

Body:

```json
{
  "nome": "Limpeza",
  "descricao": "Produtos de limpeza doméstica"
}
```

Validações:

- `nome`: obrigatório, até 100 caracteres
- `descricao`: obrigatório, até 255 caracteres

Resposta: `201 Created`

```json
{
  "id": 2,
  "nome": "Limpeza",
  "descricao": "Produtos de limpeza doméstica",
  "created_at": "2026-10-16T10:00:00.000000Z",
  "updated_at": "2026-10-16T10:00:00.000000Z"
}
```

### Atualizar categoria

- Método: `PUT`
- URL: `/api/v1/categorias/{id}`

Body:

```json
{
  "nome": "Produtos de limpeza",
  "descricao": "Itens para limpeza e higiene"
}
```

Resposta: `200 OK`

### Excluir categoria

- Método: `DELETE`
- URL: `/api/v1/categorias/{id}`

Comportamento:

- Remove a categoria se ela não estiver sendo usada por nenhum produto.
- Se houver produtos vinculados, retorna `409 Conflict` com mensagem:

```json
{
  "message": "Não é possível excluir esta categoria porque existem produtos relacionados a ela."
}
```

Resposta de sucesso: `204 No Content`

---

## 2) Produtos

### Listar produtos

- Método: `GET`
- URL: `/api/v1/produtos`

Resposta exemplo:

```json
[
  {
    "id": 1,
    "nome": "Água Mineral",
    "codigo_barras": "7891234567890",
    "fabricante": "Fonte Viva",
    "unidade_medida": "UND",
    "imagem": null,
    "categoria_id": 1,
    "estoque_minimo": 20,
    "created_at": "2026-10-02T12:00:00.000000Z",
    "updated_at": "2026-10-02T12:00:00.000000Z",
    "categoria": {
      "id": 1,
      "nome": "Bebidas",
      "descricao": "Produtos líquidos e refrigerantes",
      "created_at": "2026-10-02T12:00:00.000000Z",
      "updated_at": "2026-10-02T12:00:00.000000Z"
    }
  }
]
```

### Buscar produto por ID

- Método: `GET`
- URL: `/api/v1/produtos/{id}`

Resposta com categoria incluída.

### Criar produto

- Método: `POST`
- URL: `/api/v1/produtos`

Body:

```json
{
  "nome": "Refrigerante Lata",
  "codigo_barras": "7899876543210",
  "fabricante": "Sabor do Vale",
  "unidade_medida": "UND",
  "imagem": "https://exemplo.com/refrigerante.png",
  "categoria_id": 1,
  "estoque_minimo": 15
}
```

Validações:

- `nome`: obrigatório, até 150 caracteres
- `codigo_barras`: obrigatório, até 50 caracteres
- `fabricante`: obrigatório, até 100 caracteres
- `unidade_medida`: obrigatório, até 20 caracteres
- `imagem`: opcional, string, até 255 caracteres
- `categoria_id`: obrigatório, deve existir em `categorias`
- `estoque_minimo`: opcional, inteiro, mínimo 0

Resposta: `201 Created`

### Atualizar produto

- Método: `PUT`
- URL: `/api/v1/produtos/{id}`

### Excluir produto

- Método: `DELETE`
- URL: `/api/v1/produtos/{id}`

Resposta de sucesso: `204 No Content`

---

## 3) Fornecedores

### Listar fornecedores

- Método: `GET`
- URL: `/api/v1/fornecedores`

Resposta exemplo:

```json
[
  {
    "id": 1,
    "nome": "Distribuidora Norte",
    "contato": "Maria Silva",
    "telefone": "(11) 99999-0000",
    "email": "contato@distribuidoranorte.com",
    "cnpj": "12.345.678/0001-99",
    "endereco": "Rua A, 123 - Centro",
    "created_at": "2026-10-02T12:00:00.000000Z",
    "updated_at": "2026-10-02T12:00:00.000000Z"
  }
]
```

### Buscar fornecedor por ID

- Método: `GET`
- URL: `/api/v1/fornecedores/{id}`

### Criar fornecedor

- Método: `POST`
- URL: `/api/v1/fornecedores`

Body:

```json
{
  "nome": "Distribuidora Sul",
  "contato": "João Souza",
  "telefone": "(21) 98888-1111",
  "email": "joao@distribuidorasul.com",
  "cnpj": "98.765.432/0001-10",
  "endereco": "Av. Brasil, 456"
}
```

Validações:

- `nome`: obrigatório, até 150 caracteres
- `contato`: obrigatório, até 100 caracteres
- `telefone`: obrigatório, até 20 caracteres
- `email`: obrigatório, e-mail válido, até 150 caracteres, único no cadastro
- `cnpj`: obrigatório, até 18 caracteres, único no cadastro
- `endereco`: obrigatório, até 255 caracteres

Resposta: `201 Created`

### Atualizar fornecedor

- Método: `PUT`
- URL: `/api/v1/fornecedores/{id}`

### Excluir fornecedor

- Método: `DELETE`
- URL: `/api/v1/fornecedores/{id}`

Resposta de sucesso: `204 No Content`

---

## 4) Estoque

### Listar estoque geral

- Método: `GET`
- URL: `/api/v1/estoque`

Resposta exemplo:

```json
[
  {
    "id": 1,
    "nome": "Água Mineral",
    "codigo_barras": "7891234567890",
    "categoria": "Bebidas",
    "estoque_minimo": 20,
    "estoque_disponivel": 35,
    "abaixo_do_minimo": false
  }
]
```

Campos:

- `id`: identificador do produto
- `nome`: nome do produto
- `codigo_barras`: código de barras
- `categoria`: nome da categoria
- `estoque_minimo`: quantidade mínima configurada
- `estoque_disponivel`: total disponível calculado com base nos lotes
- `abaixo_do_minimo`: indica se o estoque está abaixo do mínimo

### Detalhar estoque de um produto

- Método: `GET`
- URL: `/api/v1/estoque/{id}`

Resposta exemplo:

```json
{
  "produto": {
    "id": 1,
    "nome": "Água Mineral",
    "codigo_barras": "7891234567890",
    "estoque_minimo": 20,
    "estoque_disponivel": 35,
    "abaixo_do_minimo": false
  },
  "lotes": [
    {
      "id": 10,
      "numero_lote": "LOT-001",
      "quantidade": 50,
      "saldo_disponivel": 35,
      "data_validade": "2027-12-31",
      "situacao_validade": "valido",
      "texto_validade": "Válido",
      "fornecedor": "Distribuidora Norte"
    }
  ]
}
```

Observações:

- O saldo disponível do lote é calculado em lógica de estoque.
- `situacao_validade` e `texto_validade` são fornecidos pelo modelo do lote.

---

## 5) Códigos HTTP comuns

- `200 OK` - operação realizada com sucesso
- `201 Created` - recurso criado com sucesso
- `204 No Content` - recurso removido com sucesso
- `400 Bad Request` - dados inválidos ou falha de validação
- `404 Not Found` - recurso não encontrado
- `409 Conflict` - conflito de negócio, como exclusão de categoria com produtos vinculados

## 6) Estruturas principais do domínio

### Categoria

```json
{
  "id": 1,
  "nome": "Bebidas",
  "descricao": "Produtos líquidos e refrigerantes"
}
```

### Produto

```json
{
  "id": 1,
  "nome": "Água Mineral",
  "codigo_barras": "7891234567890",
  "fabricante": "Fonte Viva",
  "unidade_medida": "UND",
  "imagem": null,
  "categoria_id": 1,
  "estoque_minimo": 20
}
```

### Fornecedor

```json
{
  "id": 1,
  "nome": "Distribuidora Norte",
  "contato": "Maria Silva",
  "telefone": "(11) 99999-0000",
  "email": "contato@distribuidoranorte.com",
  "cnpj": "12.345.678/0001-99",
  "endereco": "Rua A, 123 - Centro"
}
```

## 7) Observações do projeto

- A API está implementada em `app/Http/Controllers/Api`.
- As regras de validação estão em `app/Http/Requests/Api`.
- As rotas principais estão em `routes/api.php`.
- A aplicação tem suporte a rotas sem versão e com versão, permitindo transição gradual entre integrações antigas e novas.

Se quiser, também posso criar uma segunda versão desta documentação em formato mais profissional, com exemplos em `curl`, `Postman` e `Insomnia`.
