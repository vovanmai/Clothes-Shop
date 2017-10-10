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
            <a href="#">Home</a>
          </li>
          <li class="active">Dashboard</li>
        </ul><!-- /.breadcrumb -->

        <div class="nav-search" id="nav-search">
          <form class="form-search">
            <span class="input-icon">
              <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
              <i class="ace-icon fa fa-search nav-search-icon"></i>
            </span>
          </form>
        </div><!-- /.nav-search -->
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
                    <a href="/admin/users/add" class="btn btn-success fa fa-plus-square fa-lg" title=""> Add User</a>
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
                      <form class="form-horizontal" role="form" action="/admin/users/search" method="post">
                        <?php
                        $username='';
                        $fullname='';
                        $active=-1;
                        $level=0;
                        if(isset($search_User))
                        {
                          $username=$search_User['username'];
                          $fullname=$search_User['fullname'];
                          $active=$search_User['active'];
                          $level=$search_User['level'];
                        }
                        ?>
                        <div class="row">
                          <div class="col-xs-3">
                           <div class="form-group">
                             <div class="pos-rel">
                              <input class="typeahead scrollable" name="username" type="text" placeholder="Username" value="<?php echo $username; ?>" />
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-3">
                         <div class="form-group">
                           <div class="pos-rel">
                            <input class="typeahead scrollable" name="fullname" type="text" value="<?php echo $fullname; ?>" placeholder="Fullname" />
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-2">
                       <div class="form-group">
                         <select id="active" name="active" class="multiselect">
                          <option <?php if($active==-1) echo 'selected="selected"';?> value="-1">--Active--</option>
                          <option <?php if($active==1) echo 'selected="selected"';?> value="1">Active</option>
                          <option <?php if($active==0) echo 'selected="selected"';?> value="0">Non-Active</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                     <div class="form-group">
                       <select id="level" name="level" class="multiselect" >
                        <option <?php if($level==0) echo 'selected="selected"';?> value="0">--Level--</option>
                        <option <?php if($level==1) echo 'selected="selected"';?> value="1">Admin</option>
                        <option <?php if($level==2) echo 'selected="selected"';?> value="2">Employee</option>
                        <option <?php if($level==3) echo 'selected="selected"';?> value="3">Customer</option>
                      </select>
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
                  Image
                </th>
                <th class="text-center">
                  Username
                </th>
                <th class="text-center">
                  Fullname
                </th>
                <th class="text-center">
                  Phone
                </th>
                <th class="text-center">
                  Address
                </th>
                <th class="text-center">
                  Level
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
              if(!empty($users))
              { 
                foreach($users as $item){
                  $id=$item->id;
                  $username=$item->username;
                  $fullname=$item->fullname;
                  $phone=$item->phone;
                  $address=$item->address;
                  $level=$item->level;
                  $avatar=$item->avatar;
                  $active=$item->active;
                  ?>
                  <tr>
                    <td class="text-center">
                      <?php echo $id;?>
                    </td>
                    <td class="text-center">
                      <img class="avatar-index" src="/public/upload/avatar/<?php if($avatar==''){echo "default.png";}else{echo $avatar;}?>" alt="">
                    </td>
                    <td class="text-center">
                      <?php echo $username;?>
                    </td>
                    <td class="text-center">
                      <?php echo $fullname;?>
                    </td>
                    <td class="text-center">
                      <?php echo $phone;?>
                    </td>

                    <td class="text-center">
                      <?php echo $address;?>
                    </td>

                    <td class="text-center">
                      <?php
                      if($level==1){
                        echo "admin";
                      }else if($level==2){
                        echo "employee";
                      }else{
                        echo "customer";
                      }
                      ?>
                    </td>
                    <td class="text-center">
                      <a href="javascript:void(0)" class="edit_active" id="<?php echo $id; ?>">
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
                              <!-- <button class="btn btn-xs btn-success">
                                <i class="ace-icon fa fa-check bigger-120"></i>
                              </button> -->

                              <a class="btn btn-xs btn-info" href="/admin/users/edit/<?php echo $id; ?>">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                              </a>
                              <?php
                              if($username!='admin'){
                                ?>
                                <a class="btn btn-xs btn-danger" href="/admin/users/delete?id=<?php echo $id; ?>">
                                  <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </a>
                                <?php } ?>
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