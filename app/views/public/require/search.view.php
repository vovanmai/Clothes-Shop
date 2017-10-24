<div class="col-lg-2 col-md-2 hidden-mobile hidden-tablet">
<div class="menu-vertical">
	<div class="box-title">Search</div>
	<div class="content-box">
		<form action="" method="get">
			<label for="gender">Men or Women</label>
			<select class="select" name="gender" id="gender">
				<option 'selected="selected"' value="1">Men</option>
				<option value="0">Women</option>
			</select>
			<label for="gender">Kinds</label>
			<select class="select" name="style" id="style">
				<?php
				if(isset($_POST['style']))
				{ 
					foreach($cats as $item){ ?>
					<option <?php if($item->id == $_POST['style']) echo 'selected="selected"';?> value= <?php echo $item->id?>><?php echo $item->name ?></option>
					<?php } 
				} else {
					foreach($cats as $item){ ?>
					<option <?php if($item->id == 1) echo 'selected="selected"';?> value= <?php echo $item->id?>><?php echo $item->name ?></option>
					<?php }} ?> 
 
				</select>
				<label>Price (VND): </label>
				<select class="select" name="price">
				<?php 
				$arr = array("Under $200", "From $200 to $ 500", "From $500 to $800",
				"Over $800");
				$arrlength = count($arr);
				for($i = 0; $i < $arrlength ; $i++) { ?> 
					<option <?php if($i == 1) echo 'selected="selected"';?>  
					value="<?=$i?>"><?=$arr[$i]?></option>
					<?php }?>
				</select>
				<button class="btn-search" type="button" name="search_public" id="search_public"
				onclick="paging('searchFilter',1);">Search</button>
				<!-- <a href="javascript:void(0);" onclick="searchFilter(1);">Search</a> -->
			</form>
		</div>
	</div>
</div>