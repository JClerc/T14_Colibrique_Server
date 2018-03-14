<h1 align="center">
  <img alt="colibrique-server" width="652" src="https://jclerc.github.io/assets/repos/banner/colibrique-server.jpg">
  <br>
</h1>

<p align="center">
  <img alt="made for: school" src="https://jclerc.github.io/assets/static/badges/made-for/school.svg">
  <img alt="language: php" src="https://jclerc.github.io/assets/static/badges/language/php.svg">
  <img alt="made in: 2017" src="https://jclerc.github.io/assets/static/badges/made-in/2017.svg">
  <br>
  <sub>A platform to help students & teachers in their daily tasks.</sub>
</p>
<br>

## Features

- [x] OAuth2 authentication
- [x] REST API for users, posts, ...
- [x] Generated API documentation
- [x] Linting and unit testing

## Stack used

- Symfony `3.2`
- Doctrine `2.5`
- FOSUserBundle `2.0`
- PHP `5.6`

## Getting started

#### Requirements

- `composer`
- Apache server with PHP 5.6+
- A recent MySQL server

#### Installation

```sh
git clone https://github.com/jclerc/colibrique-server.git
cd colibrique-server
# Install dependencies
composer install
# Install database
sf db:seed
# Start server
sf server:run
```

## Notes

#### Testing code compliance
```sh
# Symfony code convention
sf code:lint
# as alias of: vendor/bin/phpcs --standard=vendor/escapestudios/symfony2-coding-standard/Symfony2 src

# Unit tests
sf code:test
# as alias of: vendor/phpunit/phpunit/phpunit src
```

#### API documentation

- The OAuth2 endpoint for authentication is `/oauth/v2/token`
- For the documentation of the other methods, take a look at `/api/doc`
