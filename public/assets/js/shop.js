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

      $(".subCart").click(function() {

            var idProduct= $(this).next("input[type=text]").attr('id');
            var currentNum= $(this).next("input[type=text]").attr('value');
         
            if ( currentNum ==1) {
                 $("#sub").attr('disabled', true);
            } else {

                  $.ajax({
                    url: '/cart/subCart',
                    type: 'POST',
                    dataType : 'text',
                    data: {
                       
                        aNumber: currentNum,
                        aID :idProduct
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
                    if(result==0) {
                        $('#notify').html('San pham het hang !');
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
                            html = "Con ";
                            html += number;
                            html += " san pham.Vui long kiem tra lai";
                             $('#notify').html(html);
                             
                         } else {

                                if (check == 1 ) {
                                    html ="<span class='indicator'>";
                                    html +=number;
                                    html +="</span>";
                                    $('.showCart').html(html);
                                    $('#notify').html("Them thanh cong !");
                                    
                                }
                         }


                    }         
                    
                },

                error: function(request, errorType, errorMessage) {
                    alert(' Error : ' + errorType + ' with message ' + errorMessage);
                }
            });
    });
       

})