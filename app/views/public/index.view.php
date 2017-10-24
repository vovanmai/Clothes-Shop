<?php
require dirname(__DIR__).'/public/require/header.view.php';
?>

<div class="content" id="content">
    <section id="head-slide">
        <div class="container-full">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="slide-box">
                        <a href="/men" href="men.html">
                            <button class="btn-shop btn-men">MEN</button>
                        </a>
                        <a href="/women">
                            <button class="btn-shop btn-women">WOMEN</button>
                        </a>
                        <ul id="list-images-head">
                            <li>
                                <img src="/public/assets/img/men.png" alt="men image">
                            </li>
                            <li>
                                <img src="/public/assets/img/women.png" alt="men image">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
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
                                            <div class="box-title"><?php if(isset($cat[0]->name)){echo $cat[0]->name;}else{echo "Features";}?></div>
                                            <?php
    										if(!empty($products_info))
    										{ 
    											foreach($products_info as $item)  { ?>
    										<div class="product">
                                                <div class="cover-img">
                                                    <a href="/detail/<?php echo $item->id;?>">
                                                        <img src="/public/upload/product_info/<?php echo $item->image; ?>" alt="">
                                                    </a>
                                                </div>
                                                <span class="name"><?php echo $item->name; ?></span>
                                                <span class="price">$<?php echo $item->price; ?></span>
                                            </div>
    											<?php } 
                                            }else{
                                                echo '<div style="text-align:center;font-weight:bold">No product</div>';
                                            }

                                                ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="cover-pagination">
                                                        <?php 
                                                        if(isset($paginghtml)){
                                                            echo $paginghtml;
                                                        }
                                                        ?>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <input type="hidden" id="count" value="<?=$allpage?>" >
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