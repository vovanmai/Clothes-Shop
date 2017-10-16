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
                        Products Info
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <!-- PAGE CONTENT BEGINS -->
                        <form  action="/admin/product_info/add" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label style="font-weight:bold;">Name: </label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                                <div id="name_warning_msg" style="margin-top: 10px;">           
                                </div>  
                            </div>

                            <div class="form-group">
                                <label for="form-field-select-3" style="font-weight:bold;">Category :</label>
                                <br />
                                <select class="chosen-select form-control" name="categoy" id="form-field-select-3" data-placeholder="Choose a State...">
                                    <option value="">Choose Category</option>
                                    <?php 
                                        foreach ($cat as $key => $item){
                                            $id=$item->id;
                                            $name=$item->name;
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                    <?php } ?>  
                            </select>
                            </div>
                            <div class="form-group">
                                <label style="font-weight:bold;" for="pwd">Image:</label>
                                <input type="file" name="image">
                            </div>
                            <div class="form-group">
                                <label style="font-weight:bold;" for="pwd">Price:</label>
                                <input type="text" name="price" class="form-control" placeholder="Enter price" name="email">
                                <div id="price_warning_msg" style="margin-top: 10px;">          
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="font-weight:bold;" for="pwd">Description:</label>
                                <div>
                                    <textarea name="description" class="description"></textarea>
                                </div>
                                <div id="description_warning_msg" style="margin-top: 10px;">           
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="font-weight:bold;" for="">Detail:</label>
                                <div>
                                    <textarea name="detail" class="ckeditor"></textarea>
                                </div>
                                <div id="detail_warning_msg" style="margin-top: 10px;">           
                                </div>
                            </div>
                            
                            <div class="form-group text-center">
                                <button type="submit" name="submit"  id="add-submit"  class="btn btn-success">Add</button>
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