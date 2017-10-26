// Change active product_info
function chageActiveProductInfo(id){
    $.ajax({
        url: "/admin/product_info/active",
        type: "GET",
        data: {
            'id': id
        },
        success: function(data) {
            $('#active_product_info-'+id).html(data);
        }
    });
}
function chageActiveUsers(id){
    var idstring = "#"+id;
    $.ajax({
        url: "/admin/users/active",
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $(idstring).html(data);
        }
    });
}


$(document).ready(function() {
    //prevent submitting search form's input field value if it empty
    $('#search-orders').submit(function() {
        $(this).find('select:not(:has(option:selected[value!="-1"]))')
        .attr('name', '');
        $(this)
        .find('input[name]')
        .filter(function () {
            return !this.value;
        })
        .prop('name', '');
    });
    $('#search-users').submit(function() {
        $(this).find('select:not(:has(option:selected[value!="-1"]))')
        .attr('name', '');
        $(this)
        .find('input[name]')
        .filter(function () {
            return !this.value;
        })
        .prop('name', '');
    });
    //change active users
    $(document).on('click', '.edit_color', function(){
        var color_id = $(this).attr("id");
        $('#myModal').modal('show');
        $("#submitedit").click(function(event) {
            var name = $("#colorname").val();
            $.ajax({
                url: "/admin/colors/edit",
                type: "POST",
                data: {
                    'id': color_id,
                    'name': name
                },
                success: function(data) {
                    $("#name-"+color_id).html(data);
                    color_id = 0;
                }
            });
            $('#myModal').modal('hide');
            return false;
        });
    });
    $(".addcolor").click(function() {
        var scntDiv = $('#p_scents');
        var i = $('#p_scents tr').size() + 1;
        $('#myModal').modal('show');
        $("#submitedit").click(function(event) {
            var name = $("#colorname").val();
            $.ajax({
                url: "/admin/colors/add",
                type: "POST",
                data: {
                    'name': name
                },
                success: function(data) {
                    scntDiv.append(data);
                    i++;
                }
            });
            $('#myModal').modal('hide');
            return false;
        });
    });
    $(document).on('click', '.edit_size', function(){
        var size_id = $(this).attr("id");
        $('#myModal').modal('show');
        $("#submitedit").click(function(event) {
            var size = $("#sizename").val();
            $.ajax({
                url: "/admin/sizes/edit",
                type: "POST",
                data: {
                    'id': size_id,
                    'size': size 
                },
                success: function(data) {
                    $("#size-"+size_id).html(data);
                    size_id = 0;
                }
            });
            $('#myModal').modal('hide');
            return false;
        });
    });
    $(".addsize").click(function() {
        var scntDiv = $('#p_scents');
        var i = $('#p_scents tr').size() + 1;
        $('#myModal').modal('show');
        $("#submitedit").click(function(event) {
            var size = $("#sizename").val();
            $.ajax({
                url: "/admin/sizes/add",
                type: "POST",
                data: {
                    'size': size
                },
                success: function(data) {
                    scntDiv.append(data);
                    i++;
                }
            });
            $('#myModal').modal('hide');
            return false;
        });
    });
    
    // ==================Validate Add users============

    //default value
    checkUsername=false;
    checkPassword=false;
    checkFullname=false;
    checkEmail=false;
    checkPhone=false;
    checkAddress=false;

    //confirm password
    checkNewPass=false;
    checkConfirmPass=false;
    //A checkAdd function will check all valid fields of the added form.
    function checkAdd(){
        if(checkUsername&&checkPassword&&checkFullname&&checkEmail&&checkPhone&&checkAddress){
            $("#add-submit").removeAttr("disabled");

        }else{
            $("#add-submit").attr('disabled', true);
        }

    }
    //check Username.
    $("#username").blur(function() {
        username=$(this).val();
        if(username==''){
            $('#username_warning_msg').html('<span style="color:red"><strong>Username</strong> is not empty !</span>');
            checkUsername=false;
            checkAdd();
        }else{
            $('#username_warning_msg').html('');
            // ajax will check username existence. 
            $.ajax({
                url: "/admin/users/add/check_username",
                type: "GET",
                data: {
                    'username': username
                },
                
                success: function(data) {
                    if(data==0){
                        $('#username_warning_msg').html('<span style="color:red"><strong>Username</strong> is already taken !</span>');
                        checkUsername=false;
                        checkAdd();
                    }else{
                        checkUsername=true;
                        checkAdd();
                    }
                }

            });

        }

    });

    //check Password.
    $("#password").blur(function() {
        password=$(this).val();
        if(password==''){
            $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong> is not empty !</span>');
            checkPassword=false;
            checkAdd();
        }else{
            $('#password_warning_msg').html('');
            if(password.length<6){
                $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong>  is more than 6 characters !</span>');
                checkPassword=false;
                checkAdd();
            }else if(password.length>12){
                $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong>  is less than 12 characters !</span>');
                checkPassword=false;
                checkAdd();
            }else{

                checkPassword=true;
                checkAdd();
            } 
        }

    });
    //check Fullname
    $("#fullname").blur(function() {
        fullname=$(this).val();
        if(fullname==''){
            $('#fullname_warning_msg').html('<span style="color:red"><strong>Fullname</strong> is not empty !</span>');
            checkFullname=false;
            checkAdd();
        }else{
            $('#fullname_warning_msg').html('');
            checkFullname=true;
            checkAdd();
        }
        
        
    });

    //check Email
    $("#email").blur(function() {
        email=$(this).val();
        if(email==''){
            $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is not empty !</span>');
            checkEmail=false;
            checkAdd();
        }else{
            $('#email_warning_msg').html('');
            var re = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/; 
            if(re.test(email)==false){
             $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is invalid !</span>');   
             checkEmail=false;
             checkAdd();
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
                            $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is already taken !</span>');
                            checkEmail=false;
                            checkAdd();
                        }else{
                            checkEmail=true;
                            checkAdd();
                        }
                    }

                });
            }
        }
        

    });

    //check Phone
    $("#phone").blur(function() {
        phone=$(this).val();
        if(phone==''){
            $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is not empty !</span>'); 
            checkPhone=false;
            checkAdd();
        }else{
            $('#phone_warning_msg').html('');
            re1 =/^\d{10}$/;
            re2 =/^\d{11}$/;
            if(re1.test(phone)==false){
                if(re2.test(phone)==false){
                    $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is must 10 or 11 numbers !</span>');
                    checkPhone=false;
                    checkAdd();
                }
            }else{
                checkPhone=true;
                checkAdd();                
            }
        }
        
    });

    // check Address
    $("#address").blur(function() {
        address=$(this).val();
        if(address==''){
            $('#address_warning_msg').html('<span style="color:red"><strong>Address</strong> is not empty !</span>');
            checkAddress=false;
            checkAdd();
        }else{
            $('#address_warning_msg').html('');
            checkAddress=true;
            checkAdd();
        }
        
    });
    // ============Edit Validate Users===============
    checkEditPassword=true;
    checkEditFullname=true;
    checkEditEmail=true;
    checkEditPhone=true;
    checkEditAddress=true;

    //A checkEdit function will check all valid fields of the edited form.
    function checkEdit(){
        if(checkEditPassword&&checkEditFullname&&checkEditEmail&&checkEditPhone&&checkEditAddress){
            $("#edit-submit").removeAttr("disabled");
        }else{
            $("#edit-submit").attr('disabled', true);
        }

    }
    
    // check Password
    $("#edit_password").blur(function() {
        password=$(this).val();
        if(password!=''){
            if(password.length<6){
                $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong>  is more than 6 characters !</span>');
                checkEditFullname=false;    
                checkEdit();
            }else if(password.length>12){
                $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong>  is less than 12 characters !</span>');
                checkEditFullname=false;
                checkEdit();
            }else{
                $('#password_warning_msg').html('');
                checkEditPassword=true;
                checkEdit();
            }
        }else{
            $('#password_warning_msg').html('');
            checkEditPassword=false;
            checkEdit(); 
        }

    });

    //check Fullname
    $("#edit_fullname").blur(function() {
        fullname=$(this).val();
        if(fullname==''){
            $('#fullname_warning_msg').html('<span style="color:red"><strong>Fullname</strong> is not empty !</span>');
            checkEditFullname=false;
            checkEdit();
        }else{
            $('#fullname_warning_msg').html('');
            checkEditFullname=true;
            checkEdit(); 
        }    
    });

    //check Email
    $("#edit_email").blur(function() {
        email=$(this).val();
        parent=$(this).closest('#form_edit');
        id=parent.find('#edit_id').val();
        if(email==''){
            $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is not empty !</span>');
            $("#edit-submit").attr('disabled', true);
            checkEditEmail=false;
            checkEdit();
        }else{
            $('#email_warning_msg').html('');
            var re = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/; 
            if(re.test(email)==false){
                $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is invalid !</span>');   
                $("#edit-submit").attr('disabled', true);
                checkEditEmail=false;
                checkEdit();
            }else{
                // ajax will check email existence. 
                $.ajax({
                    url: "/admin/users/add/check_edit_email",
                    type: "GET",
                    data: {
                        'email': email,
                        'id': id
                    },
                    success: function(data) {
                        if(data==0){
                            $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is already taken !</span>');
                            $("#edit-submit").attr('disabled', true);
                            checkEditEmail=false;
                            checkEdit();
                        }else{
                            $("#edit-submit").removeAttr("disabled");
                            checkEditEmail=true;
                            checkEdit(); 
                        }
                    }

                });
            }
        }
        

    });
    $("#edit_phone").blur(function() {
        phone=$(this).val();
        if(phone==''){
            $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is not empty !</span>'); 
            checkEditPhone=false;
            checkEdit();
        }else{
            $('#phone_warning_msg').html('');
            regex =/^\d{10,11}$/;
            if(regex.test(phone)==false){
                $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is must 10 or 11 numbers !</span>');
                checkEditPhone=false;
                checkEdit();
            }else{
                        // alert('chay toi day');
                        checkEditPhone=true;
                        checkEdit();              
                    }
                }   
            });

    //check Address
    $("#edit_address").blur(function() {
        address=$(this).val();
        if(address==''){
            $('#address_warning_msg').html('<span style="color:red"><strong>Address</strong> is not empty !</span>');
            checkEditAddress=false;
            checkEdit();
        }else{
            $('#address_warning_msg').html('');
            checkEditAddress=true;
            checkEdit();
        }
        
    }); 
    //remember me

    $("#txtName").blur(function() {
        var userName = ($('#txtName').val()).trim();
        $.ajax({
            url: '/admin/remember',
            type: 'POST',
            dataType: 'json',
            data: {
                aName: userName,
            },
            success: function(result) {
                $.each(result, function() {
                    var html = ' ';
                    html += result.password;
                    if (html != ' ') {
                        $('#password').val(html);
                    }

                })
            },

            error: function(request, errorType, errorMessage) {
                alert(' Error : ' + errorType + ' with message ' + errorMessage);
            }
        });
    });

    //check confirm pass
    function checkConfirm(){
        if(checkNewPass&&checkConfirmPass){
            $("#smGetPass").removeAttr("disabled");
            checkNewPass = false;
            checkConfirmPass = false ;

        }else{
            $("#smGetPass").attr('disabled', true);
        }

    }

    $("#sendPass").mouseover(function() {
        newPass = ($('#newpass').val()).trim();
        confirmPass = ($('#passwordAgain').val()).trim();
        
        if ( newPass != confirmPass) {
            checkConfirm();
        } else {
            checkNewPass = true;
            checkConfirmPass = true ;

            checkConfirm();
        }
    }); 


    //  // ==================Validate Search date_order orders============
    //  $("#date_order").blur(function() {
    //     date_order=$(this).val();
    //     if(date_order!=''){
    //         var re = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/; 
    //         if(re.test(date_order)==false){
    //             alert('Wrongly formatted Dates');
    //             $("#date_order").focus();
    //             return false;
    //         }
    //     }

    // });

     //change active paid order
     $(".edit_paid_active").click(function() {
        var data=$(this).attr('id');
        var id = data.split('-')[1];
        var idstring = "#paid-" + id;
        $.ajax({
            url: "/admin/orders/activePaid",
            type: "GET",
            data: {
                'id': id
            },
            success: function(data) {
                $(idstring).html(data);
            }
        });
    });
    
    //change active shipped order
    $(".edit_shipped_active").click(function() {
       var data=$(this).attr('id');
       var id = data.split('-')[1];
       var idstring = "#shipped-" + id;
       $.ajax({
        url: "/admin/orders/activeShipped",
        type: "GET",
        data: {
            'id': id
        },
        success: function(data) {
            $(idstring).html(data);
        }
    });
   });

     //save status order
     $(".status").change(function() {
         var data=$(this).attr('id');
         var id = data.split('-')[1];
         var status = $(this).val();
         $.ajax({
            url: "/admin/orders/updateStatus",
            type: "GET",
            data: {
                'status': status,
                'id':id
            },
            success: function(data) {
                alert(data);
            }
        });
     });

      //save status order
      $("#checkall").click(function(){
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });

//check del All button order
$("#delAll").click(function(){
    var checked = $("input[name='dels[]']:checked").length;
    if (checked == 0) {
        confirm('have not choose object yet');
        return false;
    } else {
        if(confirm('Are you sure to delete ? ')){
            return true;
        } else {
            return false;
        }
        
    }
});

// ================PRODUCT INFO===================

/// Add 
check_product_info_name=false;
check_product_info_cat=false;
check_product_info_imgae=false;
check_product_info_price=false;
check_product_info_desc=false;

function check_product_info_add(){
    if(check_product_info_name&&check_product_info_cat&&check_product_info_imgae&&check_product_info_price&&check_product_info_desc){
        $("#product_info_add_submit").removeAttr("disabled");
    }else{
        $("#product_info_add_submit").attr('disabled', true);
    }
}

$("#name").blur(function() {
    name=$(this).val();
    if(name==''){
        $('#name_warning_msg').html('<span style="color:red"><strong>Name</strong> is not empty !</span>');
        check_product_info_name=false;
        check_product_info_add();
    }else{
        $('#name_warning_msg').html('');
        check_product_info_name=true;
        check_product_info_add();
    }
});

$("#category").blur(function() {
    category=$(this).val();
    if(category==0){
        $('#category_warning_msg').html('<span style="color:red"><strong>Category</strong> is not empty !</span>');
        check_product_info_cat=false;
        check_product_info_add();
    }else{
        $('#category_warning_msg').html('');
        check_product_info_cat=true;
        check_product_info_add();
    }
});


$("#price").blur(function() {
    price=$(this).val();
    if(price==''){
        $('#price_warning_msg').html('<span style="color:red"><strong>Price</strong> is not empty !</span>');
        check_product_info_price=false;
        check_product_info_add();
    }else{
        if(isNaN(price)){
            $('#price_warning_msg').html('<span style="color:red"><strong>Price</strong> must a number!</span>');
            check_product_info_price=false;
            check_product_info_add();
        }else{
            $('#price_warning_msg').html('');
            check_product_info_price=true;
            check_product_info_add();

        }
    }
});


$("#description").blur(function() {
    description=$(this).val();
    if(description==''){
        $('#description_warning_msg').html('<span style="color:red"><strong>Description</strong> is not empty !</span>');
        check_product_info_desc=false;
        check_product_info_add();
    }else{
        $('#description_warning_msg').html('');
        check_product_info_desc=true;
        check_product_info_add();
    }
});

$("#image").blur(function() {
    image=$(this).val();
    if(image==''){
        $('#image_warning_msg').html('<span style="color:red"><strong>Image</strong> is not empty !</span>');
        check_product_info_imgae=false;
        check_product_info_add();
    }else{
        $('#image_warning_msg').html('');
        check_product_info_imgae=true;
        check_product_info_add();
    }
});

// Edit 

check_product_info_edit_name=true;
check_product_info__edit_cat=true;
check_product_info_edit_imgae=true;
check_product_info_edit_price=true;
check_product_info_edit_desc=true;

function check_product_info_edit(){
    if(check_product_info_edit_name&&check_product_info__edit_cat&&check_product_info_edit_imgae&&check_product_info_edit_price&&check_product_info_edit_desc){
        $("#product_info_edit_submit").removeAttr("disabled");
    }else{
        $("#product_info_edit_submit").attr('disabled', true);
    }
}

$("#product_info_edit_name").blur(function() {
    name=$(this).val();
    if(name==''){
        $('#name_warning_msg').html('<span style="color:red"><strong>Name</strong> is not empty !</span>');
        check_product_info_edit_name=false;
        check_product_info_edit();
    }else{
        $('#name_warning_msg').html('');
        check_product_info_edit_name=true;
        check_product_info_edit();
    }
});

$("#product_info_edit_cat").blur(function() {
    category=$(this).val();
    if(category==0){
        $('#category_warning_msg').html('<span style="color:red"><strong>Category</strong> is not empty !</span>');
        check_product_info__edit_cat=false;
        check_product_info_edit();
    }else{
        $('#category_warning_msg').html('');
        check_product_info__edit_cat=true;
        check_product_info_edit();
    }
});


$("#product_info_edit_price").blur(function() {
    price=$(this).val();
    if(price==''){
        $('#price_warning_msg').html('<span style="color:red"><strong>Price</strong> is not empty !</span>');
        check_product_info_edit_price=false;
        check_product_info_edit();
    }else{
        if(isNaN(price)){
            $('#price_warning_msg').html('<span style="color:red"><strong>Price</strong> must a number!</span>');
            check_product_info_edit_price=false;
            check_product_info_add();
        }else{
            $('#price_warning_msg').html('');
            check_product_info_edit_price=true;
            check_product_info_edit();

        }
    }
});


$("#product_info_edit_description").blur(function() {
    description=$(this).val();
    if(description==''){
        $('#description_warning_msg').html('<span style="color:red"><strong>Description</strong> is not empty !</span>');
        check_product_info_edit_desc=false;
        check_product_info_edit();
    }else{
        $('#description_warning_msg').html('');
        check_product_info_edit_desc=true;
        check_product_info_edit();
    }
});

$("#product_info_edit_image").blur(function() {
    image=$(this).val();
    if(image==''){
        $('#image_warning_msg').html('<span style="color:red"><strong>Image</strong> is not empty !</span>');
        check_product_info_edit_imgae=false;
        check_product_info_edit();
    }else{
        $('#image_warning_msg').html('');
        check_product_info_edit_imgae=true;
        check_product_info_edit();
    }
});

// ================PRODUCTS===============
//Add
check_products_product_info_id_add=false;
check_product_color_add=false;
check_products_size_add=false;
check_products_quantity_add=false;
function check_products_add()
{
    
    if(check_products_product_info_id_add&&check_product_color_add&&check_products_size_add&&check_products_quantity_add){
        $("#products_submit123").removeAttr("disabled");
    }else{
        $("#products_submit123").attr('disabled', true);
    }
}
$("#product_info_id").blur(function() {
    product_info_id=$(this).val();
    if(product_info_id==0){
        $('#product_info_id_warning_msg').html('<span style="color:red"><strong>Product Info</strong> is not empty !</span>');
        check_products_product_info_id_add=false;
        check_products_add();
    }else{
        $('#product_info_id_warning_msg').html('');
        check_products_product_info_id_add=true;
        check_products_add();
    }
}); 

$("#products_color").blur(function() {
    product_color=$(this).val();
    if(product_color==0){
        $('#products_color_warning_msg').html('<span style="color:red"><strong>Color</strong> is not empty !</span>');
        check_product_color_add=false;
        check_products_add();
    }else{
        $('#products_color_warning_msg').html('');
        check_product_color_add=true;
        check_products_add();
    }
});
$("#products_size").blur(function() {
    products_size=$(this).val();
    if(products_size==0){
        $('#products_size_warning_msg').html('<span style="color:red"><strong>Size</strong> is not empty !</span>');
        check_products_size_add=false;
        check_products_add();
    }else{
        $('#products_size_warning_msg').html('');
        check_products_size_add=true;
        check_products_add();
    }
});

$("#quantity").blur(function() {
    quantity=$(this).val();
    if(quantity==''){
        $('#products_quantity_warning_msg').html('<span style="color:red"><strong>Quantity</strong> is not empty !</span>');
        check_products_quantity_add=false;
        check_products_add();
    }else{
        if(isNaN(quantity)){
            $('#products_quantity_warning_msg').html('<span style="color:red"><strong>Quantity</strong> must a number!</span>');
            check_products_quantity_add=false;
            check_products_add();
        }else{
            $('#products_quantity_warning_msg').html('');
            check_products_quantity_add=true;
            check_products_add();

        }
    }
});


// Edit 
check_product_info_id_edit=true;
check_product_color_edit=true;
check_products_size_edit=true;
check_products_quantity_edit=true;
function check_products_edit()
{
    if(check_product_info_id_edit&&check_product_color_edit&&check_products_size_edit&&check_products_quantity_edit){
        $("#products_submit").removeAttr("disabled");
    }else{
        $("#products_submit").attr('disabled', true);
    }
}


$("#product_info_id").blur(function() {
    product_info_id=$(this).val();
    if(product_info_id==0){
        $('#product_info_id_warning_msg').html('<span style="color:red"><strong>Product Info</strong> is not empty !</span>');
        check_product_info_id_edit=false;
        check_products_edit();
    }else{
        $('#product_info_id_warning_msg').html('');
        check_product_info_id_edit=true;
        check_products_edit();
    }
}); 

$("#products_color").blur(function() {
    product_color=$(this).val();
    if(product_color==0){
        $('#products_color_warning_msg').html('<span style="color:red"><strong>Color</strong> is not empty !</span>');
        check_product_color_edit=false;
        check_products_edit();
    }else{
        $('#products_color_warning_msg').html('');
        check_product_color_edit=true;
        check_products_edit();
    }
});
$("#products_size").blur(function() {
    products_size=$(this).val();
    if(products_size==0){
        $('#products_size_warning_msg').html('<span style="color:red"><strong>Size</strong> is not empty !</span>');
        check_products_size_edit=false;
        check_products_edit();
    }else{
        $('#products_size_warning_msg').html('');
        check_products_size_edit=true;
        check_products_edit();
    }
});

$("#quantity").blur(function() {
    quantity=$(this).val();
    if(quantity==0){
        $('#products_quantity_warning_msg').html('<span style="color:red"><strong>Quantity</strong> is not empty !</span>');
        check_products_quantity_edit=false;
        check_products_edit();
    }else{
        if(isNaN(quantity)){
            $('#products_quantity_warning_msg').html('<span style="color:red"><strong>Quantity</strong> must a number!</span>');
            check_products_quantity_edit=false;
            check_products_edit();
        }else{
            $('#products_quantity_warning_msg').html('');
            check_products_quantity_edit=true;
            check_products_edit();

        }
    }
});
})

