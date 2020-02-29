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
        $sqlInsert = "INSERT INTO reviews (userId, userName, bookId, rating, reviewText, lastUpdate) VALUES (:userId, :userName, :bookId, :rating, :reviewText, :lastUpdate);";

        // prepare the query
        self::$db->query($sqlInsert);

        // bind the values
        self::$db->bind(':userId', $review->getUserId());
        self::$db->bind(':userName', $review->getUserName());
        self::$db->bind(':bookId', $review->getBookId());
        self::$db->bind(':rating', $review->getRating());
        self::$db->bind(':reviewText', $review->getReviewText());
        self::$db->bind(':lastUpdate', $review->getLastUpdate());

        // execute
        self::$db->execute();
    }

    //function to get multiple reviews
    static function getBookReviews( int $bookId ){

        //sql statement
        $sqlQuery = 'SELECT * FROM reviews WHERE bookId=:bookId ORDER BY lastUpdate DESC;';

        //prepare the query
        self::$db->query( $sqlQuery );

        // bind the values
        self::$db->bind(':bookId', $bookId );

        // execute
        self::$db->execute();

        // return
        return self::$db->getResultSet();
    }

    static function getUserReviews( int $userId , int $bookId){

        //sql statement
        $sqlQuery = 'SELECT * FROM reviews WHERE userId=:userId AND bookId=:bookId ORDER BY lastUpdate DESC;';

        //prepare the query
        self::$db->query( $sqlQuery );

        // bind the values
        self::$db->bind(':userId', $userId );
        self::$db->bind(':bookId', $bookId );

        // execute
        self::$db->execute();

        // return
        return self::$db->getResultSet();
    }

    // function to get a single result
    static function getSingleReview( int $reviewId ) {

        // sql statement
        $sqlQuery = 'SELECT * FROM reviews WHERE reviewId=:reviewId;';

        // prepare the query
        self::$db->query( $sqlQuery );

        //bind the values
        self::$db->bind( ':reviewId', $reviewId );

        //execute
        self::$db->execute();

        //return
        return self::$db->getSingleResult();

    }

    //function to delete a review
    static function deleteReview( int $reviewId ) {

        // sql statement
        $sqlDelete = "DELETE FROM reviews WHERE reviewId=:reviewId;";

        // prepare
        self::$db->query( $sqlDelete );

        //bind the values
        self::$db->bind( ':reviewId', $reviewId );

        // execute
        self::$db->execute();

    }


    //function to update a review
    static function updateReview( Review $review ) {

        //sql statement
        $sqlUpdate = "UPDATE reviews SET rating=:rating, reviewText=:reviewText, lastUpdate=:lastUpdate WHERE reviewId=:reviewId;";

        //prepare
        self::$db->query( $sqlUpdate );

        //bind the values
        self::$db->bind( ':rating', $review->getRating());
        self::$db->bind( ':reviewText', $review->getReviewText());
        self::$db->bind( ':lastUpdate', $review->getLastUpdate());
        self::$db->bind( ':reviewId', $review->getReviewId());

        //execute
        self::$db->execute();

    }

}

?>
