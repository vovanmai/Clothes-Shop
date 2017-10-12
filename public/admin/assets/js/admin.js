$(document).ready(function() {
    //change active users
    $(".edit_active").click(function() {
        var id = $(this).attr('id');
        var idstring = "#" + id;
        $.ajax({
            url: "/admin/users/active",
            type: "GET",
            data: {
                'id': id
            },
            success: function(data) {
                $(idstring).html(data);
            }
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
    //A check function will check all valid fields of the form.
    function check(){
        if(checkUsername&&checkPassword&&checkFullname&&checkEmail&&checkPhone&&checkAddress){
            $("#add-submit").removeAttr("disabled");

        }else{
            $("#add-submit").attr('disabled', true);
        }

    }
    $("#username").blur(function() {
        username=$(this).val();
        if(username==''){
            $('#username_warning_msg').html('<span style="color:red"><strong>Username</strong> is not empty !</span>');
            checkUsername=false;
            check();
        }else{
            $('#username_warning_msg').html('');
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
                        check();
                    }else{
                        checkUsername=true;
                        check();
                    }
                }

            });

        }

    });

    $("#password").blur(function() {
        password=$(this).val();
        if(password==''){
            $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong> is not empty !</span>');
            checkPassword=false;
            check();
        }else{
            $('#password_warning_msg').html('');
            if(password.length<6){
                $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong>  is more than 6 characters !</span>');
                checkPassword=false;
                check();
            }else if(password.length>12){
                $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong>  is less than 12 characters !</span>');
                checkPassword=false;
                check();
            }else{

                checkPassword=true;
                check();
            } 
        }

    });

    $("#fullname").blur(function() {
        fullname=$(this).val();
        if(fullname==''){
            $('#fullname_warning_msg').html('<span style="color:red"><strong>Fullname</strong> is not empty !</span>');
            checkFullname=false;
            check();
        }else{
            $('#fullname_warning_msg').html('');
            checkFullname=true;
            check();
        }
        
        
    });


    $("#email").blur(function() {
        email=$(this).val();
        if(email==''){
            $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is not empty !</span>');
            checkEmail=false;
            check();
        }else{
            $('#email_warning_msg').html('');
            var re = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/; 
            if(re.test(email)==false){
               $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is invalid !</span>');   
                checkEmail=false;
                check();
            }else{
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
                            check();
                        }else{
                            checkEmail=true;
                            check();
                        }
                    }

                });
            }
        }
        

    });
    $("#phone").blur(function() {
        phone=$(this).val();
        if(phone==''){
            $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is not empty !</span>'); 
            checkPhone=false;
            check();
        }else{
            $('#phone_warning_msg').html('');
                re1 =/^\d{10}$/;
                re2 =/^\d{11}$/;
                // if(re1.test(phone)==false||re2.test(phone)==false){
                //     $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is must 10 or 11 numbers !</span>');
                     
                // }
                if(re1.test(phone)==false){
                    if(re2.test(phone)==false){
                        $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is must 10 or 11 numbers !</span>');
                        checkPhone=false;
                        check();
                    }
                }else{
                    checkPhone=true;
                    check();                
                }
        }
        
    });
    $("#address").blur(function() {
        address=$(this).val();
        if(address==''){
            $('#address_warning_msg').html('<span style="color:red"><strong>Address</strong> is not empty !</span>');
            checkAddress=false;
            check();
        }else{
            $('#address_warning_msg').html('');
            checkAddress=true;
            check();
        }
        
    });
    // ============Edit Validate Users===============
    checkEditPassword=true;
    checkEditFullname=true;
    checkEditEmail=true;
    checkEditPhone=true;
    checkEditAddress=true;

    function checkEdit(){
        if(checkEditPassword&&checkEditFullname&&checkEditEmail&&checkEditPhone&&checkEditAddress){
            $("#edit-submit").removeAttr("disabled");
        }else{
            $("#edit-submit").attr('disabled', true);
        }

    }
    

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
            checkEditPassword=true;
            checkEdit(); 
        }

    });

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
                re1 =/^\d{10}$/;
                re2 =/^\d{11}$/;
                if(re1.test(phone)==false){
                    if(re2.test(phone)==false){
                        $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is must 10 or 11 numbers !</span>');
                        checkEditPhone=false;
                        checkEdit();
                    }
                }else{
                    checkEditPhone=true;
                    checkEdit();              
                }
        }   
        
    });
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

    $("#txtName").keyup(function() {
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
 })       