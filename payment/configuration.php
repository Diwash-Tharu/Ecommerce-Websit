<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php
/* 
 * PayPal and database configuration 
 */

// PayPal configuration 
define('PAYPAL_ID', 'sb-zhj2a25739624@business.example.com');
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 

define('PAYPAL_RETURN_URL', 'http://localhost/project/chz/payment/paymanet.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/project/chz/home1.php');

define('PAYPAL_CURRENCY', 'USD');


// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr");
?>