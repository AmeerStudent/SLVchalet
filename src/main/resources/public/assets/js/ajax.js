$(document).ready(function(){
    $("form").submit(function(event) {
      event.preventDefault();
      var prodid = $("#prodid").val();
      var quantity = $("#quantity").val();
      var variation = $("input[type='radio'][name='variation']:checked").val();

      $(".form-message").load("inc/addtocart.php", {
        prodid: prodid,
        quantity: quantity,
        variation: variation
      });
    });
});