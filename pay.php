<?php
require_once("./paytmconfig/config.php");
require_once("./paytmconfig/encdec_paytm.php");

$order_id = $_POST["ORDER_ID"];
$cust_id = $_POST["CUST_ID"];
$txn_amount = $_POST["TXN_AMOUNT"];

$paramList = array(
    "MID" => PAYTM_MERCHANT_MID,
    "WEBSITE" => PAYTM_MERCHANT_WEBSITE,
    "INDUSTRY_TYPE_ID" => "Retail",
    "CHANNEL_ID" => "WEB",
    "ORDER_ID" => $order_id,
    "CUST_ID" => $cust_id,
    "TXN_AMOUNT" => $txn_amount,
    "CALLBACK_URL" => "http://yourdomain.com/paytm-integration/callback.php"
);

$checksum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);
?>
<html>
<body>
  <form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
  <?php foreach($paramList as $name => $value) {
    echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
  } ?>
  <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checksum ?>">
  </form>
  <script type="text/javascript">document.f1.submit();</script>
</body>
</html>
