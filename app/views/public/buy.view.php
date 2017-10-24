<?php
require dirname(__DIR__).'/public/require/header.view.php';
?>
<div class="content" id="content">
    <section id="checkout" class="checkout">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                <div class="title-checkout">
                    <span>Checkout</span>
                </div>
                <div class="box-content">

                    <div class="row">
                        <?php

                        if (isset($_SESSION['login'])) {
                            $user = $_SESSION['login'];
                            ?>
                            <div class="col-sm-12 col-xs-4 col-md-4 col-lg-4">
                                <div class="billing-info">
                                    <div class="title-box-info">Info of Client</div>
                                    <form id="form-info-client" name='buy' method="POST" action="/buy/check">

                                        <input type="text" name="name" value="<?php echo $user[0]->username;?>" required >
                                        <input type="text" name="phone" value="<?php echo $user[0]->phone;?>" required >
                                        <input type="email" name="email" value="<?php echo $user[0]->email;?>" required >
                                        <textarea name="address" placeholder="Address" required ><?php echo $user[0]->address;?></textarea>
                                        
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-sm-12 col-xs-4 col-md-4 col-lg-4">
                                    <div class="billing-info">
                                        <div class="title-box-info">Info of Client</div>
                                        <form id="form-info-client" name='buy' method="POST" action="/buy/check">

                                            <input type="text" name="name" value="" placeholder="Name"  required >
                                            <input type="text" name="phone" value="" placeholder="Phone" required >
                                            <input type="email" name="email" value ="" placeholder="Email" required >
                                            <textarea name="address" placeholder="Address" required ></textarea>
                                            <textarea name="note" placeholder="Note" ></textarea>
                                            
                                        </div>
                                        <span style="color: red">
                                            <?php
                                            if (isset($_SESSION['msg'])) {
                                                echo $_SESSION['msg'];
                                                unset($_SESSION['msg']);
                                            }
                                            ?>                                               
                                        </span>
                                    </div>

                                    <?php
                                }
                                ?>
                                


                                <div class="col-sm-12 col-xs-2 col-md-2 col-lg-2">
                                    <div class="payments">
                                        <div class="title-box-payments">Payments</div>
                                        <?php foreach ($arrPayments as $item) {
                                           ?>
                                           <div class="visa">
                                               <input type="radio" name="payments" value="<?php echo $item->id; ?>">
                                               <label for="visa"><?php echo $item->name; ?></label>
                                           </div>
                                           <?php
                                       } ?>
                                   </div>
                               </div>
                               <div class="col-sm-12 col-xs-6 col-md-6 col-lg-6">
                                <div class="summary-order">
                                    <div class="title-box-summary">Summary</div>
                                    <div class="content-summary">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        Product Name
                                                    </div>
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        Size
                                                    </div>
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                       Color
                                                   </div>
                                                   <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                    Quantity
                                                </div>
                                                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                    Price
                                                </div>
                                            </div>
                                        </li>

                                        <?php
                                        if (isset($arrStore)) {
                                            $totalPrice =0;
                                            foreach ($arrStore as $key => $value) {

                                                foreach ($_SESSION['cart'] as $k => $val) {
                                                    if ($k ==$key) {
                                                       $numCart =$val;
                                                       $totalPrice += $val* $value->price;
                                                   }
                                               }

                                               ?>
                                               <li>
                                                <div class=" row">
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        <?php echo $value->namesp?>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        <?php echo $value->size?>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        <?php echo $value->color?>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        <?php echo $numCart?>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        <?php echo ($numCart * $value->price)?>
                                                    </div>
                                                </div>
                                            </li>

                                            <?php
                                        }
                                    }
                                    ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">
                                                Totals :
                                            </div>
                                            <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                                <div class="total-cost"><?php echo $totalPrice?></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                                <button type='submit' name ='smBuy' class="submit">Submit</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section id="login-register">
    <div class="box-title-login">
        <span>Log in & Register</span>
        <button class="close" id="close-login-box">X</button>
    </div>
    <div class="box-content">
        <div class="cover-content">
            <div class="login">
                <div class="box-title">Log in</div>
                <input type="text" name="user-name" placeholder="User Name">
                <input type="" name="password" placeholder="Password">
                <button class="btn-login">Log in</button>
                <a class="forget-password" href="#">Forget password !</a>
            </div>
            <div class="register">
                <div class="box-title">Register</div>
                <input type="text" name="first-name" placeholder="First Name">
                <input type="text" name="last-name" placeholder="Last Name">
                <input type="text" name="user-name" placeholder="User Name">
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="password" placeholder="Password">
                <input type="text" name="re-password" placeholder="Re-Password">
                <div class="gender">
                    <span>Genders</span>
                    <input id="male" type="radio" name="gender">
                    <label for="male">Male</label>
                    <input id="female" type="radio" name="gender">
                    <label for="female">Female</label>
                </div>
                <div class="birthday">
                    <span>Birthday</span>
                    <input type="date" name="birthday">
                </div>
                <button class="btn-register">Register</button>
            </div>
        </div>

    </div>
</section>
</div>
<script type="text/javascript" src="/public/assets/js/appDetail.js"></script>
<?php
require dirname(__DIR__).'/public/require/footer.view.php';
?>
