<?php

namespace App\Models;

class Shop {

  private $id;
  public $name;
  public $productcount;
  private $products = [];
  private $ownerId;


  function __construct($name){
    $this->name = $name;

  }


}


?>
