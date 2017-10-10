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
        if(username==''){
            $('#username_warning_msg').html('<span style="color:red"><strong>Username</strong> không được rỗng</span>');
            return false;
        }else{
            $('#username_warning_msg').html('');
        }

        if(password==''){
            $('#password_warning_msg').html('<span style="color:red"><strong>Password</strong> không được rỗng</span>');
            return false;
        }else{
            $('#password_warning_msg').html('');
        }

        if(fullname==''){
            $('#fullname_warning_msg').html('<span style="color:red"><strong>Fullname</strong> không được rỗng</span>');
            return false;
        }else{
            $('#fullname_warning_msg').html('');
        }

        if(email==''){
            $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> không được rỗng</span>');
            return false;
        }else{
            $('#email_warning_msg').html('');
        }

        if(phone==''){
            $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> không được rỗng</span>');
            return false;
        }else{
            $('#phone_warning_msg').html('');
        }

        if(address==''){
            $('#address_warning_msg').html('<span style="color:red"><strong>Address</strong> không được rỗng</span>');
            return false;
        }else{
            $('#address_warning_msg').html('');
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