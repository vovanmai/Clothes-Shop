<div class="col-lg-2 col-md-2 hidden-mobile hidden-tablet">
	<div class="menu-vertical">
		<div class="box-title">Search</div>
		<div class="content-box">
			<label for="gender">Men or Women</label>
			<select class="select" name="gender" id="gender">
				<option value="1">Men</option>
				<option value="0">Women</option>
			</select>
			<label for="gender">Kinds</label>
			<select class="select" name="style" id="style">
				<?php
				if(!empty($cats))
				{ 
					foreach($cats as $item){ ?>
					<option value= <?php echo $item->id?>><?php echo $item->name ?></option>
					<?php } } ?> 
				</select>
				<label>Price (VND): </label>
				<select class="select" name="price">
					<option value="0">From 0 to 200</option>
					<option value="1">From 200 to 350</option>
					<option value="2">From 350 to 500</option>
					<option value="3">From 500 to 700</option>
					<option value="4">From 700 to 1000</option>
				</select>
				<button class="btn-search" id="search_public">Search</button>
			</div>
		</div>
	</div>