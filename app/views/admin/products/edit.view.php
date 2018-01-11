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
                        Edit Products
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <!-- PAGE CONTENT BEGINS -->
                        <form  action="/admin/products/edit" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $product[0]->id; ?>" name="id">
                            <div class="form-group">
                                <label for="form-field-select-3" style="font-weight:bold;">Product Info :</label>
                                <br />
                                <select class="chosen-select form-control" name="product_info_id_edit" id="product_info_id" data-placeholder="Choose a State...">
                                    <option value="0">Choose Product Info</option>
                                    <?php 
                                        foreach ($product_info as $key => $item){
                                            $id=$item->id;
                                            $name=$item->name;
                                            if($product[0]->product_info_id==$id){
                                                $selected="selected";
                                            }else{
                                                $selected="";
                                            }                                           
                                    ?>
                                    <option <?php echo $selected; ?> value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                    <?php } ?>  
                                </select>
                                <div id="product_info_id_warning_msg" style="margin-top: 10px;">           
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="form-field-select-3" style="font-weight:bold;">Color :</label>
                                <br />
                                <select class="chosen-select form-control" name="product_color"  name="" id="products_color" data-placeholder="Choose a State...">
                                    <option value="0">-----Choose Color-----</option>
                                    <?php foreach ($colors as $key => $item) {
                                        $id=$item->id;
                                        $name=$item->name;
                                        if($product[0]->color_id==$id){
                                            $selected="selected";
                                        }else{
                                            $selected="";
                                        }     
                                    ?>    
                                    <option  <?php echo $selected; ?> value="<?php echo $id; ?>"><?php echo $name; ?></option> 
                                    <?php } ?>    
                              
                                </select>
                                <div id="products_color_warning_msg" style="margin-top: 10px;">           
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-field-select-3" style="font-weight:bold;">Size :</label>
                                <br />
                                <select class="chosen-select form-control" name="product_size"  name="" id="products_size" >
                                    <option value="0">-----Choose Size-----</option>
                                    <?php foreach ($size as $key => $item) {
                                        $id=$item->id;
                                        $size=$item->size;
                                        if($product[0]->size_id==$id){
                                            $selected="selected";
                                        }else{
                                            $selected="";
                                        }
                        
                                    ?>    
                                    <option <?php echo $selected; ?>  value="<?php echo $id; ?>"><?php echo $size; ?></option> 
                                    <?php } ?>    
                              
                                </select>
                                <div id="products_size_warning_msg" style="margin-top: 10px;">           
                                </div>
                            </div>

                            <div class="form-group">
                                <label style="font-weight:bold;" for="pwd">Quantity :</label>
                                <input type="text" name="quantity" id="quantity" class="form-control" value="<?php echo $product[0]->quantity; ?>">
                                <div id="products_quantity_warning_msg" style="margin-top: 10px;">           
                                </div>
                            </div>            
                            <div class="form-group text-center">
                                <button type="submit" name="submit"  disabled id="products_submit"  class="btn btn-success">Edit</button>
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