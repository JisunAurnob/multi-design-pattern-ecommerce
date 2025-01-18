<p align="center"><a href="https://laravel.com" target="_blank"><img src="public/placeholder/logo.png" width="200"></a></p>


## Multi Design Pattern Ecommerce

### Prerequisites
* Php ^8.1
* Composer
* MySql Database

### Installation

#### Clone the project

#### Go to project directory
```bash 
composer install
```
#### Copy .env.example and rename it as .env
```bash
cp .env.example .env
```
#### Generate app key
```bash
php artisan key:generate
```

#### Run the database migration, permissions and seeder 
```bash
php artisan migrate
```
```bash
php artisan permission:init
```
```bash
php artisan db:seed
```
