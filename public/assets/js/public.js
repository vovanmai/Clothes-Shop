function paging(action, page_num) {
    if(action == 'indexpaging') {
    allpage = $('#count').val();
    $.ajax({
        url: '/',
        type: 'GET',
        data:'page='+page_num+'&allpage='+allpage,            
        success: function(result) {
            $('.products').html(result);
          
        },
    });
    } else {
        var style = $("select[name='style']").val();
        var price = $("select[name='price']").val();
        $.ajax({
            url: '/search',
            type: 'GET',
            data:'page='+page_num+'&style='+style+'&price='+price,            
            success: function(result) {
                $('.products').html(result);
            },
            error: function(data) {
                alert("Sai");
            }
        });
    }
}

$(document).ready(function() {
    $("#gender").click(function() {
        var gender = $(this).val();
    
        $.ajax({
            url: 'getCat',
            type: 'POST',
            data: {
                'gender': gender,
            },
            success: function(result) {
                $('#style').html(result);
            },
    
            error: function(request, errorType, errorMessage) {
                alert(' Error : ' + errorType + ' with message ' + errorMessage);
            }
        });
    });

});


