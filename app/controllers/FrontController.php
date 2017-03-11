<?php

namespace App\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller {


  public function index($request, $response){

    return $this->view->render($response, 'index.html', [
        'name' => '',
    ]);
  }

  public function whoAre($request, $response){
    return $this->view->render($response, 'who-are.html', [
        'name' => ''
    ]);
  }

  public function whatIs($request, $response){
    return $this->view->render($response, 'what-is.html', [
        'name' => ''
    ]);
  }

  public function explore($request, $response){
    return $this->view->render($response, 'explore.html', [
        'name' => ''
    ]);
  }

  public function register($request, $response){
    $errors = [];
    return $this->view->render($response, 'register.html', [
        'name' => '',
        'errors' => $errors,
    ]);
  }

  public function registerPost($request, $response){
    // Set to empty array
    $errors = [];

    // Fetch body from request
    $data = $request->getParsedBody();

    // Grab values
    $name = $data['name'];
    $email = $data['email'];
    $username = $data['username'];;
    $password = $data['password'];
    $password2 = $data['password2'];

    // Validation
    if (!empty($username) && !empty($password) && !empty($password2)){
      if ($password !== $password2) {
        // Not the same password entered
        $errors['password'] = "Not the same password entered!";
      } else {
        // Search for usernames
        $if_username = $this->db->table('users')->where('username', strtolower($username))->first();
        if(!empty($if_username)) {
          $errors['username'] = "Username taken already. Sorry :)";
        } else {
          // If username taken else success
          $user = new Person($username, $password, $name, $email);
          $arr = ['name' => $user->name, 'username' => $user->username,'password' => $user->returnPassword(),'email' => $user->email];
          $this->db->table('users')->insert($arr);
        }


      }
    } else {
      // Required fields are empty
      $errors['fields'] = "Not all required fields are entered.";
    }

    // Return view
    return $this->view->render($response, 'register.html', [
        'user' => $user,
        'errors' => $errors
    ]);
  }

  public function logout($request, $response){
    // Set empty array
    $errors = [];

    session_unset();
    session_destroy();
    // Return view
    return $this->view->render($response, 'index.html', [
        'errors' => $errors,
    ]);
  }

  public function login($request, $response){
    // Set empty array
    $errors = [];

    // Return view
    return $this->view->render($response, 'login.html', [
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
      $if = $this->db->table('users')->where($arr)->first();
      if (!empty($if)){
        $user = new User($username, $password);
        $arr = ['username' => $username, 'password' => $password];
        $arr2 = $this->db->table('users')->where($arr)->first();
        $user->setId($arr2->id);
        $_SESSION['id'] = $arr2->id;
      } else {
        $errors['fields'] = "Incorrect credentials.";
      }

    } else {
      // Required fields not filled in
      $errors['fields'] = "Not all required fields are entered.";
    }

    // Return view
    return $this->view->render($response, 'login.html', [
        'user' => $user,
        'errors' => $errors,
    ]);
  }

  public function dashboard($request, $response){
    if (!isset($_SESSION['id'])){
      return $this->view->render($response, 'index.html', [
          'user' => $user,
      ]);
    } else {
      // Grab user where user is session id
      $arr =  $this->db->table('users')->where(['id' => $_SESSION['id']])->first();
      $user = new User($arr->username, $arr->password);
      // Grab shops from db where user
      //$shops = Array();
      $shops = $this->db->table('shops')->where(['user_id' => $_SESSION['id']])->get();

      return $this->view->render($response, 'dashboard.html', [
          'user' => $user,
          'shops' => $shops
      ]);
    }

  }

  public function createShop($request, $response){
    if (!isset($_SESSION['id'])){
      return $this->view->render($response, 'index.html', []);
    } else {
      // Grab user where user is session id
      $arr =  $this->db->table('users')->where(['id' => $_SESSION['id']])->first();
      $user = new User($arr->username, $arr->password);
      $templates = $this->db->table('templates')->get();

      return $this->view->render($response, 'createShop.html', [
        'templates' => $templates,
        'user' => $user,
        ]);
    }

  }

  public function myOrders($request, $response){
    if (!isset($_SESSION['id'])){
      return $this->view->render($response, 'index.html', []);
    } else {
      $arr =  $this->db->table('users')->where(['id' => $_SESSION['id']])->first();
      $user = new User($arr->username, $arr->password);

      // Fetch orders here

      return $this->view->render($response, 'myOrders.html', [

        'user' => $user,
        ]);
    }

  }

  public function myShops($request, $response){
    if (!isset($_SESSION['id'])){
      return $this->view->render($response, 'index.html', []);
    } else {
      $arr =  $this->db->table('users')->where(['id' => $_SESSION['id']])->first();
      $user = new User($arr->username, $arr->password);

      $shops = $this->db->table('shops')->where(['user_id' => $_SESSION['id']])->get();

      return $this->view->render($response, 'myShops.html', [
        'user' => $user,
        'shops' => $shops,
        ]);
    }

  }


}

?>
