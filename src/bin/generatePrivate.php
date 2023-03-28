<?php
$privateKey = openssl_pkey_new(array(
    'private_key_bits' => 4096,
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
));

openssl_pkey_export($privateKey, $privateKeyString);
$publicKey = openssl_pkey_get_details($privateKey)['key'];

echo substr(str_replace(PHP_EOL, '\\n', $privateKeyString), 0, -2) . PHP_EOL;
echo substr(str_replace(PHP_EOL, '\\n', $publicKey), 0, -2);