# Colibrique

Web Server for **[T14_Colibrique_Client](https://github.com/JClerc/T14_Colibrique_Client)**

## Installation

*Warning: read the commands before copy/pasting them!*

```sh
# Clone project
git clone https://github.com/JClerc/T14_Colibrique_Server.git
cd T14_Colibrique_Server
composer install
# Install database
sf db:seed
# Start server
sf server:run
```

## Test code compliance

```sh
# Symfony code convention
sf code:lint
# as alias of: vendor/bin/phpcs --standard=vendor/escapestudios/symfony2-coding-standard/Symfony2 src

# Unit tests
sf code:test
# as alias of: vendor/phpunit/phpunit/phpunit src
```

## API documentation

The OAuth2 endpoint for authentication is `/oauth/v2/token`.

For the documentation of the other methods, take a look at `/api/doc`.
