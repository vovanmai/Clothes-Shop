<?php
	require dirname(__DIR__).'/public/require/header.view.php';
?>
 <?php
                            if(!empty($product_info))
                            { 
                              ?>
<div class="content" id="content">
			<section class="detail-product" id="details-product">
				<div class="row">
					<div class="col-lg-12">
						<div class="left" id="images-product">
							<div class="main-image"><img class="img-product" src="/public/assets/img/men-1.jpg" alt=""></div>
							<div class="wrap-list">
								<ul id="list-images">
									<li><img class="small-image" src="/public/assets/img/<?php echo $product_info->image ?>" alt=""></li>
									<li><img class="small-image" src="/public/assets/img/<?php echo $product_info->image1 ?>" alt=""></li>
									<li><img class="small-image" src="/public/assets/img/<?php echo $product_info->image2 ?>" alt=""></li>
									
								</ul>
							</div>
						</div>
						<div class="right">
							<p class="name-product"><?php echo $product_info->name ?></p>
							<p class="price-product">$<?php echo $product_info->price ?></p>
							<div class="quantity" id="quantity">
								<button class="btn-sub">-</button>
								<input class="input-num" type="text" value="1">
								<button class="btn-plus">+</button>
							</div>
							<div>
								
							</div>
							<select class="size-select">
								<option>---Choose Size---</option>
                                <?php
                                if(!empty($sizes))
                                { 
                                    foreach($sizes as $item){ ?>
								    <option><?php echo $item->size ?></option>
                                    <?php } }  ?>
							</select>
							<select class="size-select">
								<option>---Choose Color---</option>
                                <?php
                                if(!empty($colors))
                                { 
                                    foreach($colors as $item){ ?>
								    <option><?php echo $item->name ?></option>
                                    <?php } }  ?>
							</select>
							<button class="add-cart"><a href="cart.html">Add to cart</a></button>
							<button class="checkout"><a href="checkout.html">Buy Now</a></button>
							<div class="info-product">
								<h4><?php echo $product_info->preview_text ?></h4>
								​<?php echo $product_info->detail_text ?>
							</div>
						</div>
					</div>
					
				</div>
			</section>
                     <?php } ?>
<?php
    require dirname(__DIR__).'/public/require/login-register.view.php';
?>
    <script type="text/javascript" src="/public/assets/js/appDetail.js"></script>
<?php
    require dirname(__DIR__).'/public/require/footer.view.php';
?>