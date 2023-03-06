<?php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]";
    $google_client = new Google_Client();
    $google_client->setClientId('906235978096-9ru7m2258qgdu2u343chesp49g2cj0pd.apps.googleusercontent.com');
    $google_client->setClientSecret('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');
    $google_client->setRedirectUri($actual_link);
    $google_client->addScope('email');
    $google_client->addScope('profile');

?>


