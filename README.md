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
Exemplo de resposta:
///////

### Rota GET para listagem de tarefas
```
http://127.0.0.1:8000/api/tasks
```
Exemplo de resposta:
```
{
  "title": "Nova tarefa", // required
  "description": "Descrição opcional", // nullable
  "status": 2 // between 1, 3
}
```





### Rotas para gerenciamento de informações
* Listagem (GET): ``` http://127.0.0.1:8000/api/v1/users ```
* Leitura de usuário em específico (GET): ``` http://127.0.0.1:8000/api/v1/users/{id} ```
* Edição (PUT): ``` http://127.0.0.1:8000/api/v1/users/{id} ```
* Exclusão (DELETE): ``` http://127.0.0.1:8000/api/v1/users/{id} ```

## Pontuação de melhorias
* Captura de logs para coleta de possíveis erros
* Sanitização dos campos dos formulários
* Ter uma rotina de testes, pode ser utilizado o PHPUnit
* Paginação da listagem de registros
* Data de validade do token
* Validar se email já está em uso
* Senha forte


