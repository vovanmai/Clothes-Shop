 <?php

require dirname(__DIR__).'/public/require/header.view.php';
?>



        <div class="content" id="content">
           <?php
                if (isset($arrStore)) {

            ?>
            <section id="cart" class="cart">

                <div class="row">

                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                        <div class="title-cart">
                            <span>Shopping Cart</span>
                        </div>

                        <div class="box-content">
                            <div class="hidden-mobile title-table row">
                                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><img src="" alt=""></div>
                                <div class="col-sm-3 col-xs-4 col-md-4 col-lg-4">
                                    <div class="details-product">Products</div>
                                </div>

                                <div class="col-sm-5 col-xs-2 col-md-2 col-lg-2">
                                    <div class="quantity">Quantity</div>
                                </div>
                                <div class="col-sm-2 col-xs-1 col-md-1 col-lg-1">
                                    <div class="price">Price</div>
                                </div>
                                <div class="hidden-mobile col-xs-1 col-md-1 col-lg-1">
                                    <div class="total">Total</div>
                                </div>
                                <div class="col-sm-2 col-xs-1 col-md-1 col-lg-1">
                                    <div class="delete">Delete</div>
                                </div>
                            </div>

                            <div class="row">
                            
                                <ul class="list-products col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <?php
                                 
                                    $totalPrice=0;
                                        foreach ($arrStore as $key => $value) {
                                           foreach ($_SESSION['cart'] as $k => $val) {
                                                if ($k ==$key) {
                                                   $numCart =$val;
                                                   $totalPrice += $val* $value->price;
                                                }
                                            }
                                       

                                    ?>
                                        <li>
                                            <div class="product-order row">
                                                <div class="hidden-mobile col-xs-2 col-md-3 col-lg-3">
                                                    <a href="detail/<?php echo $value->id;?>">
                                                        <div class="thumbnail">
                                                            <img src="/public/upload/product_info/<?php echo $value->image?>" alt="">
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-sm-12 col-xs-3 col-md-4 col-lg-4">
                                                    <div class="title-row hidden-tablet hidden-desktop hidden-lage-screen">Product Name</div>
                                                    <div class="details-product value-box">
                                                        <?php echo $value->namesp?>
                                                        <div class="value-box">
                                                        <span class="size">Size: <?php echo $value->size?></span>
                                                        <span class="color">Color: <?php echo $value->color?></span>
                                                    </div>
                                                    </div>
                                                    

                                                </div>

                                                <div class="quantity col-sm-12 col-xs-3 col-md-2 col-lg-2">
                                                    <div class="title-row hidden-tablet hidden-desktop hidden-lage-screen">Quantity</div>
                                                    <div class=" value-box test1">
                                                        
                                                        

                                                      
                                                         <input type="number" min='1' max="<?php echo $value->quantity?>" id="num-<?php echo $key?>"  class="numProd" 
                                                         value="<?php echo $numCart?>"   >
                                                        
                                                      
                                                    </div>

                                                </div>
                                                <div class="col-sm-12 col-xs-1 col-md-1 col-lg-1">
                                                    <div class="title-row hidden-tablet hidden-desktop hidden-lage-screen">Price</div>
                                                    <div class="price  value-box" id='price-<?php echo $key?>'><?php echo $value->price?></div>
                                                </div>
                                                <div class="hidden-mobile col-xs-2 col-md-1 col-lg-1">
                                                    <div class="title-row hidden-tablet hidden-desktop hidden-lage-screen"
                                                     >Total</div>
                                                  
                                                    <div class="total  value-box" id='totalPrice-<?php echo $key?>'><?php echo  ($value->price*$numCart)?></div>
                                                  
                                                </div>
                                                <div class="col-sm-12 col-xs-1 col-md-1 col-lg-1">
                                                    <div class="title-row hidden-tablet hidden-desktop hidden-lage-screen">Delete</div>
                                                    <div class="delete  value-box">
                                                        <a href="cart/delete/<?php echo $key?>">Delete</a>
                                                    </div>

                                                </div>
                                                
                                            </div>

                                        </li>

                                    <?php
                                        }
                                    ?>
                                </ul>

                               
                            </div>


                            <div class="box-total row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                   <div class="total-cost">  Total :<span  id='priceCart'> <?php echo $totalPrice;?></span></div>
                                </div>
                            </div>
                            <div class="box-checkout row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                    <a href="/buy"><button class="btn-checkout" >Buy</button></a>
                                    <a href="" onclick="return false;"><button class="btn-continues buyproduct" id='updateProducts'>Update</button></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
             <?php 
            } else {
             ?>
             <section id="cart" class="cart">

             <?php   
                echo 'You do not have product !' ;
            }
            ?>
            </section>

            <?php
            require dirname(__DIR__).'/public/require/login-register.view.php';
        ?>
            
        </div>

        <?php
        require dirname(__DIR__).'/public/require/footer.view.php';
        ?>
