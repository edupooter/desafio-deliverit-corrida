# desafio-deliverit-corrida
Desenvolvido para avaliação da DeliverIT

Baseado em Laravel 7 (PHP 7.2.5)

## Ambiente local

### Instalar dependências do PHP
```
composer install
```

Definir as variáveis de ambiente do projeto Laravel:
```
cp .env.example .env
```

### Docker

Para montar o ambiente, foram utilizados os arquivos 'docker-compose.yml' e 'Dockerfile' na raíz do projeto.

Exemplo de montagem do ambiente:
`docker-compose up -d`

Se estiver OK, devem ser exibidos três containers com o comando:
`docker ps`

Mais detalhes de como foi configurado o ambiente Docker:
https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose-pt

### Inicialização do projeto
O framework Laravel exige a geração de uma chave:
`docker-compose exec app php artisan key:generate`

É necessário também armazenar as configurações em cache:
`docker-compose exec app php artisan config:cache`

Configurar um usuário para o banco de dados:
`docker-compose exec db bash`

No shell do container:
```
mysql -u root -p
GRANT ALL ON laravel.* TO 'laraveluser'@'%' IDENTIFIED BY 'secret';
FLUSH PRIVILEGES;
EXIT;
exit
```

Algumas tabelas precisam ser criadas no banco de dados:
`docker-compose exec app php artisan migrate`

## Execução
Uma API ficará disponível em `http://localhost/api/v1`

Adicionar o seguinte header ao criar as requisições:
`Accept: application/json`

Um arquivo de collection da API no formato do Postman está disponível na raiz do projeto:
`/DeliverIT.postman_collection.json`

### Rotas disponíveis:

##### Inclusão de corredores para uma corrida
POST http://localhost/api/v1/runners
* Body:
    - name
    - cpf
    - birthday

##### Inclusão de provas
POST http://localhost/api/v1/racings
* Body:
    - type
    - race_date

##### Inclusão de corredores em provas
POST http://localhost/api/v1/race-runners
* Body:
    - runner_id
    - race_id

##### Inclusão de resultados dos corredores
POST http://localhost/api/v1/runners-results
* Body:
    - runner_id
    - race_id
    - start_time
    - finish_time

##### Listagem de classificação das provas por idade
GET http://localhost/api/v1/general-classification

##### Listagem de classificação das provas gerais
GET http://localhost/api/v1/age-classification
