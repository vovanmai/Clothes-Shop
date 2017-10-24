$(document).ready(function() {


    $("#plus").click(function() {
        $("#sub").removeAttr("disabled");
        var currentNumber = $('#num').val();
        $.ajax({
            url: '/detail/PlusNumber',
            type: 'POST',
            dataType : 'text',
            data: {
               
                aNumber: currentNumber,
            },
            success: function(result) {
                            
                $('#number').html(result);
            },

            error: function(request, errorType, errorMessage) {
                alert(' Error : ' + errorType + ' with message ' + errorMessage);
            }
        });
    });

   


    $("#sub").click(function() {
        var currentNumber = $('#num').val();
        if ( currentNumber ==1) {
             $("#sub").attr('disabled', true);
        } else {
             

            $.ajax({
                url: '/detail/SubNumber',
                type: 'POST',
                dataType : 'text',
                data: {
                   
                    aNumber: currentNumber,
                },
                success: function(result) {
                                
                    $('#number').html(result);
                },

                error: function(request, errorType, errorMessage) {
                    alert(' Error : ' + errorType + ' with message ' + errorMessage);
                }
            });
        }
    });

    $(".plusCart").click(function() {
        $(".subCart").removeAttr("disabled");
        var idProduct= $(this).prev("input[type=text]").attr('id');
        var currentNum= $(this).prev("input[type=text]").attr('value');
    });

    $('#buyproduct').click(function(){
        
        var obj = {};
        var para= $(".numProd");
            para.each(function (){
            var num = $(this).val();
            var id = $(this).attr('id').substr(4);
            obj[id] = num;
        });
        console.log(obj);    
        var json= JSON.stringify(obj);

        $.ajax({
            url: '/cart/updateCart',
            type: 'GET',
            dataType : 'json',
            data: {
                aJson: json,
            },
            success: function(result) {
                  var number; 
                  var totalAll=0;              
                  $.each(result, function(key,val) {

                        if(key=='quantity') {
                            number = val;
                        }else {
                             var price =$('#price-'+key).text();
                            var totalPrice = price*val;
                            $('#totalPrice-'+key).html(totalPrice);
                           totalAll +=totalPrice;
                        }

                  })

                 
                       html ="<span class='indicator'>";
                        html +=number;
                        html +="</span>";
                        $('.showCart').html(html);

                        // $.each(result, function(key,val) {

                        //     var price =$('#price-'+key).val();
                        //     var totalPrice = price*val;
                        //     $('#totalPrice-'+key).html(totalPrice);
                        //    totalAll +=totalPrice;
                        // })


                          $('#priceCart').text(totalAll);
            },

            error: function(request, errorType, errorMessage) {
                alert(' Error : ' + errorType + ' with message ' + errorMessage);
            }


        });

    
     });



        $("#addCart").click(function() {
        var size = $('#size').val();
        var color = $('#colors').val();
        var product_info_id = $('#product_info').val();
        var num = $('#num').val();
            $.ajax({
                url: '/detail/addCart',
                type: 'POST',
                dataType : 'json',
                data: {
                   
                    aSize : size,
                    aColor : color,
                    aProduct_info_id : product_info_id,
                    aNum :num
                },
                success: function(result) {
                    var check;
                    var number ;
                    var html='';
                    if(result==0){
                        $('#notify').html('Product is out of stock!');
                    } else {
                        $.each(result, function(key,val) {
                            if(key=='check') {
                                check = val;
                            } 
                            if(key == 'quantity') {
                                number = val ;
                            }
                        })

                        if (check==2) {
                            html = "Only ";
                            html += number;
                            html += " products in stock.Please check again!";
                            $('#notify').html(html);
                        }else{
                            if (check == 1 ) {
                                html ="<span class='indicator'>";
                                html +=number;
                                html +="</span>";
                                $('.showCart').html(html);
                                $('#notify').html("Added to cart successfully !");
                            }
                        }
                    }         
                },
                error: function(request, errorType, errorMessage) {
                    alert(' Error : ' + errorType + ' with message ' + errorMessage);
                }
            });
    });



   //==============LOGIN============
   
   $("#login-submit").click(function() {
        parent=$(this).closest('form');
        username=parent.find('#login-username').val();
        password=parent.find('#login-password').val();
        if(username==''&&password==''){
            $('#login-username-warning').html('<span style="color:red">Username is not empty !</span>');         
            $('#login-password-warning').html('<span style="color:red">Password is not empty !</span>');         
            return false;
        }
        if(username==''){
            $('#login-username-warning').html('<span style="color:red">Username is not empty !</span>');         
            return false;
        }else{
            $('#login-username-warning').html('');         

        }

        if(password==''){
            $('#login-password-warning').html('<span style="color:red">Password is not empty !</span>');         
            return false;
        }else{
            $('#login-password-warning').html('');
        }
        $.ajax({
            url: '/login',
            type: 'POST',
            data: {
                username: username,
                password: password
            },
            success: function(result) {
                if(result==1){
                    alert('Login Successfully !');
                    window.location="";
                }
                if(result==2){
                    $('#login_msg').html('<span style="color:red;">Username and password is incorrect !</span>');
                }
            }

           
        });
    });



   $("#register_submit").click(function() {
        parent=$(this).closest('form');
        username=parent.find('#register_username').val();
        fullname=parent.find('#register_fullname').val();
        email=parent.find('#register_email').val();
        password=parent.find('#register_password').val();
        gender=$('input[name="gender"]:checked').val();
        $.ajax({
            url: '/register',
            type: 'POST',
            data: {
                username: username,
                fullname: fullname,
                email: email,
                password: password,
                gender: gender
            },
            success: function(data) {
                if(data==1){
                    $('#success_register_msg').html('<span style="color:green;font-weight:bold">You registered successfully. Please login at side ! </span>'); 
                }
            }
           
        });
    });

   // =================Validate===============
   check_register_username=false;
   check_register_fullname=false;
   check_register_email=false;
   check_register_password=false;

    function checkRegister()
    {
        if(check_register_username&&check_register_fullname&&check_register_email&&check_register_password){
            $("#register_submit").removeAttr("disabled");
        }else{
            $("#register_submit").attr('disabled', true);
        }
    }
    $('#register_username').blur(function() {
        username=$(this).val();
        if(username==0){
            $('#register-username-warning').html('<span style="color:red"><strong>Username </strong> is not empty !</span>');
           
        }else{
            $.ajax({
                url: "/admin/users/add/check_username",
                type: "GET",
                data: {
                    'username': username
                },
                
                success: function(data) {
                    if(data==0){
                        $('#register-username-warning').html('<span style="color:red"><strong>Username</strong> is already taken !</span>');
                        check_register_username=false;
                        checkRegister();
                    }else{
                        check_register_username=true;
                        $('#register-username-warning').html('');
                        checkRegister();
                    }
                }

            });
        }
    });
    $('#register_fullname').blur(function() {
        fullname=$(this).val();
        if(fullname==''){
            $('#register-fullname-warning').html('<span style="color:red"><strong>Fullname </strong> is not empty !</span>');
           
        
        }else{
            $('#register-fullname-warning').html('');
            check_register_fullname=true;
            checkRegister();
         
        }
    });

    $("#register_email").blur(function() {
        email=$(this).val();
        if(email==''){
            $('#register-email-warning').html('<span style="color:red"><strong>Email</strong> is not empty !</span>');
            check_register_email=false;
            checkRegister();
        }else{
            $('#register-email-warning').html('');
            var re = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/; 
            if(re.test(email)==false){
               $('#register-email-warning').html('<span style="color:red"><strong>Email</strong> is invalid !</span>');
               check_register_email=false;
               checkRegister();
           }else{
                // ajax will check email existence. 
                $.ajax({
                    url: "/admin/users/add/check_add_email",
                    type: "GET",
                    data: {
                        'email': email
                    },
                    
                    success: function(data) {
                        if(data==0){
                            $('#register-email-warning').html('<span style="color:red"><strong>Email</strong> is already taken !</span>');
                            check_register_email=false;
                            checkRegister();
                        }else{
                            check_register_email=true;
                            checkRegister();
                        }
                    }

                });
            }
        }
    });

    $('#register_password').blur(function() {
        password=$(this).val();
        if(password==''){
            $('#register-password-warning').html('<span style="color:red"><strong>Password </strong> is not empty !</span>');
           
        }else{
            $('#register-password-warning').html('');
            check_register_password=true;
            checkRegister();
         
        }
    });
        

})