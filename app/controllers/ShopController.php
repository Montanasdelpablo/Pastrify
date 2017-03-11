<?php



namespace App\Controllers;

//use App\Models\Person;
//use App\Models\User;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller {


  public function index($request, $response, $args){
    $obj = $this->db->table('shops')->where(['id' => $args['id']])->first();

    $shop = ['id' => $args['id'],'user_id' => $obj->user_id, 'description' => $obj->description, 'products' => $obj->products, 'template_id' => '1', 'name' => $obj->name, 'social' => $obj->social];
    
    return $this->view->render($response, 'shop.html', [
      'shop' => $shop,
    ]);
  }


}

?>
