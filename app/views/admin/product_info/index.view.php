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
                    <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="/admin/product_info/add" style="margin-bottom: 10px;" class="btn btn-success fa fa-plus-square fa-lg" title=""> Add Product</a>
                                <?php 
                                    if(isset($_SESSION['msg'])){
                                ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>
                                        <?php 
                                            echo $_SESSION['msg']; 
                                            unset($_SESSION['msg']);
                                        ?>        
                                    </strong> 
                                </div>
                                <?php } ?>
                                <table id="simple-table" class="table  table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                Id
                                            </th>
                                            <th class="text-center">
                                                Image
                                            </th>
                                            <th class="text-center">
                                                Name
                                            </th>
                                            <th class="text-center">
                                                Category
                                            </th>
                                            <th class="text-center">
                                                Description
                                            </th>
                                            <th class="text-center">
                                                Price
                                            </th>
                                            <th class="text-center">
                                                Active
                                            </th>
                                            <th class="text-center">
                                                Action
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($products_info as $item) {
                                                $id=$item->id;
                                                $image=$item->image;
                                                $name=$item->name;
                                                $cat_id=$item->cat_id;
                                                $preview_text=$item->preview_text;
                                                $price=$item->price;
                                                $active=$item->active;
                                        ?>    
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $id; ?>
                                            </td>
                                            <td class="text-center">
                                              <img class="avatar-index" src="/public/upload/product_info/<?php echo $image; ?>" alt="">
                                            </td>
                                            <td class="text-center">
                                                <?php echo $name; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    foreach ($cats as $value) {
                                                        if($value->id==$cat_id){
                                                            echo $value->name;
                                                            break;
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $preview_text; ?>
                                            </td>

                                            <td class="text-center">
                                                <?php echo number_format ($price).' VNĐ'; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)"  class="product_info_active" id="<?php echo $id; ?>">
                                                    <img src="/public/admin/assets/images/<?php 
                                                    if($active==1){
                                                    echo "active.gif";
                                                    }else{
                                                    echo "deactive.gif";
                                                    }
                                                    ?>" alt="">
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <a class="btn btn-xs btn-info" href="/admin/product_info/edit?id=<?php echo $id; ?>">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </a>
                        
                                                    <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete ? ');" href="/admin/product_info/delete?id=<?php echo $id; ?>">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </a>
                                                       
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                </table>
                            </div>
                        </div><!-- /.row -->

                        <div class="row text-center" id="paging">
                            <?php 
                              echo $paginghtml;
                            ?>
                        </div>
                    </div>
                  <!-- PAGE CONTENT ENDS -->
                    
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div>
        </div><!-- /.main-content -->
    </div>
</div>
<?php 
require dirname(__DIR__).'/require/footer.view.php';
?>