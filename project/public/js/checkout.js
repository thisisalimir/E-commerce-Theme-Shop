//its like encrypted for when we send user credit card
Stripe.setPublishableKey('pk_test_txxSd1RKKeavopZpvfhSl2Tu');

//grab the form
var $form = $('#checkout-form');


$form.submit(function(event) {
  $('charge-error').addClass('hidden');
  $form.find('button').prop('disabled',true);
  //the Token that we need
  Stripe.card.createToken({
    number: $('#card-number').val(),
    cvc: $('#card-cvc').val(),
    exp_month: $('#card-expiry-month').val(),
    exp_year: $('#card-expiry-year').val(),
    name : $('#card-name').val()
  }, stripeResponseHandler);
  return false;
});

function stripeResponseHandler(status,response) {
   if (response.error) {
     //show the error
     $('charge-error').removeClass('hidden');
     $('charge-error').text(response.error.message);
     $form.find('button').prop('disabled',false);
   }else {//token created
     //get token id
     var token = response.id;
    // Insert the token into the form so it gets submitted to the server:
  $form.append($('<input type="hidden" name="stripeToken" />').val(token));

  // Submit the form:
    $form.get(0).submit();
   }
}
