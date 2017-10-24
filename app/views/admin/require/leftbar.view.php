
<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->
				<?php 
                    $url=trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/');
                ?>
				<ul class="nav nav-list">
					<li class="<?php if(strpos($url,"product_info")==true){echo "active";}?>">
						<a href="/admin/product_info">
							<i class="menu-icon fa fa-product-hunt"></i>
							<span class="menu-text" style="font-weight: bold;"> Product Info</span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php if(strpos($url,"products")==true){echo "active";}?>">
						<a href="/admin/products">
							<i class="menu-icon fa fa-product-hunt"></i>
							<span class="menu-text" style="font-weight: bold;"> Products</span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php if(strpos($url,"colors")==true){echo "active";}?>">
						<a href="/admin/colors">
							<i class="menu-icon fa fa-product-hunt"></i>
							<span class="menu-text" style="font-weight: bold;"> Colors </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php if(strpos($url,"sizes")==true){echo "active";}?>">
						<a href="/admin/sizes">
							<i class="menu-icon fa fa-product-hunt"></i>
							<span class="menu-text" style="font-weight: bold;"> Sizes </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php if(strpos($url,"users")==true){echo "active";}?>">
						<a href="/admin/users">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text" style="font-weight: bold;"> Users</span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php if(strpos($url,"orders")==true){echo "active";}?>">
						<a href="/admin/orders">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text" style="font-weight: bold;"> Orders</span>
						</a>

						<b class="arrow"></b>
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>