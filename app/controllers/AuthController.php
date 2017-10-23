<?php
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Users;
use  core\PHPMailer\PHPMailer;
use core\PHPMailer\Exception;
use core\PHPMailer\SMTP;
require dirname(__DIR__).'/../core/PHPMailer/PHPMailerAutoload.php';
class AuthController
{
    public function getLogin()
    {
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
    $userName = trim($_POST['txtName']);
    $password = trim($_POST['password']);
    if ($userName == '' || $password == '') {
      return redirect('admin/login?msg=0');
    } else {
      $user = Users::checkLogin($userName,$password);
      if ($user == null) {
        return redirect('admin/login?msg=1');
      } else {
        if (isset($_POST['cbRemember'])) {
          if (!isset($_COOKIE['"'.$userName.'"'])) {   
            setcookie('"'.$userName.'"',"$password", time() + 300);                            
          }
        }else{
          if (isset($_COOKIE['"'.$userName.'"'])) {   
            setcookie('"'.$userName.'"',"$password", time() -3300);                         
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
         // die(json_encode($value));
        echo json_encode($value);
        die();
    }
    //getPassword

     public function getMail()
    {
        
        return view('admin/auth/mail');
    }

    public function getCheck()
    {
        
        return view('admin/auth/check');
    }

     public function getNewPass()
    {
        
        return view('admin/auth/newPass');
    }

    public function postNewPass()
    {
         if ( Session::getSession('confirm') !=null ) {
             if (isset($_POST['smGetPass'])) {
                
                $newPass = trim($_POST['newpass']);
                 $passwordAgain = trim($_POST['passwordAgain']);

                 //bieu thuc chinh quy
                $pattern = ' /^[a-zA-Z0-9@_]{6,}$/';
                if (!preg_match($pattern, $newPass,$match) || !preg_match($pattern, $passwordAgain,$match)){
                     return redirect('admin/newpass?msg=0');
                     die();
                } 

                //chua nhan code
                if ( Session::getSession('rand') ==null ) {

                    return redirect('admin/newpass?msg=1');
                    die();
                } else {
                                     
                    if ( $newPass !=  $passwordAgain ) {

                        return redirect('admin/newpass?msg=2');
                         die();

                    } else {
                        //Thong tin nguoi get Pass
                        $currentUser = Session::getSession('forgetPass');

                       $id = $currentUser[0]->id;
                       Users::getPass($id,$newPass);
                       Session::unsetSession('confirm');
                        return redirect('admin/login');
                        die();
                        
                    }
                }
            }
        } else {
             return redirect('admin/mail');
             die();

        }
    }

    public function postCheck()
    {   

        if (isset($_POST['smCode'])) {
             
            $enterCode = trim($_POST['code']);
            

            if ( $enterCode == '') {
                return redirect('admin/check?msg=0');
                die();
            }

            //chua nhan code
            if ( Session::getSession('rand') == '' ) {
                
                return redirect('admin/check?msg=1');
                die();
            } else {

                $rand = Session::getSession('rand'); 

                if ( $enterCode != $rand ) {

                    return redirect('admin/check?msg=2');
                    die();
                } else {
                     Session::createSession('confirm','123');
                     return redirect('admin/newPass');
                    
                }
            }
        }
        
        
    }


     public function postMail()
    {
        if (isset($_POST['smGetPass'])) {
            $email = $_POST['email'];
            
            if ($email == '') {
                return redirect('admin/mail?msg=0');
                die();
            } else {
                $query = Users::checkEmail($email);

                if ($query == null) {
                    return redirect('admin/mail?msg=1');
                    die();
                } else {
                    $rand =rand(999,10000);

                    Session::createSession('rand',$rand);
                    Session::createSession('forgetPass',$query);
                  
                    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                    try {
                        //Server settings

                        $mail->IsSMTP();
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = "ssl";
                        $mail->Username = "cuoirongngaodu38@gmail.com";
                        $mail->Password = "phamdinhhung03072311";
                        $mail->Port = "465";
                        $mail->isHTML(true);
                        $mail->setFrom('cuoirongngaodu38@gmail.com', 'Mailer');
                        $mail->addAddress($email, 'Shop'); 
                        $mail->Subject = '<b> Get Password </b>';
                        $mail->Body    = 'Mã xác nhận  tài khoản của bạn là :   <b> '.$rand.'</b>';

                        $mail->send();
                        return redirect('admin/check');
                        die();
                    } catch (Exception $e) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }
                }
            }
        }
    }
}

?>