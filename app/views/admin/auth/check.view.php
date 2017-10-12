<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Login Page - Ace Admin</title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="/public/admin/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/public/admin/assets/font-awesome/4.5.0/css/font-awesome.min.css" />
    <script src="/public/admin/assets/js/jquery-2.1.4.min.js"></script>
    <script src="/public/admin/assets/js/admin.js"></script>
   <script src="/public/admin/assets/js/boostrap_ajax.js"></script>
    <link rel="stylesheet" href="/public/admin/assets/css/fonts.googleapis.com.css" />
    <link rel="stylesheet" href="/public/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/public/admin/assets/css/ace-rtl.min.css" />

</head>

<body class="login-layout">
    <div class="main-container">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="login-container">
                        <div class="center">
                            <h1>
                                <i class="ace-icon fa fa-leaf green"></i>
                                <span class="red">Ace</span>
                                <span class="white" id="id-text2">Application</span>
                            </h1>
                            <h4 class="red" id="id-company-text">
                            <?php
                                if (isset($_GET['msg'])) {
                                    

                                    if ($_GET['msg']==0) {
                                        echo 'Vui lòng điền code đầy đủ  !' ;
                                    }

                                     if ($_GET['msg']==1) {
                                        echo 'Vui lòng nhận mã ở email của bạn   !' ;
                                    }

                                    if ($_GET['msg']==2) {
                                        echo 'Thông tin code không đúng  !' ;
                                    }
                                }
                            ?>
                            </h4>
                        </div>

                        <div class="space-6"></div>

                        <div class="position-relative">
                            <div id="login-box" class="login-box visible widget-box no-border">
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <h4 class="header blue lighter bigger">
                                            <i class="ace-icon fa fa-coffee green"></i> Please Enter Your Code
                                        </h4>

                                        <div class="space-6"></div>

                                        <form method="POST" action="/admin/check">
                                            <fieldset>
                                                <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control"  id='code' name = 'code' placeholder="Enter your code" required />
                                                            
                                                        </span>
                                                    </label>

                                                <div class="clearfix">
                                                    <button type="submit" class="width-35 pull-right btn btn-sm btn-danger" name='smCode' id='smCode'>
                                                            <i class="ace-icon fa fa-lightbulb-o"></i>
                                                            <span class="bigger-110">Check </span>
                                                        </button>
                                                </div>
                                            </fieldset>
                                        </form>

                                      
                                    </div>
                                    <!-- /.widget-main -->

                                    <div class="toolbar clearfix">
                                        <div>
                                            <a href="/admin/login"  class="forgot-password-link">
                                                    <i class="ace-icon fa fa-arrow-left"></i>
                                                    Back to Login
                                                </a>
                                        </div>

                                        
                                    </div>
                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.login-box -->

                           
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.forgot-box -->
                         </div>
                      
                        <div class="navbar-fixed-top align-right">
                            <br /> &nbsp;
                            <a id="btn-login-dark" href="#">Dark</a> &nbsp;
                            <span class="blue">/</span> &nbsp;
                            <a id="btn-login-blur" href="#">Blur</a> &nbsp;
                            <span class="blue">/</span> &nbsp;
                            <a id="btn-login-light" href="#">Light</a> &nbsp; &nbsp; &nbsp;
                        </div>
                    </div>
                </div>
                
            </div>
           
        </div>
    
    </div>
</body>

</html>