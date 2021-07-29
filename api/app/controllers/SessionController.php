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

      $found_user = (array) $find_user->fetch();

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

      $session_info = $session->findDatesByToken($token);

      $now_date = date('Y-m-d H:i:s');

      if ($now_date >= $session_info["expiration_date"]) {
        $session->excludeToken($token);
        http_response_code(401);
        throw new Exception('invalid token');
      }

      return [
        "is_admin" => $session_info["is_admin"],
        "user_id" => $session_info["user_id"]
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
