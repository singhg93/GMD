<?php
//Define Database Connection Constants
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','TeamGMD');

ini_set('error_log','log/error.log'); //set error log file destination
ini_set('date.timezone','America/Vancouver'); //set timezone

define( 'API_URL', 'https://www.googleapis.com/books/v1/volumes?q=' );
define( 'API_KEY', '' );

?>
