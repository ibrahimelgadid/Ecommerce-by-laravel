

    $('.delete').click(function(e){
        
        if(!confirm('Are you sure?')){
            e.preventDefault();
            return false;
        }else{
            return true;
        };
    })

    $('#search_cat').keyup(function(){
      var txt = $(this).val();
        $.ajax({
          method:"POST",
          url:'/admin/categories/search',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{search:txt},
          dataType:"text",
          success:function(data){
            $(".searched").html(data);
          }
        })
    });


    $('#search_product').keyup(function(){
      var txt = $(this).val();
      
        $.ajax({
          method:"POST",
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url:'/admin/products/search',
          data:{search:txt},
          dataType:"text",
          success:function(data){
            $(".searched").html(data);
          }
        })
    });

    $('#search_brand').keyup(function(){
      var txt = $(this).val();
      
        $.ajax({
          method:"POST",
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url:'/admin/brands/search',
          data:{search:txt},
          dataType:"text",
          success:function(data){
            $(".searched").html(data);
          }
        })
    });



    $('#search_member').keyup(function(){
      var txt = $(this).val();
      
        $.ajax({
          method:"POST",
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url:'/admin/members/search',
          data:{search:txt},
          dataType:"text",
          success:function(data){
            $(".searched").html(data);
          }
        })
    });

    $('#search_order').keyup(function(){
      var txt = $(this).val();
      
        $.ajax({
          method:"POST",
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url:'/admin/order/search',
          data:{search:txt},
          dataType:"text",
          success:function(data){
            $(".searched").html(data);
          }
        })
    });
    
    

    $('.buying').click(function(e){
        
      if(!confirm('Are you sure to buy?')){
          e.preventDefault();
          return false;
      }else{
          return true;
      };
  })


  $('.done').click(function(e){
        
    if(!confirm('Are you sure that this order done?')){
        e.preventDefault();
        return false;
    }else{
        return true;
    };
})


function paymentCheck() {
  let cash = document.getElementById('cash');
    if (cash.checked) {
      document.querySelector('.fa-money').style.cssText="border:2px solid red !important";
      document.querySelector('.fa-cc-paypal').style.cssText="";
    } else {
      document.querySelector('.fa-cc-paypal').style.cssText="border:2px solid red !important ";
      document.querySelector('.fa-money').style.cssText="";
    }
  }
