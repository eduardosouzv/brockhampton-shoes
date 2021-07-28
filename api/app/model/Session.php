<?php

include '../../../database/Connection.php';

class Session extends Connection
{
  public function generateSession($user_id)
  {
    $token = md5(uniqid(rand(), true));

    $query_verify_if_session_exists = "SELECT * FROM sessions WHERE users_id=:user_id";

    $verify_if_session_exists = Connection::prepare($query_verify_if_session_exists);
    $verify_if_session_exists->bindParam(':user_id', $user_id);
    $verify_if_session_exists->execute();

    $found_user = (array) $verify_if_session_exists->fetchAll();

    if (sizeof($found_user)) {
      $query_update_session =
        "UPDATE sessions 
        SET token = :token, 
        generated_in = NOW(),
        expires_in = (NOW() + INTERVAL 1 HOUR)
        WHERE users_id = :user_id";

      $update_session = Connection::prepare($query_update_session);
      $update_session->bindParam(':token', $token);
      $update_session->bindParam(':user_id', $user_id);
      $update_session->execute();

      return [
        "user_id" =>  $user_id,
        "token" =>  $token,
      ];
    }

    $query_generate_session = "INSERT INTO sessions (users_id, token, generated_in, expires_in)
    VALUES(:user_id,:token, NOW(),  (NOW() + INTERVAL 1 HOUR))";

    $generate_session = Connection::prepare($query_generate_session);
    $generate_session->bindParam(':token', $token);
    $generate_session->bindParam(':user_id', $user_id);

    $generate_session->execute();

    http_response_code(200);
    return [
      "user_id" =>  $user_id,
      "token" =>  $token,
    ];
  }

  public function findDatesByToken($token)
  {

    $query_find_dates_by_token =
      "SELECT generated_in, expires_in 
      FROM sessions WHERE token = :token;";

    $find_dates_by_token = Connection::prepare($query_find_dates_by_token);
    $find_dates_by_token->bindParam(':token', $token);
    $find_dates_by_token->execute();

    $dates = (array) $find_dates_by_token->fetch();

    return $dates["expires_in"];
  }

  public function excludeToken($token)
  {
    $query_exclude_token =
      "UPDATE sessions 
      SET token = NULL, 
      generated_in = NULL,
      expires_in = NULL
      WHERE token = :token";

    $exclude_token = Connection::prepare($query_exclude_token);
    $exclude_token->bindParam(':token', $token);
    $exclude_token->execute();

    return [
      "token_excluded" => $token
    ];
  }
}
