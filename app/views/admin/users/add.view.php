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
								<a href="/admin/users">Home</a>
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
								Add Users
								<!-- <small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Static &amp; Dynamic Tables
								</small> -->
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<!-- PAGE CONTENT BEGINS -->
							 	<form  action="/admin/users/add" method="post" enctype="multipart/form-data">
							    	<div class="form-group">
							      		<label style="font-weight:bold;">Username: </label>
							      		<input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
							   			<div id="username_warning_msg" style="margin-top: 10px;">			
							   			</div>	
							   		</div>

							    	<div class="form-group">
							      		<label style="font-weight:bold;">Password:</label>
							      		<input type="password" id="password" class="form-control"  placeholder="Enter password" name="password">
							    		<div id="password_warning_msg" style="margin-top: 10px;">			
							   			</div>
							    	</div>

							    	<div class="form-group">
							      		<label style="font-weight:bold;" for="pwd">Fullname:</label>
							      		<input type="text" id="fullname" class="form-control" placeholder="Enter fullname" name="fullname">
							      		<div id="fullname_warning_msg" style="margin-top: 10px;">			
							   			</div>
							    	</div>

							    	<div class="form-group">
							      		<label style="font-weight:bold;" for="pwd">Email:</label>
							      		<input type="text" id="email" class="form-control" placeholder="Enter email" name="email">
							    		<div id="email_warning_msg" style="margin-top: 10px;">			
							   			</div>
							    	</div>

							    	<div class="form-group">
							      		<label style="font-weight:bold;">Phone:</label>
							      		<input type="text" id="phone" class="form-control" placeholder="Enter phone" name="phone">
							    		<div id="phone_warning_msg" style="margin-top: 10px;">			
							   			</div>
							    	</div>

							    	<div class="form-group">
							      		<label style="font-weight:bold;">Address:</label>
							      		<input type="text" id="address" class="form-control" placeholder="Enter address" name="address">
							    		<div id="address_warning_msg" style="margin-top: 10px;">			
							   			</div>
							    	</div>
									<div class="form-group">
							      		<label style="font-weight:bold;" for="pwd">Avatar:</label>
							      		<input type="file" name="avatar">
							    	</div>
							    	<div class="form-group text-center">
							      		<button type="submit" name="submit" disabled id="add-submit"  class="btn btn-success">Add</button>
							    	</div>
							  	</form>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

<?php 
	require dirname(__DIR__).'/require/footer.view.php';
?>