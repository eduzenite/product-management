# Sistema de Cadastro de Produtos

Este projeto é um sistema completo de cadastro e gerenciamento de produtos, com autenticação, múltiplas imagens, validações específicas e execução via Docker.

---
## Funcionalidades

- Autenticação com login de usuário padrão
- Tela de listagem de produtos com opções:
  - Cadastrar
  - Editar
  - Inativar (soft delete)
- Cadastro de produtos com os seguintes campos:
  - **Título**
  - **Imagens** (múltiplas, JPG ou PNG)
  - **Preço de venda**
  - **Custo**
  - **Descrição do produto** (campo com HTML limitado)

---

## Validações

- O **preço de venda** deve ser pelo menos **10% superior ao custo** do produto.
- A **descrição** aceita apenas as seguintes tags HTML: `<p>`, `<br>`, `<b>`, `<strong>`.
- Somente imagens nos formatos **JPG** e **PNG** são aceitas, com limite de 2MB por imagem.

---

## Arquitetura e Tecnologias

| Camada        | Tecnologia          |
|---------------|---------------------|
| Backend       | Laravel 9 (PHP 8.2) |
| Banco de Dados| MySQL 8             |
| Frontend      | Vue 3 + Inertia.js  |
| Ambiente      | Docker              |

---

## Testes

- Testes unitários para `Product` e `ProductImage`
- Cobertura de:
  - Criação de produtos
  - Validação de regras de negócio
  - Relacionamento entre produtos e imagens

### Executar os testes

```bash
php artisan test
```

---

## Instalação

### Pré-requisitos

- Docker
- Docker Compose

### Passo a passo

1. Clone o repositório:

```bash
git clone https://github.com/eduzenite/product-management
cd product-management
```

2. Copie o arquivo de ambiente e configure:

```bash
cp .env.example .env
```

3. Suba os containers:

```bash
docker-compose up -d
```

4. Acesse o container do app e instale as dependências:

```bash
docker exec -it amar-assist-app bash
composer install
php artisan migrate
php artisan storage:link
```

5. Instale as dependências do frontend:

```bash
npm install
npm run dev
```

6. Crie um usuário de teste:

```bash
php artisan tinker

>>> \App\Models\User::factory()->create([
...     'email' => 'admin@example.com',
...     'password' => bcrypt('password'),
... ]);
```

---

7. Dados fakes

Para facilitar os testes e visualização do sistema, é possível gerar produtos fictícios com o comando:
```bash
php artisan db:seed --class=FakerSeeder
```

Por segurança, esse seeder só insere dados quando o ambiente estiver configurado como local.

---

## Segurança

- CSRF Token nos formulários
- Validações robustas no backend
- Limpeza de HTML permitida apenas para tags seguras

---

## Manual do Usuário

1. Acesse `http://localhost:8080`
2. Crie uma conta
3. Faça login
4. Visualize, edite ou cadastre novos produtos via painel
