<?php
// Change these values with your actual credentials from Paytm Dashboard

define('PAYTM_ENVIRONMENT', 'TEST'); // TEST for staging, PROD for production
define('PAYTM_MERCHANT_KEY', 'YOUR_MERCHANT_KEY_HERE');
define('PAYTM_MERCHANT_MID', 'YOUR_MERCHANT_ID_HERE');
define('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING'); // use 'DEFAULT' for PROD

$PAYTM_TXN_URL = PAYTM_ENVIRONMENT == 'PROD' ?
    "https://securegw.paytm.in/theia/processTransaction" :
    "https://securegw-stage.paytm.in/theia/processTransaction";

define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
?>
