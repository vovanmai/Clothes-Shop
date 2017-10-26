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
        <?php 
          require dirname(__DIR__).'/require/rightbar.view.php';
        ?>

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
                  
                  <div class="row text-center">
                    <div class="col-xs-12">
                      <!-- PAGE CONTENT BEGINS -->
                      <form class="form-horizontal" id="search-users" role="form" action="/admin/users/search" method="get">
                        <?php
                        $search_key = array(
                          'username'  => '',
                          'fullname'   => '',
                          'active'    => -1,
                          'level'     => -1,
                        );
                        if(isset($search_User))
                        {
                          foreach(array_keys($search_User) as $key) {
                            $search_key[$key] = $search_User[$key];
                          }
                        }
                        ?>
                        <div class="row">
                          <div class="col-xs-3">
                           <div class="form-group">
                             <div class="pos-rel">
                              <input class="typeahead scrollable" name="username" type="text" placeholder="Username" value="<?=$search_key['username']?>" />
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-3">
                         <div class="form-group">
                           <div class="pos-rel">
                            <input class="typeahead scrollable" name="fullname" type="text" value="<?= $search_key['fullname']; ?>" placeholder="Fullname" />
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-2">
                       <div class="form-group">
                         <select id="active" name="active" class="multiselect">
                          <option <?=$search_key['active'] == -1 ? 'selected="selected"':''?> value="-1">--Active--</option>
                          <option <?=$search_key['active'] == 1 ? 'selected="selected"':''?> value="1">Active</option>
                          <option <?=$search_key['active'] == 0 ? 'selected="selected"':''?> value="0">Non-Active</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                     <div class="form-group">
                       <select id="level" name="level" class="multiselect" >
                        <option <?=$search_key['level'] == -1 ? 'selected="selected"':''?> value="-1">--Level--</option>
                        <option <?=$search_key['level'] == 1 ? 'selected="selected"':''?> value="1">Admin</option>
                        <option <?=$search_key['level'] == 2 ? 'selected="selected"':''?> value="2">Employee</option>
                        <option <?=$search_key['level'] == 3 ? 'selected="selected"':''?> value="3">Customer</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-2">
                    <div class="form-group">
                      <button class="btn btn-success  fa fa-plus-square fa-lg" type="submit">Search</button>
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
                <?php if($_SESSION['user'][0]->level==1){?>
                <th class="text-center">
                  Active
                </th>
                <?php } ?>
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
                    <?php if($_SESSION['user'][0]->level==1){?>
                    <td class="text-center">
                      <a href="javascript:void(0)"  onclick="chageActiveUsers(<?php echo $id; ?>)" class="edit_active" id="<?php echo $id; ?>">
                        <img src="/public/admin/assets/images/<?php 
                        if($active==1){
                          echo "active.gif";
                        }else{
                          echo "deactive.gif";
                        }
                        ?>" alt="">
                      </a>
                    </td>
                    <?php } ?>
                    <td class="text-center">
                      <div class="hidden-sm hidden-xs btn-group">
                              <!-- <button class="btn btn-xs btn-success">
                                <i class="ace-icon fa fa-check bigger-120"></i>
                              </button> -->

                              <a class="btn btn-xs btn-info" href="/admin/users/edit/<?php echo $id; ?>">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                              </a>
                              <?php
                              if($level!=1){
                                ?>
                                <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete ? ');" href="/admin/users/delete?id=<?php echo $id; ?>">
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

              <div class="row text-center cover-pagination">
                <?php 
                  if(isset($paging)) {
                    echo $paging;
                  }
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
