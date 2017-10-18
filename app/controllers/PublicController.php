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
		$link_full='?p={page}';
		$limit = 12;
		$count=Products_info::count();
		$current_page = isset($_GET['p']) ? $_GET['p'] : 1;
		$paging = new Pagination();
		$paging->init($current_page, $limit, $link_full, $count[0]->total_record);
		$products_info=Products_info::allPagination($current_page,$limit);
		$cats = Category::all();
		$sizes = Sizes::all();
		$hot_product = Products_info::getHotProduct();
		$gender_men_cats=Category::find('gender',1);
		$gender_women_cats=Category::find('gender',0);
		return view('public/index',['products_info' => $products_info,
		'cats' => $cats, 'sizes' => $sizes, 
		'hot_product' => $hot_product,'gender_men_cats'=>$gender_men_cats,'gender_women_cats'=>$gender_women_cats,'paginghtml'=>$paging->html()]); 
	}
	public function detail() {
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
			$product_info = Products_info::find("id",$id)[0];
			$sizes = Products_info::getSizes($id);
			$colors = Products_info::getColors($id);
			return view('public/detail',['product_info' => $product_info, 'sizes' => $sizes,'colors'=>$colors]);
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
        $gender_men_cats=Category::find('gender',1);
		$gender_women_cats=Category::find('gender',0);
    	return view('public/gender_product_info',['gender_products_info'=>$gender_products_info,'hot_product'=>$hot_product,'gender_men_cats'=>$gender_men_cats,'gender_women_cats'=>$gender_women_cats]);
    }
    public function cat($id)
    {
    	$cat_products_info=Products_info::getProductInfoByCat($id);
    	$gender_men_cats=Category::find('gender',1);
		$gender_women_cats=Category::find('gender',0);
		$hot_product = Products_info::getHotProduct();
		$cat=Category::find('id',$id);
    	return view('public/cat',['cat_products_info'=>$cat_products_info,'gender_men_cats'=>$gender_men_cats,'gender_women_cats'=>$gender_women_cats,'cat'=>$cat,'hot_product'=>$hot_product]);
    }
}
?>