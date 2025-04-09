<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

require_once("config.php");
require_once("encdec_paytm.php");

$ORDER_ID = $_POST["ORDER_ID"];
$CUST_ID = $_POST["CUST_ID"];
$TXN_AMOUNT = $_POST["TXN_AMOUNT"];

$paramList = array();

// Paytm Parameters
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = "Retail";
$paramList["CHANNEL_ID"] = "WEB";
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] = "http://localhost/paytm-integration/callback.php";

// Generate checksum hash
$checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);
?>

<html>
  <head><title>Redirecting to Paytm...</title></head>
  <body>
    <center><h1>Please do not refresh this page...</h1></center>
    <form method="post" action="https://securegw-stage.paytm.in/theia/processTransaction" name="paytm_form">
      <?php
      foreach ($paramList as $name => $value) {
          echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
      }
      ?>
      <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum; ?>">
    </form>
    <script type="text/javascript">
      document.paytm_form.submit();
    </script>
  </body>
</html>
