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

        <div class="page-header">
          <h1 style="font-weight: bold">Colors</h1>
            </div><!-- /.page-header -->

            <div class="row">
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                  <div class="col-xs-12">
                    <a class="btn btn-success fa fa-plus-square fa-lg addcolor" title=""> Add Color</a>
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
          </div>

          <table id="simple-table" class="table  table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center">
                  Id
                </th>
                <th class="text-center">
                  Name
                </th>
                <th class="text-center">
                  Action
                </th>
              </tr>
            </thead>

            <tbody id="p_scents">
              <?php 
              if(!empty($colors))
              { 
                foreach($colors as $item){
                  $id=$item->id;
                  $name=$item->name;
                  ?>
                  <tr>
                    <td class="text-center">
                      <?php echo $id;?>
                    </td>
                    <td class="text-center" id="name-<?php echo $id ?>">
                      <?php echo $name;?>
                    </td>
                    <td class="text-center">
                      <div class="hidden-sm hidden-xs btn-group">
                              <a class="btn btn-xs btn-info edit_color" id="<?php echo $id;?>">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                              </a>
                                <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete ? ');" href="/admin/colors/delete?id=<?php echo $id; ?>">
                                  <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </a>
                              </div>
                    </td>
                    </tr>
                    <?php } ?>
                          
                    <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Nhap color name: </p>
                        <input type='text' name='colorname' id="colorname">
                        <input type='button' id='submitedit' value ='submit'>
                    </div>
                  </div>
                </div>
              </div>
                  <?php } ?>               
                    </tbody>
                  </table>
                </div><!-- /.span -->
              </div><!-- /.row -->

              <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.page-content -->
      </div>
    </div><!-- /.main-content -->

    <?php 
    require dirname(__DIR__).'/require/footer.view.php';
    ?>