function paging(controller,page) {
        $.ajax({
            url: '/admin/'+controller,
            type: 'GET',
            dataType: 'json',
            data:'page='+page,            
            success: function(result) {
                $('tbody').html(result.tbody);
                $('#paging').html(result.paging);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
              }
        });
    }
$(document).ready(function() {
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
    $(".edit_active").click(function() {
        var id = $(this).attr('id');
        var idstring = "#" + id;
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
})       