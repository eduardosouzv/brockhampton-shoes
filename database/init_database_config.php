<?php

require('../get_env.php');

date_default_timezone_set('America/Sao_Paulo');

define('db_host', $_ENV["DB_HOST"]);
define('db_user', $_ENV["DB_USER"]);
define('db_password', $_ENV["DB_PASSWORD"]);
define('db_name', $_ENV["DB_NAME"]);
