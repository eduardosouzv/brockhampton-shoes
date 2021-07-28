<?php
require '../../model/Session.php';

class SessionController
{
  function generateSession($username, $password)
  {
    try {
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
}
