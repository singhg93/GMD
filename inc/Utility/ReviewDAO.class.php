<?php

class ReviewDAO {

    //store PDOAgent in this
    private static $db;

    static function init() {

        //Initialize the internal PDO Agent

        try {
            // try to create an instance of the pdo agent
            self::$db = new PDOAgent ( "Review" );

            // if unsuccessful catch the exception
        } catch ( Exception $ex ) {
            // log the errors to the error log file
            error_log($ex->getMessage(),0);
            echo $ex->getMessage();
        }

    }

    //function to add a review
    static function addReview( Review $review ) {

        // sql statement to be executed
        $sqlInsert = "INSERT INTO reviews (userid, username, bookid, rating, reviewtext, lastupdate) VALUES (:userid, :username, :bookid, :rating, :reviewtext, :lastupdate);";

        // prepare the query
        self::$db->query($sqlInsert);

        // bind the values
        self::$db->bind(':userid', $review->getUserId());
        self::$db->bind(':username', $review->getUserName());
        self::$db->bind(':bookid', $review->getBookId());
        self::$db->bind(':rating', $review->getRating());
        self::$db->bind(':reviewtext', $review->getReviewText());
        self::$db->bind(':lastupdate', $review->getLastUpdate());

        // execute
        self::$db->execute();
    }

    //function to get multiple reviews
    static function getBookReviews( int $bookId ){

        //sql statement
        $sqlQuery = 'SELECT * FROM reviews WHERE bookid=:bookid ORDER BY lastupdate DESC;';

        //prepare the query
        self::$db->query( $sqlQuery );

        // bind the values
        self::$db->bind(':bookid', $bookId );

        // execute
        self::$db->execute();

        // return
        return self::$db->getResultSet();
    }

    static function getUserReviews( int $userId , int $bookId){

        //sql statement
        $sqlQuery = 'SELECT * FROM reviews WHERE userid=:userid AND bookid=:bookid ORDER BY lastupdate DESC;';

        //prepare the query
        self::$db->query( $sqlQuery );

        // bind the values
        self::$db->bind(':userid', $userId );
        self::$db->bind(':bookid', $bookId );

        // execute
        self::$db->execute();

        // return
        return self::$db->getResultSet();
    }

    // function to get a single result
    static function getSingleReview( int $reviewId ) {

        // sql statement
        $sqlQuery = 'SELECT * FROM reviews WHERE reviewid=:reviewid;';

        // prepare the query
        self::$db->query( $sqlQuery );

        //bind the values
        self::$db->bind( ':reviewid', $reviewId );

        //execute
        self::$db->execute();

        //return
        return self::$db->getSingleResult();

    }

    //function to delete a review
    static function deleteReview( int $reviewId ) {

        // sql statement
        $sqlDelete = "DELETE FROM reviews WHERE reviewid=:reviewid;";

        // prepare
        self::$db->query( $sqlDelete );

        //bind the values
        self::$db->bind( ':reviewid', $reviewId );

        // execute
        self::$db->execute();

    }


    //function to update a review
    static function updateReview( Review $review ) {

        //sql statement
        $sqlUpdate = "UPDATE reviews SET rating=:rating, reviewtext=:reviewtext, lastupdate=:lastupdate WHERE reviewid=:reviewid;";

        //prepare
        self::$db->query( $sqlUpdate );

        //bind the values
        self::$db->bind( ':rating', $review->getRating());
        self::$db->bind( ':reviewtext', $review->getReviewText());
        self::$db->bind( ':lastupdate', $review->getLastUpdate());
        self::$db->bind( ':reviewid', $review->getReviewId());

        //execute
        self::$db->execute();

    }

}

?>
