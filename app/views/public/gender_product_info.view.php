<?php
	require dirname(__DIR__).'/public/require/header.view.php';
?>

        <div class="content" id="content">
			<?php
				require dirname(__DIR__).'/public/require/branch.view.php';
			?>
            <section id="best-sellers">
                <div class="container-full">
                    <div class="row">
					<?php
						require dirname(__DIR__).'/public/require/search.view.php';
					?>
                      <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div class="features">

                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <div class="products">
                                        <div class="box-title">Featutes</div>
                                        <?php 
                                            foreach ($gender_products_info as $key => $item) {
                                                $id=$item->id;
                                                $image=$item->image;
                                                $name=$item->name;
                                                $price=$item->price;
                                            
                                        ?>
                                        <div class="product">
                                            <div class="cover-img">
                                                <a href="/detail/<?php echo $id; ?>">
                                                    <img src="/public/upload/product_info/<?php echo $image; ?>" alt="">
                                                </a>
                                                <div class="cover-btns">
                                                    <a href="/detail/<?php echo $id; ?>" title="">
                                                        <button class="btn-add-cart">Add to Cart</button>
                                                    </a>
                                                    <a href="checkout.html" title="">
                                                        <button class="btn-buy-now">Buy Now</button>
                                                    </a>
                                                </div>
                                            </div>
                                            <span class="name"><?php echo $name; ?></span>
                                            <span class="price"><?php echo $price; ?></span>
                                        </div>
                                        <?php } ?>  
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="hot-products">
                <?php
                    require dirname(__DIR__).'/public/require/hot_product.view.php';
                ?>
            </section>
		<?php
			require dirname(__DIR__).'/public/require/login-register.view.php';
		?>
        </div>
		<?php
			require dirname(__DIR__).'/public/require/footer.view.php';
		?>