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
                                <?php 
                                    foreach ($hot_product as $key => $item) {
                                        $id=$item->id;
                                        $name=$item->name;
                                        $price=$item->price;
                                        $image=$item->image;
                                    
                                ?>
                                <li>
                                    <div class="product">
                                        <a href="detail.html">
                                            <div class="cover-img">
                                                <img src="public/upload/product_info/<?php echo $image; ?>" alt="">
                                            </div>
                                        </a>
                                        <span class="name"><?php echo $name; ?><span>
                                        <span class="price"><?php echo $price; ?></span>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>