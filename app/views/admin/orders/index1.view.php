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
            Users
                <!-- <small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Static &amp; Dynamic Tables
                </small> -->
              </h1>
            </div><!-- /.page-header -->

            <div class="row">
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                  <div class="col-xs-12">
                  </br>
                </br>
                <?php 
                if(isset($_GET['msg'])){
                  ?>
                  <div class="alert alert-success" role="alert">
                    <strong>
                      <?php
                      echo $_GET['msg'];
                      ?>
                    </strong> 
                  </div>
                  <?php } ?>
                  
                  <div class="row text-center">
                    <div class="col-xs-12">
                      <!-- PAGE CONTENT BEGINS -->
                      <form class="form-horizontal" role="form" action="/admin/orders/search" method="post">
                        <?php
                        $fullname='';
                        $paid=-1;
                        $shipped=-1;
                        $payment=-1;
                        $date_order='';
                        $status=-1;
                        if(isset($search_Order))
                        {
                          $fullname=$search_Order['fullname'];
                          $paid=$search_Order['paid'];
                          $shipped=$search_Order['shipped'];
                          $payment=$search_Order['payment'];
                          $date_order=$search_Order['date_order'];
                          $status=$search_Order['status'];
                        }
                        ?>
                        <div class="row">
                          <div class="col-xs-2">
                           <div class="form-group">
                             <div class="pos-rel">
                              <input class="typeahead scrollable" name="fullname" type="text" value="<?php echo $fullname; ?>" placeholder="Fullname" />
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-2">
                         <div class="form-group">
                           <select id="status" name="status" class="multiselect">
                             <option <?php if($status==-1) echo 'selected="selected"';?> value="-1">--Status--</option>
                             <option <?php if($status==0) echo 'selected="selected"';?> value="0">Confirmed</option>
                             <option <?php if($status==1) echo 'selected="selected"';?> value="1">Pending</option>
                             <option <?php if($status==2) echo 'selected="selected"';?> value="2">Cancel</option>
                           </select>
                         </div>
                       </div>
                       <div class="col-xs-2">
                         <div class="form-group">
                           <select id="paid" name="paid" class="multiselect">
                            <option <?php if($paid==-1) echo 'selected="selected"';?> value="-1">--paid--</option>
                            <option <?php if($paid==1) echo 'selected="selected"';?> value="1">Yes</option>
                            <option <?php if($paid==0) echo 'selected="selected"';?> value="0">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                       <div class="form-group">
                         <select id="shipped" name="shipped" class="multiselect" >
                          <option <?php if($shipped==-1) echo 'selected="selected"';?> value="-1">--shipped--</option>
                          <option <?php if($shipped==1) echo 'selected="selected"';?> value="1">Yes</option>
                          <option <?php if($shipped==0) echo 'selected="selected"';?> value="0">No</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                     <div class="form-group">
                       <select id="payment" name="payment" class="multiselect" >
                        <option <?php if($payment==-1) echo 'selected="selected"';?> value="-1">--payment--</option>
                        <option <?php if($payment==1) echo 'selected="selected"';?> value="1">Yes</option>
                        <option <?php if($payment==0) echo 'selected="selected"';?> value="0">No</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-2">
                   <div class="form-group">
                     <div class="pos-rel">
                       <input class="typeahead scrollable" name="date_order" type="text" placeholder="date order" value="<?php echo $date_order; ?>" />
                     </div>
                   </div>
                 </div>
                 <div class="col-xs-2">
                  <div class="form-group">
                    <button class="btn btn-success  fa fa-plus-square fa-lg" type="submit" name="search">Search</button>
                  </div>
                </div>
              </div>
            </form>
            <!-- PAGE CONTENT ENDS -->
          </div><!-- /.col -->
        </div>

        <table id="simple-table" class="table  table-bordered table-hover">
          <thead>
            <tr>
              <th class="text-center">
                Id
              </th>
              <th class="text-center">
                Username
              </th>
              <th class="text-center">
                Fullname
              </th>
              <th class="text-center">
                Address
              </th>
              <th class="text-center">
                Order date
              </th>
              <th class="text-center">
                Status
              </th>
              <th class="text-center">
                Paid
              </th>
              <th class="text-center">
                Shipped
              </th>
              <th class="text-center">
                Payment
              </th>
              <th class="text-center">
                Note
              </th>
              <th class="text-center">
                Detail
              </th>
              <th class="text-center">
                Action
              </th>
            </tr>
          </thead>

          <tbody>
            <?php 
            if(!empty($orders))
            { 
              foreach($orders as $item){
                $id=$orders->id;
                $username=$item->username;
                $fullname=$item->fullname;
                $address=$item->address;
                $date_order=$item->date_order;
                $status=$item->status;
                $paid=$item->paid;
                $shipped=$item->shipped;
                $payment=$item->payment_id;
                $note=$item->note;
                ?>
                <tr>
                  <td class="text-center">
                    <?php echo $id;?>
                  </td>
                  <td class="text-center">
                    <?php echo $username;?>
                  </td>
                  <td class="text-center">
                    <?php echo $fullname;?>
                  </td>
                  <td class="text-center">
                    <?php echo $address;?>
                  </td>
                  <td class="text-center">
                    <?php echo $date_order;?>
                  </td>
                  <td class="text-center">
                    <?php 
                    if($status==0)
                    {
                      echo 'Confirmed';
                    }
                    if($status==1)
                    {
                      echo 'Pending';
                    }
                    if($status==2)
                    {
                      echo 'Cancel';
                    }
                    ?>
                  </td>
                  <td class="text-center">
                    <a href="javascript:void(0)"  class="edit_active" id="<?php echo $id; ?>">
                      <img src="/public/admin/assets/images/<?php 
                      if($paid==1){
                        echo "active.gif";
                      }else{
                        echo "deactive.gif";
                      }
                      ?>" alt="">
                    </a>
                  </td>
                  <td class="text-center">
                    <a href="javascript:void(0)"  class="edit_active" id="<?php echo $id; ?>">
                      <img src="/public/admin/assets/images/<?php 
                      if($shipped==1){
                        echo "active.gif";
                      }else{
                        echo "deactive.gif";
                      }
                      ?>" alt="">
                    </a>
                  </td>
                  <td class="text-center">
                   <select id="paid" name="paid" class="multiselect">
                    <option <?php if($paid==-1) echo 'selected="selected"';?> value="-1">--paid--</option>
                    <option <?php if($paid==1) echo 'selected="selected"';?> value="1">Yes</option>
                    <option <?php if($paid==0) echo 'selected="selected"';?> value="0">No</option>
                  </select>
                </td>
                <td class="text-center">
                  <textarea><?php echo $note;?></textarea>
                </td>
                <td class="text-center">
                  <a href="javascript:void(0)"  class="edit_active" alt=""></a>
                </td>
                <?php } ?>
                <td class="text-center">
                  <div class="hidden-sm hidden-xs btn-group">
                    <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete ? ');" href="/admin/users/delete/<?php echo $id; ?>">
                      <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </a>
                  </div>
                </td>
              </tr>
              <?php 
            }
          }else{
            ?>
            <tr>
              <td class="text-center" colspan="8">No data</td>
            </tr>

            <?php 
          }
          ?>                      
        </tbody>
      </table>
    </div><!-- /.span -->
  </div><!-- /.row -->

  <div class="row text-center">
    <?php 
    echo $paginghtml;
    ?>
  </div>
  <!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->

<?php 
require dirname(__DIR__).'/require/footer.view.php';
?>