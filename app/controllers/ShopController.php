<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Sizes;
use app\models\Category;
use app\models\Products_info;
use core\Pagination;

class ShopController
{
    public function index(){
    	return view('public/index');
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
        // echo "<pre>";
        // print_r($hot_product);
        // echo "</pre>";
    	return view('public/gender_product_info',['gender_products_info'=>$gender_products_info,'hot_product'=>$hot_product]);
    }

}
?>
