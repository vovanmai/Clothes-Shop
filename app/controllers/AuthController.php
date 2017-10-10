<?php
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Users;

class AuthController
{
    public function getLogin()
    {
        session_start();
        if ( Session::getSession('user') !=null) {
            return redirect('admin/users');
            die();
        }
        return view('admin/auth/login');
    }

    public function getLogout()
    {
        Session::unsetSession('user');
        return redirect('admin/login');

    }

    public function postLogin()
    {
        $userName = str_replace(" ","", $_POST['txtName']);
        $password =  str_replace(" ","", $_POST['password']);

        if ($userName == '' || $password == '') {
            return redirect('admin/login?msg=1');
            die();
        } else {
                $user = Users::checkLogin($userName,$password);

                if ($user == null) {

                     return redirect('admin/login?msg=2');
                    die();
                } else {

                    if (isset($_POST['cbRemember'])) {

                        if (!isset($_COOKIE['"'.$userName.'"'])) {   

                            setcookie('"'.$userName.'"',"$password", time() + 300); 
                                      
                        }
                    }             
                   Session::createSession('user',$user);
                   return redirect('admin/users');
                }
         }
    }

    public function ajaxRemember()
    {
        $user = isset($_POST['aName']) ? $_POST['aName'] : ' ' ;
        $value = array(
            "password" =>'',
        );
        
        if (isset($_COOKIE['"'.$user.'"']) ) {

            $value['password']=$_COOKIE['"'.$user.'"'];
        } 
         die(json_encode($value));
    }
}

?>