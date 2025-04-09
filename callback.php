<?php
require_once(".config.php");
require_once(".encdec_paytm.php");

$paytmChecksum = "";
$paramList = $_POST;
$isValidChecksum = "FALSE";

if (isset($_POST["CHECKSUMHASH"])) {
    $paytmChecksum = $_POST["CHECKSUMHASH"];
    $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum);
}

if ($isValidChecksum == "TRUE") {
    echo "<h2>Checksum Matched</h2>";

    if ($_POST["STATUS"] == "TXN_SUCCESS") {
        echo "<h3 style='color:green;'>Transaction Successful</h3>";
        echo "Transaction ID: " . $_POST["TXNID"];
        // Save to DB or send confirmation here
    } else {
        echo "<h3 style='color:red;'>Transaction Failed</h3>";
    }
} else {
    echo "<h3 style='color:red;'>Checksum mismatched. Transaction is suspicious.</h3>";
}
?>
