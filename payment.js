$(document).ready(function () {
    var apiKey = "rzp_test_mcMsI3DLnPrMFY";
    $('.button').on('click', function (e) {
        e.preventDefault();
        var fromSelectedText = document.getElementById("from-station").options[document.getElementById("from-station").selectedIndex].textContent;
        var toSelectedText = document.getElementById("to-station").options[document.getElementById("to-station").selectedIndex].textContent;
        var fare = calculateFare(fromSelectedText, toSelectedText);
        if (fare !== "Fare not available") {
            var options = {
                key: apiKey,
                amount: parseInt(fare.split(" ")[1]) * 100,
                currency: "INR",
                name: "Go Metro",
                description: "Charitable Trust",
                image: "",
                prefill: {
                    name: "Uday",
                    email: "uday@gmail.com",
                },
                theme: {
                    color: "#001F3F"
                },
                handler: function (response) {
                    console.log(response);
                    // Send payment data to PHP file
                    $.ajax({
                        url: "payment.php",
                        type: "POST",
                        data: {
                            userId: "1", // Replace with the actual user ID
                            paymentId: response.razorpay_payment_id,
                            transactionId: response.razorpay_payment_id,
                            amount: parseInt(fare.split(" ")[1])
                        },
                        success: function (data) {
                            console.log(data); // Log response from server
                            // Redirect to payment success page
                            var paymentSuccessPage = window.open('last.html', '_blank', 'height=600,width=800');
                            paymentSuccessPage.onload = function() {
                                // Generate QR code or perform other actions
                            };
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText); // Log error message
                            alert("Error processing payment. Please try again later.");
                        }
                    });
                }
            };
            var rzp = new Razorpay(options);
            rzp.open();
        } else {
            alert("Fare not available for the selected route.");
        }
    });
});
