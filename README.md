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
sf doctrine:database:drop --if-exists --force
sf doctrine:database:create
sf doctrine:schema:update --force
sf doctrine:fixtures:load --no-interaction
# Start server
sf server:run
```
