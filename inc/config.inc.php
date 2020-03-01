<?php
//Define Database Connection Constants
//define('DB_HOST','localhost');
define('DB_HOST','ec2-184-72-236-3.compute-1.amazonaws.com,5432');

// define('DB_USER','root');
define('DB_USER','gxbmqwvkctaspr');
define('DB_PASS','ebb486cfada95862501ec1d6cdfe99a6c8301c59b9c26cafa9921159ddd0c75c');
define('DB_NAME','d3oqtqvhtp312');

ini_set('error_log','log/error.log'); //set error log file destination
ini_set('date.timezone','America/Vancouver'); //set timezone

define( 'API_URL', 'https://www.googleapis.com/books/v1/volumes?q=' );
define( 'API_KEY', 'AIzaSyDOapIY6kWSCIPavqLQUthdYenwrtFOWsY' );

?>
