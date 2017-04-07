<?php

namespace App\Models;

use App\Models\Person;


class Admin extends Person {

  protected $id;

  protected $table = 'admins';

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
