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
            para.each(function (index) {
            var num = $(this).val();

            var id = $(this).attr('id').substr(4);

            obj[id] = num;
           
       });

        var json= JSON.stringify(obj);

        
       $.ajax({
            url: '/cart/updateCart',
            type: 'GET',
            dataType : 'json',
            data: {
               
                aJson: json,
            },
            success: function(result) {

                  var check;
                  var result1 ={};
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