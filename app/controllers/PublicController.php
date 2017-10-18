<?php
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Products_info;
use app\models\Sizes;
use app\models\Category;
use core\Pagination;


class PublicController
{
	public function index(){
		$product_infos = Products_info::allLimit(12);
		$cats = Category::all();
		$sizes = Sizes::all();
		$hot_product = Products_info::getHotProduct();
		return view('public/index',['product_infos' => $product_infos,
		'cats' => $cats, 'sizes' => $sizes, 
		'hot_product' => $hot_product ]); 
	}
	public function detail() {
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
			echo $id;
			$product_info = Products_info::find("id",$id)[0];
			$id_product = Products_info::getID_Product($id)[0]->id;
			$sizes = Products_info::getSizes($id);
			return view('public/detail',['product_info' => $product_info,
			  'id_product' => $id_product, 'sizes' => $sizes]);
		}
	}
	public function getProductInfoByGender(){
        $string_gender=trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/');
        if($string_gender=='men'){
            $id=1;
        }else{
            $id=0;
        }
    	$gender_products_info=Category::getProductInfoByGender($id);
        $hot_product=Products_info::getHotProduct();
    	return view('public/gender_product_info',['gender_products_info'=>$gender_products_info,'hot_product'=>$hot_product]);
    }
}
?>