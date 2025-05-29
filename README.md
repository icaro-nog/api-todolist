# Primeira Fase - Teste 1: API RESTful para Gerenciamento de Tarefas (To-Do List) com Laravel

## Objetivos
O objetivo desse desafio técnico é desenvolver uma API para gerenciar tarefas.
* 1 - Criar tarefa com título (obrigatório) e descrição
* 2 - Listar todas as tarefas
* 3 - Atualizar status de uma tarefa para: pendente(1), em andamento(2) ou concluída(3)
* 4 - Excluir tarefa
* 5 - Filtrar tarefas por status

## Linguagens, frameworks e softwares utilizados 
* Laravel 10
* Composer 2.7.9
* PHP 8.2.24
* MySQL 8.0.40
* Postman

## Instruções para execução local
1º Instale o <a href="https://www.php.net/">PHP</a> de acordo com seu sistema operacional e a versão descrita acima
<br>
2º Instale o <a href="https://git-scm.com/">Git</a> de acordo com seu sistema operacional e a versão descrita acima
<br>
3º Instale o <a href="https://getcomposer.org/">Composer</a> de acordo com seu sistema operacional e a versão descrita acima
<br>
4º Instale o <a href="https://www.mysql.com/">MySQL</a> de acordo com seu sistema operacional e a versão descrita acima
<br>
5º Instale o <a href="https://www.postman.com/">Postman</a> de acordo com seu sistema operacional
<br>
6º No terminal do seu sistema operacional, execute o comando abaixo para clonar o projeto
```
git clone https://github.com/icaro-nog/api-conectala.git (HTTPS)
ou
git clone git@github.com:icaro-nog/api-conectala.git (SSH)
```
7º Na pasta raiz do projeto clonado, para atualizar e instalar as dependências do <b>Composer</b>, execute os comandos abaixo
```
composer update
composer install
```
8º Vá até o arquivo <b>api-conectala/.env</b> e atualize as credenciais de conexão com o banco de dados, de acordo com o que foi definido na instalação do MySQL
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306 // PORTA DEFINIDA
DB_DATABASE=conectala
DB_USERNAME=root // USUÁRIO
DB_PASSWORD= // SENHA
```
9º Agora, no MySQL, execute o comando abaixo para criação do <b>banco de dados</b>
```
CREATE DATABASE conectala;
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

### Rota POST para criação de usuário
```
http://127.0.0.1:8000/api/v1/users
```
A requisição pode ser feita passando os dados em formato JSON através do Body, como no exemplo abaixo:
```
{
    "name": "Fulano de Tal",
    "email": "Fulano@deTal.com",
    "password": "1234"
}
```

### Após criar o usuário, faça login para ter acesso aos demais métodos da API
```
http://127.0.0.1:8000/api/v1/login
```
A requisição pode ser feita passando os dados em formato JSON através do Body, como no exemplo abaixo:
```
{
    "email": "Fulano@deTal.com",
    "password": "1234"
}
```
Em caso de sucesso na autenticação, será retornado algo parecido com isso:
```
{
    "message": "Usuário autorizado!",
    "status": 200,
    "data": {
        "token": "2|lUqf9ggygIKAOZLKi5FvILTS82xVhhA0PSH4ARiw1de7db1a"
    }
}
```
O Token deverá ser utilizado para o acesso aos demais métodos da API, sendo enviado pelo Header
```
Content-Type:application/json
Authorization:Bearer {token gerado}
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


### Perguntas inclusas no teste
3) Suponha que você precise integrar uma API REST externa em um projeto PHP. A API
fornece informações sobre o clima de uma determinada cidade.
Como você abordaria essa integração? Descreva os passos necessários para fazer uma
solicitação à API, receber os dados de resposta e armazená-los em um banco de dados
MySQL local para uso posterior.
Considere questões como autenticação, tratamento de respostas e cronograma de
atualização dos dados.
R.:
* Obter chave de API
* Fazer requisição à API
* Tratar a resposta
* Armazenar no banco de dados
* Atualizar os dados constantemente 

5) Quais são as melhores práticas para garantir um desenvolvimento de software seguro em
PHP?
R.:
* Validação e Sanitização de Dados
* Proteção contra CSRF
* Controle de Sessões Seguras
* Limitação de Tamanho de Arquivos
* Erros e Exceções
* Rotina de testes
