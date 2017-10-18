<div class="col-lg-2 col-md-2 hidden-mobile hidden-tablet">
<div class="menu-vertical">
	<div class="box-title">Search</div>
	<div class="content-box">
		<label for="gender">Men or Women</label>
		<select class="select" name="gender">
		  <option value="men">Men</option>
		  <option value="women">Women</option>
	  </select>
	  <label for="gender">Kinds</label>
	  <select class="select" name="style">
		  <?php
		   if(!empty($cats))
		   { 
			 foreach($cats as $item){ ?>
		  	<option value= <?php echo $item->name?>><?php echo $item->name ?></option>
		  <?php } } ?> 
	  </select>
	  <label for="size">Size: </label>
	  <select class="select" name="size">
		  <?php
		   if(!empty($sizes))
		   { 
			 foreach($sizes as $item){ ?>
		  	<option value= <?php echo $item->size?>><?php echo $item->size ?></option>
		  <?php } } ?>
	 
	  </select>
	  <label>Price from: </label><input class="input-price price-from" type="text" name="">
	  <label>Price to: </label><input class="input-price price-to" type="text" name="">
	  <a href="product.html"><button class="btn-search">Search</button></a>
  </div>
</div>
</div>