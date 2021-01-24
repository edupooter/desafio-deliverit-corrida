# desafio-deliverit-corrida
Desenvolvido para avaliação da DeliverIT

Baseado em Laravel 7 (PHP 7.4)

## Ambiente local

### Docker
Para montar o ambiente, foi utilizado o arquivo 'Dockerfile' na raíz do projeto.


## Instalar dependências
```
cp .env.example .env
vi .env
```

```
composer install

php artisan key:generate

php artisan migrate --seed
```

## Execução


Credenciais padrão:
- Email: admin@admin.com
- Pass: password
