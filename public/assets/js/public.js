$(document).ready(function() {
//======================search==================
$("#search_public").click(function() {
    var gender = $("select[name='gender']").val();
    var style = $("select[name='style']").val();
    var price = $("select[name='price']").val();

    $.ajax({
        url: 'search',
        type: 'POST',
        dataType: 'json',
        data: {
            'gender': gender,
            'style': style,
            'price': price,
        },
        success: function(result) {
            var html='<div class="box-title">Featutes</div>';
            $.each(result, function(key,item) {
             html+='<div class="product">'+
             '<div class="cover-img">'+
             '<a href="detail?id='+item.id_products_info+'">'+
             '<img src="/public/assets/img/'+item.image+'" alt="">'+
             '</a>'+
             '<div class="cover-btns">'+
             '<a href="cart.html" title="">'+
             '<button class="btn-add-cart">Add to Cart</button>'+
             '</a>'+
             '<a href="checkout.html" title="">'+
             '<button class="btn-buy-now">Buy Now</button>'+
             '</a>'+
             '</div>'+
             '</div>'+
             '<span class="name">'+item.name_product+'</span>'+
             '<span class="price">'+item.price+'</span>'+
             '</div>';
         })
            $('#search_products').html(html);
        },

        error: function(request, errorType, errorMessage) {
            alert(' Error : ' + errorType + ' with message ' + errorMessage);
        }
    });
});
//===========================validate gender to style==============
$("#gender").click(function() {
    var gender = $(this).val();

    $.ajax({
        url: 'getCat',
        type: 'POST',
        dataType: 'json',
        data: {
            'gender': gender,
        },
        success: function(result) {
            var html='';
            $.each(result, function(key,item) {
                html+='<option value="'+item.id+'">'+item.name+'</option>';
            })
            $('#style').html(html);
        },

        error: function(request, errorType, errorMessage) {
            alert(' Error : ' + errorType + ' with message ' + errorMessage);
        }
    });
});

//===========================validate style to gender==============
$("#style").click(function() {
    var style = $(this).val();
    $.ajax({
        url: 'getGender',
        type: 'POST',
        dataType: 'json',
        data: {
            'style': style,
        },
        success: function(result) {
            var html='';
            var male='';
            var female='';
            $.each(result, function(key,item) {
                if(item.gender==0){
                    male='';
                    female="selected='selected'";
                } else {
                    female='';
                    male="selected='selected'";
                }
                html+='<option '+ male +'value="1">Men</option>'+
                '<option '+female+' value="0">Women</option>';
            })
            $('#gender').html(html);
        },

        error: function(request, errorType, errorMessage) {
            alert(' Error : ' + errorType + ' with message ' + errorMessage);
        }
    });
});


});


