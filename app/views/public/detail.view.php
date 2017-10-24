<?php
require dirname(__DIR__).'/public/require/header.view.php';
?>

    <div class="content" id="content">
        <?php 
            if(isset ($productInfo)){
        ?>
        <section class="detail-product" id="details-product">
            <div class="row">
                <div class="col-lg-12">
                    <div class="left">
                        <div class="main-image"><img src="/public/upload/product_info/<?php echo $productInfo[0]->image;?>" alt=""></div>
                    </div>
                    <div class="right">
                        <p class="brand-product">Adidas</p>
                        <p class="name-product"><?php echo $productInfo[0]->name;?></p>
                        <p class="id-product" id ="notify" style="color: red"></p>
                        <p class="price-product">$ <?php echo $productInfo[0]->price;?></p>
                        <div class="quantity">
                            <button class="btn-sub" id ='sub' >-</button>
                            <span id='number'>
                                <input class="num" type="text" value="1" id='num' disabled >
                            </span>
                            <input type="hidden" value="<?php echo $productInfo[0]->id;?>" id ='product_info'>
                            <button class="btn-plus" id = 'plus'>+</button>

                        </div>

                        <select class="size-select" name='size' id='size'>
                            <?php
                                foreach($size as $key => $value){
                                ?>
                                <option value="<?php echo $value ->id ?>"><?php echo $value ->size ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <select class="size-select" name ='colors' id ='colors'>
                                <?php
                                $check;
                                foreach($color as $key => $value){
                                ?>
                                   <option value="<?php echo $value ->id ?>"><?php echo $value ->name ?></option>
                                <?php
                                }
                                ?>
                       </select>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="add-cart" id ="addCart"><a href="" onclick="return false;">Add to cart</a></button>
                            </div>
                            <div class="col-md-6">
                                <button class="add-cart" id ="addCart"><a href="/detail/related/<?php echo $productInfo[0]->cat_id;?>/<?php echo $productInfo[0]->id;?>" >Related products</a></button>
                            </div>
                        </div>
                        <div class="info-product">
                            <h4><?php echo $productInfo[0]->preview_text;?></h4>
                            <p>​<?php echo $productInfo[0]->detail_text;?></p>
                        </div>
                        <div class="fb-comments" data-href="http://localhost:8000/detail/<?php echo $productInfo[0]->id; ?>" data-numposts="10"></div>
                    </div>
                </div>

            </div>
        </section>
        <?php
            } else {
                echo "Có lỗi xảy ra ,Vui lòng truy cấp lại sau !" ;
            }
        ?>
        <div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=812218178986913';
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php
require dirname(__DIR__).'/public/require/login-register.view.php';
?>
<script type="text/javascript" src="/public/assets/js/appDetail.js"></script>
<?php
require dirname(__DIR__).'/public/require/footer.view.php';
?>