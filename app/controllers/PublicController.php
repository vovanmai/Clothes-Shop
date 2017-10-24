<?php
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Products_info;
use app\models\Products;
use app\models\Users;
use app\models\Sizes;
use app\models\Category;
use core\Pagination;


class PublicController
{   
    public function addRegister()
    {
        $username=$_POST['username'];
        $fullname=$_POST['fullname'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $gender=$_POST['gender'];    
        
        $paremeters = array(
            'username' => $username, 
            'fullname' => $fullname, 
            'email' => $email, 
            'password' => md5($password), 
            'gender' => $gender,
            'level' => 3
            );
        if(Users::insert($paremeters)){
            echo 1;
        }

    }
    public function postLogin()
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $user=Users::checkPublicLogin($username,$password);
        if($user!=null){
            $_SESSION['login'] =$user[0];
            echo 1;
        }else{
            echo 2;
        }

    }
    public function postLogout()
    {
        if(isset($_SESSION['login'])){
            unset($_SESSION['login']);
        }
        return redirect('');

    }
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
	

	public function detail($product_info_id)
   	{   
        $color = Products::getColor($product_info_id);
        $size = Products::getSize($product_info_id);
        $productInfo = Products_info::find('id',$product_info_id);
        $gender_men_cats=Category::find('gender',1);
        $gender_women_cats=Category::find('gender',0);
        return view('public/detail',['size' =>$size,'color'=>$color,'productInfo'=>$productInfo,'gender_men_cats'=>$gender_men_cats,'gender_women_cats'=>$gender_women_cats]);
	}

    public function PlusNumber()
    {
        $currentNumber = isset($_POST['aNumber']) ? $_POST['aNumber'] : ' ' ;
        $newNumber = 1+$currentNumber;
        echo  '<input class="num" type="text" value="'.$newNumber.'" id="num" disabled >' ;
    }

    public function SubNumber()
    {
        $currentNumber = isset($_POST['aNumber']) ? $_POST['aNumber'] : ' ' ;
        $newNumber = $currentNumber-1;
        echo  '<input class="num" type="text" value="'.$newNumber.'" id="num" disabled >' ;
                
    }

    public function cart()
    {   
        $nameCart = Products::getRealIPAddress();
        $arrStore= array();
        $arrStore1= array();
        $gender_men_cats=Category::find('gender',1);
        $gender_women_cats=Category::find('gender',0);
        if ( Session::getSession($nameCart) !=null) {
	        foreach (Session::getSession($nameCart) as $key => $value) {
	           $arrStore[$key]= Products::getAllCart($key);
	            foreach ($arrStore[$key] as $k => $val) {
	                $arrStore1[$key] = $val;                          
	            }
	        }
            return view('public/cart',['arrStore'=>$arrStore1,'nameCart'=>$nameCart,'gender_men_cats'=>$gender_men_cats,'gender_women_cats'=>$gender_women_cats]);

        }else{
            return view('public/cart',['gender_men_cats'=>$gender_men_cats,'gender_women_cats'=>$gender_women_cats]);
        }
    }

    public function cat($id)
    {
    	$products_info=Products_info::getProductInfoByCat($id);
    	$gender_men_cats=Category::find('gender',1);
		$gender_women_cats=Category::find('gender',0);
		$hot_product = Products_info::getHotProduct();
		$cat=Category::find('id',$id);
    	return view('public/index',['products_info'=>$products_info,'gender_men_cats'=>$gender_men_cats,'gender_women_cats'=>$gender_women_cats,'cat'=>$cat,'hot_product'=>$hot_product]);
    }

    public function delete($id)
    {   
		$num=0;
		$nameCart = Products::getRealIPAddress();
		$arr = Session::getSession($nameCart);
		if ( Session::getSession($nameCart)[$id] !=null) {
		    foreach (Session::getSession($nameCart) as $key => $value) {
		        if($id == $key) {
		            unset( $arr[$id]);
		        }
		    }
		    Session::createSession($nameCart,$arr);
		    foreach ( Session::getSession($nameCart) as $key => $value) {
		        $num +=$value;
		    }
		    Session::createSession('num',$num);
		    redirect('cart');
		}
    }


    public function addCart()
    {
        $check = 0;
        $size = isset($_POST['aSize']) ? $_POST['aSize'] : 0 ;
        $color = isset($_POST['aColor']) ? $_POST['aColor'] : 0 ;
        $products_info_id = isset($_POST['aProduct_info_id']) ? $_POST['aProduct_info_id'] : 0 ;
        $num = isset($_POST['aNum']) ? $_POST['aNum'] : 0 ;
        $products = Products::getProduct($products_info_id,$size,$color);
        if (empty($products)) {
            die(json_encode($check));
        }else{
            $arr = array();
            $nameCart = Products::getRealIPAddress();
            if( Session::getSession($nameCart) ==null) {
                if($products[0]->quantity<$num) {
	                $arr["check"] =2;
	                $arr["quantity"] =$products[0]->quantity;
	                die(json_encode($arr));
                }else{
                    $_SESSION[$nameCart] =array($products[0]->id =>$num);
                    $arr["quantity"] =$num;
                    $arr["check"] =1;
                    Session::createSession('num',$num);
                    die(json_encode($arr));
                }
            }else{
                $cart=Session::getSession($nameCart);
                $checkID = false;  //kiem tra id da co chua
                $coutCart =0;
                $id =$products[0]->id;
                foreach ($_SESSION[$nameCart] as $key => $value) {
                    if($key == $id) {
                        $checkID = true;
                    }
                }

                if ($checkID) {
                    $currentNum =Session::getSession($nameCart)[$id];
                    $newNum = $currentNum + $num;
                    if ($products[0]->quantity < $newNum ) {
                       $arr["check"] =2;
                       $order=$products[0]->quantity-$currentNum;
                       $arr["quantity"] =$order;
                       die(json_encode($arr));
                    }else{
                        $cart[$id] = $newNum;
                        Session::createSession($nameCart,$cart);
                    }
                }else{
                    if ($products[0]->quantity < $num) {
                        $arr["check"] =2;
                        $arr["quantity"] =$products[0]->quantity;
                        die(json_encode($arr));
                    }else{
                        $cart[$id]=$num;
                        Session::createSession($nameCart,$cart);
                    }
                }

	            foreach($cart as $key => $value){
	                $coutCart += $value;
	            }
                Session::createSession('num',$coutCart);
                $arr["check"] =1;
                $arr["quantity"] =$coutCart;
                die(json_encode($arr));

            }
            
        }
        
      
    }
       public function getProductInfoByGender(){
            $string_gender=trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/');
            if($string_gender=='men'){
                $id=1;
            }else{
                $id=0;
            }
            $products_info=Category::getProductInfoByGender($id);
            $hot_product=Products_info::getHotProduct();
            $gender_men_cats=Category::find('gender',1);
			$gender_women_cats=Category::find('gender',0);
        	return view('public/index',['products_info'=>$products_info,'hot_product'=>$hot_product,'gender_men_cats'=>$gender_men_cats,'gender_women_cats'=>$gender_women_cats]);
           }
      }

?>