$(document).ready(function(){
    $("form").submit(function(event) {
      event.preventDefault();
      var prodid = $("#submit").val();
      alert(prodid);

      $(".form-message").load("inc/deletecart.php", {
        prodid: prodid
      });
    });
});