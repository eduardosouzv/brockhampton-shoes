# BROCKHAMPTON Shoes

Projeto final do curso de ADS

# Instalação

Requisitos de instalação

- [PHP for Linux](https://computingforgeeks.com/how-to-install-php-on-ubuntu/)

# Enviroment Variables

Crie um arquivo na pasta `api/database` chamado `config.php` e insira os seguintes dados:

```
<?php

define('DB_NAME', 'db-name');
define('DB_HOST', 'db-host');
define('DB_USER', 'your-user');
define('DB_PASS', 'your-pass');
define('DB_PORT', 'db-port');
define('CLIENT_ID_IMGUR', 'imgur-client-id');

?>
```

# Rodando o projeto

Com as variaveis de ambiente e database configurados, precisamos iniciar o servidor local

```
php -S localhost:8000
```
