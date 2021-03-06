<?php

namespace App\Models;

use App\Lib\GrabzItClient;
use App\Models\Person;


class User extends Person {

  protected $id;

  protected $table = 'users';

  public $loggedIn = 'true';

  protected $fillable = [
    'name',
    'username',
    'password',
    'email'
  ];

  function setId($id){
    $this->id = $id;
  }


}


?>
