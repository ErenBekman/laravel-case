# Installation

1. Clone the repository
```bash
git clone https://github.com/erenbekman/laravel-case.git
cd laravel-case
```

3. Install dependencies
composer install

4. Set up environment variables
- cp .env.example .env
- php artisan key:generate

5. Configure database in .env file
- DB_DATABASE=your_database
- DB_USERNAME=your_username
- DB_PASSWORD=your_password

6. Run migrations
php artisan migrate

7. Install Passport
```bash
php artisan passport:install
```

9. Run the app
```bash
php artisan serve
```


# Commands

## Add Integration
```bash
php artisan integration:manage create --marketplace=hepsiburada --username=user --password=pass
```

## Update Integration
```bash
php artisan integration:manage update --id=1 --marketplace=trendyol
```

## Delete Integration
```bash
php artisan integration:manage delete --id=1
```

# Postman Documentation 

- https://api.postman.com/collections/25990203-e5b2effa-6d3c-4f01-b7a0-4c8443df4ed4?access_key=PMAT-01J0XJ8NTFN91G7D1BAFV5CEQF
- https://elements.getpostman.com/redirect?entityId=25990203-e5b2effa-6d3c-4f01-b7a0-4c8443df4ed4&entityType=collection
