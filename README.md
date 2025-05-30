# Primeira Fase - Teste 1: API RESTful para Gerenciamento de Tarefas (To-Do List) com Laravel

## Objetivos
O objetivo desse desafio técnico é desenvolver uma API para gerenciar tarefas.
* 1 - Criar tarefa com título (obrigatório) e descrição
* 2 - Listar todas as tarefas
* 3 - Atualizar status de uma tarefa para: pendente(1), em andamento(2) ou concluída(3)
* 4 - Excluir tarefa
* 5 - Filtrar tarefas por status

## Linguagens, frameworks e softwares utilizados 
* Laravel 12
* Composer 2.8
* PHP 8.2
* MySQL 8.4
* Insomnia

## Instruções para execução local
1º Instale o <a href="https://www.php.net/">PHP</a> de acordo com seu sistema operacional e a versão descrita acima
<br>
2º Instale o <a href="https://git-scm.com/">Git</a> de acordo com seu sistema operacional e a versão descrita acima
<br>
3º Instale o <a href="https://getcomposer.org/">Composer</a> de acordo com seu sistema operacional e a versão descrita acima
<br>
4º Instale o <a href="https://www.mysql.com/">MySQL</a> de acordo com seu sistema operacional e a versão descrita acima
<br>
5º Instale o <a href="https://insomnia.rest/download">Insomnia</a> ou qualquer client HTTP de sua preferência, de acordo com seu sistema operacional
<br>
6º No terminal do seu sistema operacional, execute o comando abaixo para clonar o projeto
```
git clone https://github.com/icaro-nog/api-todolist.git (HTTPS)
ou
git clone git@github.com:icaro-nog/api-todolist.git (SSH)
```
7º Na pasta raiz do projeto clonado, para atualizar e instalar as dependências do <b>Composer</b>, execute os comandos abaixo
```
composer update
composer install
```
8º Vá até o arquivo <b>api-todolist/.env</b> e atualize as credenciais de conexão com o banco de dados, de acordo com o que foi definido na instalação do MySQL
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306 // PORTA DEFINIDA
DB_DATABASE=todolist
DB_USERNAME=root // USUÁRIO
DB_PASSWORD= // SENHA
```
9º Agora, no MySQL, via terminal ou ferramenta gráfica de banco de dados como Dbeaver ou MySQL Workbench, execute o comando abaixo para criação do <b>banco de dados</b>
```
CREATE DATABASE todolist;
```
10º Agora, execute o comando abaixo para criação das <b>tabelas</b> no banco de dados
```
php artisan migrate
```
11º Para servir a aplicação, execute o seguinte comando
```
php artisan serve
```
Após isso, a aplicação estará pronta para testagens!

### Rota POST para criação de tarefa
```
http://127.0.0.1:8000/api/task
```
A requisição pode ser feita passando os dados em formato JSON através do Body, como no exemplo abaixo:
```
{
  "title": "Nova tarefa", // required
  "description": "Descrição opcional", // nullable
  "status": 2 // between 1, 3
}
```
Resposta esperada:
```
{
	"task": {
		"title": "Nova tarefa",
		"status": 2,
		"description": "Descrição opcional",
		"updated_at": "2025-05-29T20:39:33.000000Z",
		"created_at": "2025-05-29T20:39:33.000000Z",
		"id": 19
	}
}
```
### Rota GET para listagem de tarefas
```
http://127.0.0.1:8000/api/tasks
```
Resposta esperada:
```
{
	"tasks": [
		{
			"id": 2,
			"title": "tarefa 1",
			"description": "desc tarefa 1",
			"status": 1,
			"created_at": "2025-05-27T16:00:14.000000Z",
			"updated_at": "2025-05-27T16:00:14.000000Z"
		},
		{
			"id": 4,
			"title": "tarefa 4",
			"description": "desc tarefa 4",
			"status": 3,
			"created_at": "2025-05-27T18:38:45.000000Z",
			"updated_at": "2025-05-28T22:03:07.000000Z"
		},
    ]
}
```
### Rota GET para listagem de tarefas por status, pode ser passado o parâmetro entre 1 e 3 (pendente(1), em andamento(2) ou concluída(3))
```
http://127.0.0.1:8000/api/tasks/status/3
```
Resposta esperada:
```
{
	"tasks": [
		{
			"id": 4,
			"title": "tarefa 4",
			"description": "desc tarefa 4",
			"status": 3,
			"created_at": "2025-05-27T18:38:45.000000Z",
			"updated_at": "2025-05-28T22:03:07.000000Z"
		},
      ]
}
```
### Rota PUT para atualização de status de tarefa, deve ser passado o id da tarefa como parâmetro
```
http://127.0.0.1:8000/api/task/4
```
Exemplo de requisição em JSON no body, deve ser passado o valor do novo status:
```
{
  "status": 2 // between 1, 3
}
```
Resposta esperada:
```
{
	"task": {
		"id": 4,
		"title": "tarefa 4",
		"description": "desc tarefa 4",
		"status": 1,
		"created_at": "2025-05-27T18:38:45.000000Z",
		"updated_at": "2025-05-30T15:45:23.000000Z"
	}
}
```
### Rota DELETE para exclusão de tarefa, deve ser passado o id da tarefa como parâmetro
```
http://127.0.0.1:8000/api/task/4
```
Resposta esperada:
```
{
	"message": "Task deleted successfully."
}
```

## Observação
Tratamento foi realizado em todas as requisições inesperadas, para a rota DELETE, por exemplo, 
caso seja realizada uma requisição para um id inexistente no banco de dados, será retornado algo como:
```
{
	"error": "Task not found."
}
```

## Teste unitários
O controller de testes, está em ```to-do-list/tests/Feature/TaskControllerTest.php```
Para rodar os testes, é necessário executar o seguinte comando na raiz do projeto
```
php artisan test
```

## Documentação da API realizada no Swagger
```
http://127.0.0.1:8000/api/documentation
```


## Pontuação de possíveis melhorias
* Captura de logs para coleta de possíveis erros
* Sanitização dos campos dos formulários
* Paginação da listagem de tarefas


