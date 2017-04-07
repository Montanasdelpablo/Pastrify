<?php

namespace App\Controllers;

use App\Models\Person;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class BackController extends Controller {


  public function index($request, $response){


    if (isset($_SESSION['admin_id'])){

      $users = $this->db->table('users')->get();
      $users = json_decode(json_encode($users), True);

      $admins = $this->db->table('admins')->get();
      $admins = json_decode(json_encode($admins), True);

      $users = array_merge($users, $admins);

      $products = $this->db->table('pastries')->get();
      $products = json_decode(json_encode($products), True);

      $templates = $this->db->table('templates')->get();
      $templates = json_decode(json_encode($templates), True);

      return $this->view->render($response, 'admin/index.html', [
          'users' => $users,
          'products' => $products,
          'templates' => $templates
      ]);
    } return $this->view->render($response, 'admin/login.html', [
          'errors' => [],
    ]);
  }

  public function indexPost($request, $response){
    // Set to empty array
    $errors = [];

    // Fetch body from reqest
    $data = $request->getParsedBody();

    // Grab required values
    $username = $data['username'];;
    $password = $data['password'];

    // Validation
    if (!empty($username) && !empty($password)){
      // Check to see if there is corresponding details
      $arr = ['username' => strtolower($username), 'password' => $password];
      $if = $this->db->table('admins')->where($arr)->first();
      if (!empty($if)){
        $user = new Admin($username, $password);
        $arr = ['username' => $username, 'password' => $password];
        $arr2 = $this->db->table('admins')->where($arr)->first();
        $user->setId($arr2->id);
        $_SESSION['admin_id'] = $arr2->id;
      } else {
        $errors['fields'] = "Incorrect credentials.";
      }

    } else {
      // Required fields not filled in
      $errors['fields'] = "Not all required fields are entered.";
    }

    if (empty($errors)){
      $users = $this->db->table('users')->get();
      $users = json_decode(json_encode($users), True);

      $admins = $this->db->table('admins')->get();
      $admins = json_decode(json_encode($admins), True);

      $users = array_merge($users, $admins);

      $products = $this->db->table('pastries')->get();
      $products = json_decode(json_encode($products), True);

      $templates = $this->db->table('templates')->get();
      $templates = json_decode(json_encode($templates), True);

      return $this->view->render($response, 'admin/index.html', [
          'users' => $users,
          'products' => $products,
          'templates' => $templates
      ]);
    } else {
      return $this->view->render($response, 'admin/login.html', [
          'user' => $user,
          'errors' => $errors,
      ]);
    }



  }

  public function login($request, $response){
    if (isset($_SESSION['admin_id'])){
      $users = $this->db->table('users')->get();
      $users = json_decode(json_encode($users), True);

      $admins = $this->db->table('admins')->get();
      $admins = json_decode(json_encode($admins), True);

      $users = array_merge($users, $admins);

      $products = $this->db->table('pastries')->get();
      $products = json_decode(json_encode($products), True);

      $templates = $this->db->table('templates')->get();
      $templates = json_decode(json_encode($templates), True);

      return $this->view->render($response, 'admin/index.html', [
          'users' => $users,
          'products' => $products,
          'templates' => $templates
      ]);
    } else {
      return $this->view->render($response, 'admin/login.html', [
            'errors' => [],
      ]);
    }

  }

  public function logout($request, $response){
    // Set empty array
    $errors = [];

    session_unset();
    session_destroy();
    // Return view
    return $this->view->render($response, 'admin/login.html', [
        'errors' => $errors,
    ]);
  }

  public function loginPost($request, $response){
    // Set to empty array
    $errors = [];

    // Fetch body from reqest
    $data = $request->getParsedBody();

    // Grab required values
    $username = $data['username'];;
    $password = $data['password'];

    // Validation
    if (!empty($username) && !empty($password)){
      // Check to see if there is corresponding details
      $arr = ['username' => strtolower($username), 'password' => $password];
      $if = $this->db->table('admins')->where($arr)->first();
      if (!empty($if)){
        $user = new Admin($username, $password);
        $arr = ['username' => $username, 'password' => $password];
        $arr2 = $this->db->table('admins')->where($arr)->first();
        $user->setId($arr2->id);
        $_SESSION['admin_id'] = $arr2->id;
      } else {
        $errors['fields'] = "Incorrect credentials.";
      }

    } else {
      // Required fields not filled in
      $errors['fields'] = "Not all required fields are entered.";
    }

    if (empty($errors)){
      return $this->view->render($response, 'admin/index.html', [
          'user' => $user,

      ]);
    } else {
      return $this->view->render($response, 'admin/login.html', [
          'user' => $user,
          'errors' => $errors,
      ]);
    }



  }




}

?>
