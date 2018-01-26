<?php
/** set your paypal credential **/

$config['client_id'] = 'AVKTvg-bqo2v4BdN1u876cUZCMqt90ILSknii5aaWQWxiJ8iM3b-n2QpzEU5v5BbyT9RFuf2JlYeTcWq';
$config['secret'] = 'EJn2PeSKKoxeJhKQhWHHCKtVJ1fRGayY5YwCSZvDEP53Mv_C-T7kgvOaZxE-w6BEH83pzOIhixHLW0bh';

/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    'mode' => 'sandbox',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);