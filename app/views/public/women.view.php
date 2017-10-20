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
                                            foreach ($women_products_info as $key => $item) {
                                                $id=$item->id;
                                                $image=$item->image;
                                                $name=$item->name;
                                                $price=$item->price;
                                            
                                        ?>
                                        <div class="product">
                                            <div class="cover-img">
                                                <a href="detail.html">
                                                    <img src="/public/upload/product_info/<?php echo $image; ?>" alt="">
                                                </a>
                                                <div class="cover-btns">
                                                    <a href="cart.html" title="">
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
                <div class="container-full">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                            <div class="cover-box">
                                <button class="btn-left size-btn" id="btn-prev">

                                    <i class=" fa fa-angle-left " aria-hidden="true"></i>
                                </button>
                                <button class="btn-right size-btn" id="btn-next">
                                   <i class=" fa fa-angle-right " aria-hidden="true"></i>
                               </button>
                               <div class="box-title">Hot Products</div>
                               <ul id="list-hot-products">
                                <li>
                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="/public/assets/img/men-1.jpg" alt="">
                                            </div>
                                        </a>
                                        <span class="name">Adidas</span>
                                        <span class="price">$200</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="/public/assets/img/men-2.jpg" alt="">
                                            </div>
                                        </a>
                                        <span class="name">Adidas</span>
                                        <span class="price">$200</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="/public/assets/img/men-3.jpg" alt="">
                                            </div>
                                        </a>
                                        <span class="name">Adidas</span>
                                        <span class="price">$200</span>
                                    </div>
                                </li>
                                <li>

                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="/public/assets/img/men-4.jpg" alt="">
                                            </div>
                                        </a>
                                        <span class="name">Adidas</span>
                                        <span class="price">$200</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="/public/assets/img/women-1.jpg" alt="">
                                            </div>
                                        </a>
                                        <span class="name">Adidas</span>
                                        <span class="price">$200</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="/public/assets/img/women-2.jpg" alt="">
                                            </div>
                                        </a>
                                        <span class="name">Adidas</span>
                                        <span class="price">$200</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="/public/assets/img/women-3.jpg" alt="">
                                            </div>
                                        </a>
                                        <span class="name">Adidas</span>
                                        <span class="price">$200</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="/public/assets/img/women-4.jpg" alt="">
                                            </div>
                                        </a>
                                        <span class="name">Adidas</span>
                                        <span class="price">$200</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="/public/assets/img/women-5.jpg" alt="">
                                            </div>
                                        </a>
                                        <span class="name">Adidas</span>
                                        <span class="price">$200</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="/public/assets/img/women-6.jpg" alt="">
                                            </div>
                                        </a>
                                        <span class="name">Adidas</span>
                                        <span class="price">$200</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="/public/assets/img/women-7.jpg" alt="">
                                            </div>
                                        </a>
                                        <span class="name">Adidas</span>
                                        <span class="price">$200</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="/public/assets/img/women-8.jpg" alt="">
                                            </div>
                                        </a>
                                        <span class="name">Adidas</span>
                                        <span class="price">$200</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
		<?php
			require dirname(__DIR__).'/public/require/login-register.view.php';
		?>
        </div>
		<?php
			require dirname(__DIR__).'/public/require/footer.view.php';
		?>