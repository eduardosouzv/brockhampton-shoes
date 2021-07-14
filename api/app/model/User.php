<?php

include '../../../database/Connection.php';

class User extends Connection
{
  public function registerUser($username, $password, $street, $number, $district, $state, $zip, $type)
  {
    $query = "INSERT INTO users(username, password, street, `number`, district, state, zip, `type`) 
    VALUES (:user_username,:user_password,:user_street,:user_number,:user_district,:user_state,:user_zip,:user_type)";

    $result = Connection::prepare($query);
    $result->bindParam(':user_username', $username);
    $result->bindParam(':user_password', $password);
    $result->bindParam(':user_street', $street);
    $result->bindParam(':user_number', $number);
    $result->bindParam(':user_district', $district);
    $result->bindParam(':user_state', $state);
    $result->bindParam(':user_zip', $zip);
    $result->bindParam(':user_type', $type);

    $result->execute();

    http_response_code(201);
    return [
      "created" =>  $username,
    ];
  }
}
