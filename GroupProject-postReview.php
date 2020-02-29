<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/Review.class.php");
require_once("inc/Entity/Book.class.php");
require_once("inc/Utility/Validate.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/ReviewDAO.class.php");
require_once("inc/Utility/BookDAO.class.php");
require_once('inc/Utility/LoginManager.class.php');
require_once('inc/Utility/Page.class.php');

session_start();

// if the user tries to enter this page directly without logging in
if( !LoginManager::verifyLogin() ) {

    //redirect to the login page
    header("Location: GroupProject-login.php?user=unknown&location=".urlencode($_SERVER['REQUEST_URI']));

}

ReviewDAO::init();
BookDAO::init();

// if the get request is not empty and the it contains an action
if ( isset($_GET['action']) ) {

    switch($_GET['action']) {

        // if the action is show form
        case "showForm":

            $book = BookDAO::getBook( $_GET['bookId'] );
            $statement = "Write a review for: ".$book->getTitle();
            // render the post review form
            Page::$title = "Review &bull; GMD";
            Page::header();

            Page::bookName( $statement );

            if ( isset($_GET['location'] )) {
                $location = $_GET['location'];
            } else {
                $location = null;
            }
            Page::postReviewForm( $_GET['bookId'], $location );
            Page::footer();
        break;

        // cases for editform and  whateverelse
        case "deleteReview":
            //check if the user is deleting their own review
            $deleteReview = ReviewDAO::getSingleReview((int)$_GET['reviewId']);
            $reviewUser = $deleteReview->getUserID();

            if($_SESSION['userId'] == $reviewUser){

                    ReviewDAO::deleteReview($_GET['reviewId']);
                    $message[] = "Review Deleted";
                    Page::$title = "Delete";
                    Page::header();
                    Page::showMessage($message);
                    // display footer
                    Page::footer();
                    header("Refresh:1; url=".$_GET['location']);
            }else {
                $message[] = "Restricted Access: You are unable to delete this review";
                Page::$title = "Delete";
                Page::header();
                Page::showMessage($message);
                // display footer
                Page::footer();
                header("Refresh:1; url=".$_GET['location']);
            }   
        break;

        case "editReview":

            $editReview = ReviewDAO::getSingleReview( (int)$_GET['reviewId']);
            if ( isset($_GET['location'] )) {
                $location = $_GET['location'];
            } else {
                $location = null;
            }
            $book = BookDAO::getBook($_GET['bookId']);
            $statement = "Edit review for: ".$book->getTitle();

            if ( $_SESSION['userId'] == $editReview->getUserId() ) {

                Page::$title = "Edit review - ".$editReview->getReviewId();
                Page::header();
                Page::bookName( $statement );
                Page::editReviewForm( $editReview , $location);
                Page::footer();

            } else {
                $message[] = "Access denied: You can only edit your own reviews";
                Page::$title = "Edit";
                Page::header();
                Page::showMessage($message);
                Page::footer();
                header("Refresh:1; url=".$_GET['location']);
            }
        break;

        default:
            echo "This doesn't seem to be a valid request";
        break;
    }

} else if ( isset($_POST['action']) ) {

    switch ( $_POST['action'] ) {

        case "newReview":

            // validate the form
            list($form_errors, $input) = Validate::validateReviewForm();
            if ($form_errors) {

                $book = BookDAO::getBook( $input['bookId'] );
                $location = urlencode($_POST['location']);
                $message = "Write a review for: ".$book->getTitle();
                // show the form with errors;
                Page::$title = "Please correct the follwing errors";
                Page::header();
                Page::bookName( $message );
                Page::postReviewForm( (int)$input['bookId'], $location);
                Page::showMessage( $form_errors );
                Page::footer();
            } else {

                // process the form
                $newReview = new Review();
                $newReview->setUserId( $_SESSION['userId'] );
                $newReview->setUserName( $_SESSION['username'] );
                $newReview->setBookId( $input['bookId']);
                $newReview->setRating( $input['rating'] );
                $newReview->setReviewText( $input['reviewText'] );
                $newReview->setLastUpdate( (string)time() );

                ReviewDAO::addReview( $newReview );

                header("Refresh:1; url=".$_POST['location']."");
            }
        break;

        case "updateReview":

            list($form_errors, $input) = Validate::validateEditReviewForm();

            $oldReview = ReviewDAO::getSingleReview($input['reviewId']);

            if ($_SESSION['userId'] = $oldReview->getUserId()) {


                if ($form_errors) {
                    $book = BookDAO::getBook($_GET['bookId']);
                    $message = "Edit review for: ".$book->getTitle();
                    $location = urlencode($_POST['location']);
                    // show the form with errors;
                    Page::$title = "Please correct the follwing errors";
                    Page::header();
                    Page::bookName( $message );
                    Page::editReviewForm( $oldReview, $location);
                    Page::showMessage( $form_errors );
                    Page::footer();
                } else {

                    // process the form
                    $oldReview->setRating( $input['rating'] );
                    $oldReview->setReviewText( $input['reviewText'] );
                    $oldReview->setLastUpdate( (string)time() );

                    ReviewDAO::updateReview( $oldReview );

                    $message[] = "Review Updated";

                    Page::$title = "Delete";
                    Page::header();
                    Page::showMessage($message);
                    // display footer
                    Page::footer();

                    header("Refresh:1; url=".$_POST['location']."");
                }
            }
        break;

    }
} else {
    // the request is either empty or contains irrelevant data
    // so redirect the user to the home page
    header("Location: teamGMD.php");
}


?>
