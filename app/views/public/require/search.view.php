<div class="col-lg-2 col-md-2 hidden-mobile hidden-tablet">
<div class="menu-vertical">
	<div class="box-title">Search</div>
	<div class="content-box">
		<?php
		$gender=0;
		$style=1;
		$price=0;
		if(isset($search_public)){
			$gender= $search_public['gender'];
			$style= $search_public['style'];
			$price= $search_public['price']; 
		}
		?>
		<form action="search" method="post">
			<label for="gender">Men or Women</label>
			<select class="select" name="gender" id="gender">
				<option <?php if($gender==1) echo 'selected="selected"';?> value="1">Men</option>
				<option <?php if($gender==0) echo 'selected="selected"';?> value="0">Women</option>
			</select>
			<label for="gender">Kinds</label>
			<select class="select" name="style" id="style">
				<?php
				if(!empty($cats))
				{ 
					foreach($cats as $item){ ?>
					<option <?php if($style==$item->id) echo 'selected="selected"';?> value= <?php echo $item->id?>><?php echo $item->name ?></option>
					<?php } } ?> 
				</select>
				<label>Price (VND): </label>
				<select class="select" name="price">
					<option <?php if($price==0) echo 'selected="selected"';?> value="0">From 0 to 200</option>
					<option <?php if($price==1) echo 'selected="selected"';?> value="1">From 200 to 350</option>
					<option <?php if($price==2) echo 'selected="selected"';?> value="2">From 350 to 500</option>
					<option <?php if($price==3) echo 'selected="selected"';?> value="3">From 500 to 700</option>
					<option <?php if($price==4) echo 'selected="selected"';?> value="4">From 700 to 1000</option>
				</select>
				<button class="btn-search" type="submit" name="search_public" id="search_public">Search</button>
			</form>
		</div>
	</div>
</div>