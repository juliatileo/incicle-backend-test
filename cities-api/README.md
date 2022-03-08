<h1 align="center">Incicle City API 🏠</h1>

## 💡 O que é?
API com cadastro e consulta de cidades.

## ⚙️ Como rodar?

### Instale as dependências do composer
composer install

### Crie uma copia do arquivo .env
cp .env .env.example

### Crie a key de encriptação do app
php artisan key:generate

### Crie seu banco de dados e adicione as informações no .env

### Rode as migrations
php artisan migrate

### Rode as seeds
php artisan db:seed

### Inicie o servidor
php artisan serve --port=8080
