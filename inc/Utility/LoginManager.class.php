<?php

class LoginManager {

    // function to verify the login
    static function verifyLogin() {

        // the session is active
        if(isset($_SESSION)) {

            // check if the session contains any information on the user 

            // if the username exists then the user is logged in 
            if(array_key_exists('username', $_SESSION)) {
                //return true
                return true;

            // else if there is no user logged in 
            } else {

                // if the session is active
                if (session_status() == PHP_SESSION_ACTIVE){

                    // destroy the session just in case
                    session_destroy();

                }
                
                // return false
                return false;
            }
        }
    }
}

?>
