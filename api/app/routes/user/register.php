<?php

include '../../controllers/UserController.php';

$user_info = json_decode(file_get_contents('php://input'), true);

$userController = new UserController();

header('Content-Type: application/json');

echo json_encode($userController->registerUser(
  $user_info["username"],
  $user_info["password"],
  $user_info["street"],
  $user_info["number"],
  $user_info["district"],
  $user_info["state"],
  $user_info["zip"],
  $user_info["type"]
));
