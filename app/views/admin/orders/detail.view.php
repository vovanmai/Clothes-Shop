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
            Detail orders
          </h1>
        </div><!-- /.page-header -->

        <div class="row">
          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
              <div class="col-xs-12">
                <table id="simple-table" class="table  table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">
                        Id
                      </th>
                      <th class="text-center">
                        Product
                      </th>
                      <th class="text-center">
                        Color
                      </th>
                      <th class="text-center">
                        Size
                      </th>
                      <th class="text-center">
                        Price
                      </th>
                      <th class="text-center">
                        Quantity
                      </th>
                      <th class="text-center">
                        Sum
                      </th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php 
                    if(!empty($order_details))
                    { 
                      $total=0;
                      $id=0;
                      foreach($order_details as $item){
                        $id++;
                        $product=$item->name_product;
                        $color=$item->name_color;
                        $size=$item->name_size;
                        $price=$item->price;
                        $quantity=$item->quantity_product;
                        $sum=$price*$quantity;
                        $total+=$sum;
                        ?>
                        <tr>
                          <td class="text-center">
                            <?php echo $id;?>
                          </td>
                          <td class="text-center">
                            <?php echo $product;?>
                          </td>
                          <td class="text-center">
                            <?php echo $color;?>
                          </td>
                          <td class="text-center">
                            <?php echo $size;?>
                          </td>
                          <td class="text-center">
                            <?php echo $price;?>
                          </td>
                          <td class="text-center">
                            <?php echo $quantity;?>
                          </td>
                          <td class="text-center">
                            <?php echo $sum;?>
                          </td>
                        </tr>
                        <?php } ?>
                        <tr>
                        <td class="text-center" colspan="6">Total:</td>
                          <td class="text-center"><?php echo $total; ?></td>
                        </tr>
                        
                        <?php 
                      }else{ ?>
                      <tr>
                        <td class="text-center" colspan="8">No data</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div><!-- /.row -->
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