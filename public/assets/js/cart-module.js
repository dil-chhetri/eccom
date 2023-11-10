$(document).ready(function(){
    $(document).on("click", ".increase", function (e) {
        e.preventDefault();
        
        var qty = $(this).closest(".cart_data").find(".quantity-amount").val();
    
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
          value++;
    
          $(this).closest(".cart_data").find(".quantity-amount").val(value);
        }
      });
    
      $(document).on("click", ".decrease", function (e) {
        e.preventDefault();
    
        var qty = $(this).closest(".cart_data").find(".quantity-amount").val();
    
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
          value--;
    
          $(this).closest(".cart_data").find(".quantity-amount").val(value);
        }
      });

$(document).on("click", ".updateQuantity", function () {
    var quantity = $(this).closest(".cart_data").find(".quantity-amount").val();
    var cart_id = $(this).closest(".cart_data").find(".cartId").val();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
      }
  });
    $.ajax({
        method: 'POST',
        url: '/update-cart/' + cart_id,
        data: {
            cart_id: cart_id,
            quantity: quantity,
            _token: $('meta[name="csrf-token"]').attr('content'),
      
        },
        success: function (response) {
            // alert("Quantity updated successfully");
            $("#cart").load(window.location.href + " #cart");
           

        },
        error: function (xhr, status, error) {
            console.error("Error updating quantity:", error);
        }
    });
});


$(document).on("click",".addCart", function (e) {
  e.preventDefault();
  var container = $(this).closest(".product")
  var product_id = container.find(".product_id").val();
  var user_id = container.find(".user_id").val();
  var quantity = 1;
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
    }
    });
  $.ajax({
    method: 'POST',
    url: '/add-to-cart',
    data: {
      product_id:product_id,
      quantity:quantity,
      
    },
   
    success: function (response) {
      if(response == 201)
        {
           alertify.success("Product added to cart");
           $( "#mycart" ). load(window. location. href + " #mycart" ); 
           load_cart_item_number();
           
        }
        else if(response == 'exist')
        {
           alert("Product already in cart");
        }
        else if(response == 401)
        {
            alertify.success("Login to continue");
        }
        else if(response == 500)
        {
            alertify.success("Something went wrong");

        }
    }
  });
  
});

$(document).on('click','.remove-cart-item',function(e){
e.preventDefault();

var quantity = $(this).closest(".cart_data").find(".quantity-amount").val();
var cart_id = $(this).closest(".cart_data").find(".cartId").val();
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
  }
});

$.ajax({
  method: 'get',
  url:'/delete-cart-item/'+cart_id,
  data:{
    cart_id:cart_id,
  },
  success:function(response){

$("#cart").load(window.location.href + " #cart");


},
error: function (xhr, status, error) {
console.error("Error Deleting Cart Item:", error);
}
})

});

});