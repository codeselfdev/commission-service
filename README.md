# commission-service
A commission fee calculation system which calculate commission on basis of operation type specific defined rules.

In root directory there have two folders. Which is seperating project source codes and docker related files.
Inside `codes` folder have a `docker-compose.yml` file.

Inside codes folder all source code is placed.
So to run application you can use your local PHP >= 8.1 and Composer:
```
cd codes
composer install
php script.php input.csv
```
To run tests
```
php vendor\bin\phpunit tests
```
or
```
composer test
```
To run application you can use docker as well.

In root location of this repo there have a `docker` folder consist a `docker-compose.yml` file inside it.
If you use docker then you don't need PHP and Composer installed locally. From root:
```
cd docker
docker-compose build
docker-compose up -d
docker-compose exec commission-calculator-app composer install
docker-compose exec commission-calculator-app php script.php input.csv
docker-compose exec commission-calculator-app composer test
docker-compose exec commission-calculator-app php vendor/bin/phpunit tests
docker-compose down
```
