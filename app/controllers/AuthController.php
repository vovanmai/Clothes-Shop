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
        Session::createSession('msg',"Please do not empty");
        return redirect('admin/login');
        die();   
    } else {
      $user = Users::checkLogin($userName,$password);
      if ($user == null) {
        Session::createSession('msg',"Account do not valid");
        return redirect('admin/login');
        die();
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
  

    public function remember()
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
                     Session::createSession('msg',"Password do not valid");
                     return redirect('admin/newpass');
                     die();
                } 

                //chua nhan code
                if ( Session::getSession('rand') ==null ) {
                    Session::createSession('msg',"Please receive the code in Email");
                     return redirect('admin/newpass');
                     die();
                } else {
                                     
                    if ( $newPass !=  $passwordAgain ) {
                       Session::createSession('msg',"Password do not match");
                       return redirect('admin/newpass');
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
                Session::createSession('msg',"Code do not empty");
                return redirect('admin/check');
                die();
            }

            //chua nhan code
            if ( Session::getSession('rand') == '' ) {
                Session::createSession('msg',"Please receive the code in Email");
                return redirect('admin/check');
                die();
            } else {

                $rand = Session::getSession('rand'); 

                if ( $enterCode != $rand ) {
                    Session::createSession('msg',"Code do not match");
                    return redirect('admin/check');
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
                Session::createSession('msg',"Email do not empty");
                return redirect('admin/mail');
                die();
            } else {
                $query = Users::checkEmail($email);

                if ($query == null) {
                     Session::createSession('msg',"Email do not valid");
                     return redirect('admin/mail');
                     die();
                } else {
                    $rand =rand(999,10000);

                    Session::createSession('rand',$rand);
                    Session::createSession('forgetPass',$query);
                    $this->sendMail($email,'Get Password', 'Mã xác nhận  tài khoản của bạn là :   <b> '.$rand.'</b>');
                    /*
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
                    */
                }
            }
        }
    }

    public function sendMail($email,$subject, $body)
    {
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
            $mail->setFrom('cuoirongngaodu38@gmail.com', 'Shop');
            $mail->addAddress($email, 'Shop'); 
            $mail->Subject =  $subject;      // '<b> Get Password </b>';
            $mail->Body    =   $body;     // 'Mã xác nhận  tài khoản của bạn là :   <b> '.$rand.'</b>';

            $mail->send();
            return redirect('admin/check');
            die();
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}

?>