<?php

// require all the files
require_once ( "inc/config.inc.php" );
require_once ( "inc/Entity/Book.class.php" );
require_once ( "inc/Entity/Review.class.php" );
require_once ( "inc/Utility/RestClient.class.php" );
require_once ( "inc/Utility/PDOAgent.class.php" );
require_once ( "inc/Utility/BookDAO.class.php" );
require_once ( "inc/Utility/ReviewDAO.class.php" );
require_once ('inc/Utility/LoginManager.class.php');
require_once ( "inc/Utility/Page.class.php" );

// start the session
session_start();

// initialize the book and user doa
BookDAO::init();
ReviewDAO::init();

// if the request is post and the book search is in the post
if ( !empty($_GET['bookSearch']) ) {

    $searchTerm = $_GET['bookSearch'];

    // get all the books from the database with the given book search term
    $books = BookDAO::getBooks( $searchTerm );

    // render the page 
    Page::$title = "$searchTerm &bull; GMD Search";
    Page::header();
    Page::BookSearchForm();
    Page::listBooks($books);
    Page::footer();
    
// else if the request is get and is not empty
} else if ( !empty($_GET) ) {

    // get the action from the get request
    $action = isset($_GET['action']) ? $_GET['action'] : $_GET['action'] = "";

    // switch on the action 
    switch ($action) {

        // if the user wants to view a books details 
        case 'detail':
            // get the book details
            $bookId = (int)$_GET['bookId'];
            $book = BookDAO::getBook( $bookId );
            $reviews = ReviewDAO::getBookReviews( $bookId );
            $noOfBooksByAuthor = BookDAO::getBooksByAuthor( $book->getAuthor() );

            // try to use the api
            try {

                $bookDetail = json_decode(RestClient::call( $book->getTitle() ));
                //if book details do not exist for the current book
                if (!isset($bookDetail->items['0'])) {
                    //Set error and exception
                    $bookDescription = "Description not available";
                    throw new Exception("Api not working");
                }
                $bookDescription = $bookDetail->items['0']->volumeInfo->description;  

            } catch (Exception $ex) {
                error_log($ex->getMessage(), 0);
            }
            // render the page
            Page::$title = $book->getTitle()." &bull; GMD";
            Page::header();
            Page::BookSearchForm();
            Page::bookDetails( $book, $bookDescription, $noOfBooksByAuthor );
            Page::reviewSummary( $reviews );
            Page::listReviews( $reviews, $bookId);
            Page::footer();
        break;

        default:
            echo "What are you trying to do?";
        break;

    }

// otherwise if the get request is empty display the booksearch form
} else {
    Page::$title = "Home &bull; GMD";
    Page::header();
    Page::BookSearchForm();
    Page::footer();
}

?>

