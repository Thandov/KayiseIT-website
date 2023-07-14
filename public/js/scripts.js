var csrfToken = $('meta[name="csrf-token"]').attr('content');

jQuery(document).ready(function () {

    var totalUSD = $('#paypal-button-container').data('total-usd');
    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: totalUSD.toFixed(2) // Replace with the actual payment amount
                    }
                }] 
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {
                // Perform necessary actions after payment completion
                // For example, show a success message, save the transaction details, etc.
                
                if (details['status'] == "COMPLETED") {
                    save_to_db(details);
                    // Show the success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Payment was successful!',
                        
                      })
                   

                } else {
                    //this is where we put the code to notify the user that the code was not completed
                }

            });
        }
    }).render('#paypal-button-container');
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });


});
function save_to_db(data) {
    var details = JSON.stringify(data);
    document.getElementById("paypal_response").value = details;
    $('#paypal_form').submit();

}