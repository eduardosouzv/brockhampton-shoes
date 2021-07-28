<?php

include '../../controllers/SessionController.php';

$user_info = json_decode(file_get_contents('php://input'), true);

$sessionController = new SessionController();

header('Content-Type: application/json');

echo json_encode($sessionController->generateSession(
  $user_info["user"],
  $user_info["password"],
));
