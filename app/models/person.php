<?php

namespace App\Models;

class Person {

  public $name;
  public $email;
  private $password;
  public $username;

  function __construct($username, $password, $name = null, $email = null){
    $this->name = $name;
    $this->email = $email;
    $this->username = strtolower($username);
    $this->password = $password;
  }

  function returnPassword(){
    return $this->password;
  }
}


?>
