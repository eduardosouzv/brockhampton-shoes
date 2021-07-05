<?php

require './get_env.php';

$redirect = './view/customer/index.php';

header('Location: ' . $redirect);
die();
