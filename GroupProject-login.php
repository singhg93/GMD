<?php
//Require Files
require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/Page.class.php");

// store any messages to show to the user
$message = array();

//initialize location variable
$location = null;

//set refering page address
if ( isset($_GET['location']) ) {
    
    $location = $_GET['location'];
}

if ( isset($_GET['user']) && $_GET['user'] == 'unknown' ) {
    $message[] = "Please log in to post a review";
}

//Check if the form was posted
if (isset($_POST['username'])) {

    //Initialize the DAO
    UserDAO::init();
    //Get the current user 
    $currentUser = UserDAO::getUser($_POST['username']);

    //Check the DAO returned an object of type user
    if ( $currentUser instanceof User) {


        //Check the password
        if ($currentUser->verifyPassword($_POST['password']))  {

            //Start the session
            session_start();
            
            //Set the user to logged in
            $_SESSION['username'] = $currentUser->getUserName();
            $_SESSION['userId'] = $currentUser->getUserId();
            $_SESSION['loginTimeStamp'] = time();
            $message[] = "Welcome";

            if (isset($_POST['location'])){

                // Send the user to previously viewed page
                header("Location: ".$_POST['location']."");

            } else {
                //send the user to the homepage
                header("Location: index.php");
            }
            exit;

        } else {
            $message[] = "Incorrect Password";
        }

    } else {
        $message[] = "We could not find any user with those details.";
        $message[] = "Please check the ";
    }
}

//Set the Page Title
Page::$title =  "Log In &bull; GMD";
// display header
Page::header();
//display any messages
Page::showMessage( $message );
//display login form
Page::showLoginForm( $location );
//display footer
Page::footer();


?>
