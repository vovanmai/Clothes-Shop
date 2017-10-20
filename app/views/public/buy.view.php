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
                                <div class="col-sm-12 col-xs-4 col-md-4 col-lg-4">
                                    <div class="billing-info">
                                        <div class="title-box-info">Info of Client</div>
                                        <form id="form-info-client" name='buy' method="POST" action="/buy/check">

                                            <input type="text" name="name" placeholder="Full name">
                                            <input type="text" name="phone" placeholder="Phone Number">
                                            <input type="email" name="email" placeholder="Email">
                                            <textarea name="address" placeholder="Address"></textarea>
                                       
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-4 col-md-4 col-lg-4">
                                    <div class="payments">
                                        <div class="title-box-payments">Payments</div>
                                        <div class="visa">
                                            <input id="visa" type="radio" name="payments">
                                            <label for="visa">Visa</label>
                                        </div>

                                        <div class="atm">
                                            <input id="atm" type="radio" name="payments">
                                            <label for="atm">ATM</label>
                                        </div>

                                        <div class="received">
                                            <input id="received" type="radio" name="payments">
                                            <label for="received">When received product</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-4 col-md-4 col-lg-4">
                                    <div class="summary-order">
                                        <div class="title-box-summary">Summary</div>
                                        <div class="content-summary">
                                            <ul>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                                            Product Name
                                                        </div>
                                                        <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                                            Quantity
                                                        </div>
                                                        <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                                            Price
                                                        </div>
                                                    </div>
                                                </li>
                                              
                                            
                                                <li>
                                                    <div class=" row">
                                                        <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                                            product name
                                                        </div>
                                                        <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                                            2
                                                        </div>
                                                        <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                                            $200,0/1 item
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">
                                                            Totals :
                                                        </div>
                                                        <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                                            <div class="total-cost">$900,0</div>
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
