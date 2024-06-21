Installation

1. Clone the repository
git clone https://github.com/erenbekman/laravel-case.git
cd laravel-case

2. Install dependencies
composer install

3. Set up environment variables
cp .env.example .env
php artisan key:generate

4. Configure database in .env file
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

5. Run migrations
php artisan migrate

6. Install Passport
php artisan passport:install

7. Run the app
php artisan serve



Commands

Add Integration
php artisan integration:manage create --marketplace=hepsiburada --username=user --password=pass

Update Integration
php artisan integration:manage update --id=1 --marketplace=trendyol

Delete Integration
php artisan integration:manage delete --id=1
