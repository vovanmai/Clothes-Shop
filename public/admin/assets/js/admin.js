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
    $("#add-submit").click(function() {
        var parent=$(this).closest('form');
        var username =parent.find('#username').val();
        var password =parent.find('#password').val();
        var fullname =parent.find('#fullname').val();
        var email =parent.find('#email').val();
        var phone =parent.find('#phone').val();
        var email =parent.find('#email').val();
        var address =parent.find('#address').val();
        var check;
        if(username==''){
            $('#username_warning_msg').html('<span style="color:red"><strong>Username</strong> is not empty !</span>');
            check = false;
        }else{
            $('#username_warning_msg').html(''); 
            
            $.ajax({
                url: "/admin/users/add/check_username",
                type: "GET",
                data: {
                    'username': username
                },
                async: false,
                success: function(data) {
                    if(data==0){
                        $('#username_warning_msg').html('<span style="color:red"><strong>Username</strong> is already taken !</span>');
                        check=false;
                    }
                }

            });
        }

        if(password==''){
            $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong> is not empty !</span>');
            check = false;
        }else{
            $('#password_warning_msg').html('');
            if(password.length<6){
                $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong>  is more than 6 characters !</span>');
               check = false;
            }else if(password.length>12){
                $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong>  is less than 12 characters !</span>');
                check = false;
            }
        }

        if(fullname==''){
            $('#fullname_warning_msg').html('<span style="color:red"><strong>Fullname</strong> is not empty !</span>');
            check = false;
        }else{
            $('#fullname_warning_msg').html('');
        }

        if(email==''){
            $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is not empty !</span>');
            check = false;
        }else{
            $('#email_warning_msg').html('');
            var re = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/; 
            if(!re.test(email)){
                $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is invalid !</span>');
                check = false;
            }
            
            $.ajax({
                url: "/admin/users/add/check_email",
                type: "GET",
                data: {
                    'email': email
                },
                async: false,
                success: function(data) {
                    if(data==0){
                        
                        $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is already taken !</span>');
                        check=false;
                    }
                }
            });  
        }

        if(phone==''){
            $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is not empty !</span>');
            check = false;
        }else{
            $('#phone_warning_msg').html('');
            re1 =/^\d{10}$/;
            re2 =/^\d{11}$/;
            if(!re1.test(phone)){
                if(!re2.test(phone)){
                    $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is must 10 or 11 numbers !</span>');
                    check=false;
                }
            }

            
        }

        if(address==''){
            $('#address_warning_msg').html('<span style="color:red"><strong>Address</strong> is not empty !</span>');
            check = false;
        }else{
            $('#address_warning_msg').html('');

        }
        if(check ==false){
            return false;
        }
    // ==================Validate Edit users============
    });
    $("#edit-submit").click(function() {
        var parent=$(this).closest('form');
        
        var password =parent.find('#password').val();
        var fullname =parent.find('#fullname').val();
        var email =parent.find('#email').val();
        var phone =parent.find('#phone').val();
        var email =parent.find('#email').val();
        var address =parent.find('#address').val();
        var check;
        
        if(password==''){
            $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong> is not empty !</span>');
            check = false;
        }else{
            $('#password_warning_msg').html('');
            if(password.length<6){
                $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong>  is more than 6 characters !</span>');
               check = false;
            }else if(password.length>12){
                $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong>  is less than 12 characters !</span>');
                check = false;
            }
        }

        if(fullname==''){
            $('#fullname_warning_msg').html('<span style="color:red"><strong>Fullname</strong> is not empty !</span>');
            check = false;
        }else{
            $('#fullname_warning_msg').html('');
        }

        if(email==''){
            $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is not empty !</span>');
            check = false;
        }else{
            $('#email_warning_msg').html('');
            var re = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/; 
            if(!re.test(email)){
                $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is invalid !</span>');
                check = false;
            }
            
            $.ajax({
                url: "/admin/users/add/check_email",
                type: "GET",
                data: {
                    'email': email
                },
                async: false,
                success: function(data) {
                    if(data==0){
                        
                        $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> is already taken !</span>');
                        check=false;
                    }
                }
            });  
        }

        if(phone==''){
            $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is not empty !</span>');
            check = false;
        }else{
            $('#phone_warning_msg').html('');
            re1 =/^\d{10}$/;
            re2 =/^\d{11}$/;
            if(!re1.test(phone)){
                if(!re2.test(phone)){
                    $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is must 10 or 11 numbers !</span>');
                    check=false;
                }
            }

            
        }

        if(address==''){
            $('#address_warning_msg').html('<span style="color:red"><strong>Address</strong> is not empty !</span>');
            check = false;
        }else{
            $('#address_warning_msg').html('');

        }
        if(check ==false){
            return false;
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