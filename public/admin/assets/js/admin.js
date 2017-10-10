$(document).ready(function(){
      $(".edit_active").click(function (){        
        var id=$(this).attr('id');
        var idstring="#"+id;
        $.ajax({
                url:"/admin/users/active",
                type:"GET",
                data:{'id':id},
                success: function (data){
                $(idstring).html(data);
              }
            });
      });
    });