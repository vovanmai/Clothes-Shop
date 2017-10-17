<?php 
    require dirname(__DIR__).'/require/header.view.php';
?>

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.loadState('main-container')
        } catch (e) {}
    </script>
    <?php 
        require dirname(__DIR__).'/require/leftbar.view.php';
    ?>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>
                    <li class="active">Dashboard</li>
                </ul>
                <!-- /.breadcrumb -->


            </div>

            <div class="page-content">
                <?php 
                    require dirname(__DIR__).'/require/rightbar.view.php';
                ?> 

                <div class="page-header">
                    <h1 style="font-weight: bold">
                        Edit Users
                        
                    </h1>
                </div>
               

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <!-- PAGE CONTENT BEGINS -->
                        <form action="/admin/users/edit/<?php echo $auser[0]->id; ?>" id="form_edit" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $auser[0]->id; ?>" class="form-control" placeholder="Enter username" name="id" id="edit_id">

                            <div class="form-group">
                                <label style="font-weight:bold;">Username: </label>
                                <input type="text" disabled value="<?php echo $auser[0]->username; ?>" class="form-control" placeholder="Enter username" name="username">
                                
                            </div>

                            <div class="form-group">
                                <label style="font-weight:bold;">New Password:</label>
                                <input type="password" id="edit_password" value="" class="form-control" placeholder="Enter new password" name="password">
                                <div id="password_warning_msg" style="margin-top: 10px;">           
                                </div>
                            </div>

                            <div class="form-group">
                                <label style="font-weight:bold;" for="pwd">Fullname:</label>
                                <input type="text" id="edit_fullname" value="<?php echo $auser[0]->fullname; ?>" class="form-control" placeholder="Enter fullname" name="fullname">
                                <div id="fullname_warning_msg" style="margin-top: 10px;">           
                                </div>
                            </div>

                            <div class="form-group">
                                <label style="font-weight:bold;" for="pwd">Email:</label>
                                <input type="text" id="edit_email" value="<?php echo $auser[0]->email; ?>" class="form-control" placeholder="Enter email" name="email">
                                <div id="email_warning_msg" style="margin-top: 10px;">           
                                </div>
                            </div>

                            <div class="form-group">
                                <label style="font-weight:bold;">Phone:</label>
                                <input type="text" id="edit_phone" value="<?php echo $auser[0]->phone; ?>" class="form-control" placeholder="Enter phone" name="phone">
                                <div id="phone_warning_msg" style="margin-top: 10px;">           
                                </div>
                            </div>

                            <div class="form-group">
                                <label style="font-weight:bold;">Address:</label>
                                <input type="text" id="edit_address" value="<?php echo $auser[0]->address; ?>" class="form-control" placeholder="Enter address" name="address">
                                <div id="address_warning_msg" style="margin-top: 10px;">           
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label style="font-weight:bold;">Level:</label>
                                <div>
                                    <select name="level" class="selectpicker">
                                        <option value="2" >Employee</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label style="font-weight:bold;" for="pwd">Old Avatar:</label>
                                <div>
                                    <img class="avatar-edit" src="/public/upload/avatar/<?php echo $auser[0]->avatar; ?>" alt="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="font-weight:bold;" for="pwd">Avatar:</label>
                                <input type="file" name="avatar">
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" name="submit" disabled id="edit-submit" class="btn btn-success">Edit</button>
                            </div>
                        </form>
                        <!-- PAGE CONTENT ENDS -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.page-content -->
        </div>
    </div>
    <!-- /.main-content -->

    <?php 
    require dirname(__DIR__).'/require/footer.view.php';
?>