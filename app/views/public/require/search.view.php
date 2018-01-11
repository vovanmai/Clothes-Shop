<div class="col-lg-2 col-md-2 hidden-mobile hidden-tablet">
<div class="menu-vertical">
	<div class="box-title">Search</div>
	<div class="content-box">
		<form action="" method="get">
			<label for="gender">Men or Women</label>
			<select class="select" name="gender" id="gender">
					<?php if(isset($_GET['gender']))
					{ 
						?>
					<option <?= $_GET['gender'] == 1? 'selected="selected"': ''?> value="1">Men</option>
					<option <?= $_GET['gender'] == 0? 'selected="selected"': ''?> value="0">Women</option>
					<?php } else {
					?>
					<option value="1">Men</option>
					<option value="0">Women</option>
					<?php } ?>
			</select>
			<label for="gender">Kinds</label>
			<select class="select" name="style" id="style">
				<?php
				if(isset($_GET['style']))
				{ ?>
					<option <?php if($_GET['style'] == -1) echo 'selected="selected"';?>
							value="-1">----All Kinds----</option>
					<?php
					foreach($cats as $item){ ?>
					<option <?php if($item->id == $_GET['style']) echo 'selected="selected"';?>
						 value= <?php echo $item->id?><?php echo $item->name ?></option>
					<?php } 
				} else {?>
					<option value="-1">----All Kinds----</option>
					<?php	
						foreach($cats as $item){ ?>
						<option <?php if($item->id == 1) echo 'selected="selected"';?> value= <?php echo $item->id?>><?php echo $item->name ?></option>
					<?php }} ?> 
 
				</select>
				<label>Price (VND): </label>
				<select class="select" name="price">
				<?php 
				$arr = array("-----Price-----","Under 200.000", "From 200.000 to 500.000", "From 500.000 to 1.000.000",
				"Over 1.000.000");
				$arrlength = count($arr);
				for($i = 0; $i < $arrlength ; $i++) { ?> 
					<option <?php if($i == 1) echo 'selected="selected"';?>  
					value="<?=$i?>"><?=$arr[$i]?></option>
					<?php }?>
				</select>
				<button class="btn-search" type="button" name="search_public" id="search_public"
				onclick="paging('search',1);">Search</button>
				<!-- <a href="javascript:void(0);" onclick="searchFilter(1);">Search</a> -->
			</form>
		</div>
	</div>
</div>