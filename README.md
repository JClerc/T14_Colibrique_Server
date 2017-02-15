# Colibrique

Web Server for **[T14_Colibrique_Client](https://github.com/JClerc/T14_Colibrique_Client)**

## Installation

```sh
# Clone project
git clone https://github.com/JClerc/T14_Colibrique_Server.git
cd T14_Colibrique_Server
composer install
# Install database
sf doctrine:database:create --if-not-exists
sf doctrine:schema:update --force
sf doctrine:fixtures:load --no-interaction
# Start server
sf server:run
```
