<?php
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
require ('autoload.php');
// 2. Provide your Secret Key. Replace the given one with your app clientId, and Secret
// https://developer.paypal.com/webapps/developer/applications/myapps
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AVKTvg-bqo2v4BdN1u876cUZCMqt90ILSknii5aaWQWxiJ8iM3b-n2QpzEU5v5BbyT9RFuf2JlYeTcWq',     // ClientID
        'EJn2PeSKKoxeJhKQhWHHCKtVJ1fRGayY5YwCSZvDEP53Mv_C-T7kgvOaZxE-w6BEH83pzOIhixHLW0bh'      // ClientSecret
    )
);
// 3. Lets try to save a credit card to Vault using Vault API mentioned here
// https://developer.paypal.com/webapps/developer/docs/api/#store-a-credit-card
$creditCard = new \PayPal\Api\CreditCard();
$creditCard->setType("visa")
    ->setNumber("4417119669820331")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("012")
    ->setFirstName("Joe")
    ->setLastName("Shopper");
// 4. Make a Create Call and Print the Card
try {
    $creditCard->create($apiContext);
   // echo $creditCard;
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception. 
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}