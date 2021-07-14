<?php
require '../../model/User.php';

class UserController
{
  function registerUser($username, $password, $street, $number, $district, $state, $zip, $type)
  {
    try {
      $user = new User();

      if (
        !isset($username) ||
        !isset($password) ||
        !isset($street) ||
        !isset($number) ||
        !isset($state) ||
        !isset($zip) ||
        !isset($type)
      ) {
        http_response_code(404);
        throw new Exception('undefined data');
      }
      $hash_password =  password_hash($password, PASSWORD_DEFAULT);

      return $user->registerUser($username, $hash_password, $street, $number, $district, $state, $zip, $type);
    } catch (Exception $e) {
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }
}
