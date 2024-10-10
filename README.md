# popertestapp

# <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Tutoring Admin Backend


This is a simple demo project for a course and invoice management system that supports Omise payments. This project provides API endpoints.

Front-end repository: [tutoring-education-frontend](https://github.com/baijunyao/tutoring-education-frontend)

## Environment Dependencies

-   PHP 8.2
-   MySQL 8.0 or PostgreSQL 16.0

## Quick Start

You can install the environment dependencies manually. If you are using a Mac, you can use Docker to set up the environment. To solve the Mac Docker file system performance issues, you can use NFS. You can install and start NFS by running the following command:

```bash
./vendor/baijunyao/laravel-docker-compose/bin/setup_native_nfs_docker_osx.sh
```

Start docker

```bash
docker compose up
```

Initialize the project:

```bash
docker compose exec php bash
cp .env.example .env
composer install
php artisan key:generate
php artisan passport:keys
php artisan migrate
php artisan db:seed
```

Open http://te.local.gd/docs to view the API documentation.

## Lint
