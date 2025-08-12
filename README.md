# 📌 Task API - Laravel

Este projeto é uma API simples de gerenciamento de tarefas desenvolvida com **Laravel**.  
A API permite criar, listar e gerenciar tarefas de forma **stateless**, seguindo boas práticas de desenvolvimento.

## 🚀 Tecnologias Utilizadas

- [PHP](https://www.php.net/) 8+
- [Laravel](https://laravel.com/) 10+
- [Composer](https://getcomposer.org/)
- Banco de dados SQLite
- [Nginx](https://nginx.org/) ou [Apache](https://httpd.apache.org/)

## 📂 Estrutura de Rotas

As rotas estão definidas no arquivo `routes/api.php`.

| Método | Endpoint      | Descrição                     |
|--------|--------------|--------------------------------|
| GET    | `/api/teste` | Retorna a lista de tarefas     |

## 🛠 Instalação

### 1️⃣ Clonar o repositório
```bash
git clone https://github.com/joaovitorleandro/to-do
cd to-do
```
### 2️⃣ Instalar dependências
```bash
composer install
```

### 3️⃣ Configurar variáveis de ambiente
```bash
cp .env.example .env
```
Edite o arquivo .env e configure as informações do banco de dados.

### 4️⃣ Gerar a chave da aplicação
```bash
php artisan key:generate
```

### 5️⃣ Rodar as migrações
```bash
php artisan migrate
```
 ### 6️⃣ Iniciar o servidor
```bash
php artisan serve
```

A API estará disponível em:
```bash
http://localhost:8000/api/teste
```

📌 Exemplo de Resposta
```json
[
  {
    "id": 1,
    "title": "Minha nova tarefa",
    "completed": 0,
    "created_at": "2025-08-09T14:39:07.000000Z",
    "updated_at": "2025-08-09T14:39:07.000000Z"
  }
]
```

📄 Licença
Este projeto está sob a licença MIT.


