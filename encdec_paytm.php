<?php
function encrypt_e($input, $key) {
    $key = html_entity_decode($key);
    $iv = "@@@@&&&&####$$$$";
    return openssl_encrypt($input, "AES-128-CBC", $key, 0, $iv);
}

function decrypt_e($crypt, $key) {
    $key = html_entity_decode($key);
    $iv = "@@@@&&&&####$$$$";
    return openssl_decrypt($crypt, "AES-128-CBC", $key, 0, $iv);
}

function getChecksumFromArray($arrayList, $key) {
    ksort($arrayList);
    $str = getStringByParams($arrayList);
    $salt = generateSalt_e(4);
    $finalString = $str . "|" . $salt;
    $hash = hash("sha256", $finalString);
    $hashString = $hash . $salt;
    return encrypt_e($hashString, $key);
}

function verifychecksum_e($arrayList, $key, $checksum) {
    $arrayList = removeCheckSumParam($arrayList);
    ksort($arrayList);
    $str = getStringByParams($arrayList);
    $paytm_hash = decrypt_e($checksum, $key);
    $salt = substr($paytm_hash, -4);
    $finalString = $str . "|" . $salt;
    $website_hash = hash("sha256", $finalString) . $salt;
    return $website_hash === $paytm_hash ? "TRUE" : "FALSE";
}

function getStringByParams($params) {
    $str = "";
    foreach ($params as $key => $value) {
        $str .= ($value == "null") ? "" : $value . "|";
    }
    return rtrim($str, "|");
}

function removeCheckSumParam($params) {
    unset($params["CHECKSUMHASH"]);
    return $params;
}

function generateSalt_e($length) {
    $random = "";
    srand((double) microtime() * 1000000);
    $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
    for ($i = 0; $i < $length; $i++) {
        $random .= substr($data, (rand() % strlen($data)), 1);
    }
    return $random;
}
?>
