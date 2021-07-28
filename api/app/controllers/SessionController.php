<?php
require '../../model/Session.php';

class SessionController
{
  function generateSession($username, $password)
  {
    try {
      $timezone = "SET time_zone='America/Sao_Paulo'";
      $set_timezone = Connection::prepare($timezone);
      $set_timezone->execute();

      $session = new Session();

      $query_find_user = "SELECT id, password FROM users WHERE username=:username";
      $find_user = Connection::prepare($query_find_user);
      $find_user->bindParam(':username', $username);
      $find_user->execute();

      $found_user = (array) $find_user->fetchAll()[0];

      if (!password_verify($password, $found_user["password"])) {
        http_response_code(401);
        throw new Exception('not authorized');
      }

      return $session->generateSession($found_user["id"]);
    } catch (Exception $e) {
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }

  function validateSession($token)
  {
    try {
      $session = new Session();

      $expiration_date = $session->findDatesByToken($token);
      $now_date = date('Y-m-d H:i:s');

      if ($now_date >= $expiration_date) {
        $session->excludeToken($token);
        http_response_code(401);
        throw new Exception('invalid token');
      }

      return [
        "message" => "ok"
      ];
    } catch (Exception $e) {
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }

  function logoutSession($token)
  {
    try {
      $session = new Session();

      $session->excludeToken($token);

      return [
        "message" => "ok"
      ];
    } catch (Exception $e) {
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }
}
