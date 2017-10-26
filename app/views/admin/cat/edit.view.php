<?php

require dirname(__DIR__).'/require/header.view.php';
?>

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
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
                        <a href="">Home</a>
                    </li>
                    <li class="active">Dashboard</li>
                </ul><!-- /.breadcrumb -->

            </div>

            <div class="page-content">
                <div class="ace-settings-container" id="ace-settings-container">
                    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                        <i class="ace-icon fa fa-cog bigger-130"></i>
                    </div>

                    <div class="ace-settings-box clearfix" id="ace-settings-box">
                        <div class="pull-left width-50">
                            <div class="ace-settings-item">
                                <div class="pull-left">
                                    <select id="skin-colorpicker" class="hide">
                                        <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                    </select>
                                </div>
                                <span>&nbsp; Choose Skin</span>
                            </div>

              

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
                                <label class="lbl" for="ace-settings-add-container">
                                Inside
                                <b>.container</b>
                                </label>
                            </div>
                        </div><!-- /.pull-left -->

                        <div class="pull-left width-50">
                          
                            <div class="ace-settings-item">
                                <div class="pull-left">
                                    <select id="skin-colorpicker" class="hide">
                                        <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                    </select>
                                </div>
                                <span>&nbsp; Choose Skin</span>
                            </div>
                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
                                <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
                                <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                            </div>
                        </div><!-- /.pull-left -->
                    </div><!-- /.ace-settings-box -->
                </div><!-- /.ace-settings-container -->

                <div class="page-header">
                    <h1 style="font-weight: bold">
                        Edit Category
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <!-- PAGE CONTENT BEGINS -->
                        <form  action="/admin/cat/edit/<?php echo $arrCat[0]->id;?>" method="post" enctype="multipart/form-data">
                            <?php 
                                    if(isset($_SESSION['msg'])){
                                ?>
                                <div style="margin-bottom: 10px; margin-top: 10px;">
                                    <span style="color:red;font-weight:bold;">
                                    <?php 
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);
                                     ?></span>
                                </div>
                                <?php } ?>

                            <div class="form-group">
                                <label style="font-weight:bold;" for="pwd">Name :</label>
                                <input type="text" name="cat_name" value="<?php echo $arrCat[0]->name;?>"  class="form-control" >
                               
                            </div> 
                            <div class="form-group">
                                
                                <label for="form-field-select-3" style="font-weight:bold;">Gender: </label>
                                <br />
                                <select class="chosen-select form-control" name="cat_gender"  data-placeholder="Choose a State...">

                                    <option <?php if($arrCat[0]->gender==1){ echo 'selected="selected"';}?> value="1">Male</option>
                                    <option <?php if($arrCat[0]->gender==0){ echo 'selected="selected"';}?> value="0">Female</option>
                                </select>
                                
                            </div>
                                       
                            <div class="form-group text-center">
                                <button type="submit" name="submit"  class="btn btn-success">Edit</button>
                            </div>
                        </form>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.main-content -->
    </div>
</div>
<?php 
require dirname(__DIR__).'/require/footer.view.php';
?>