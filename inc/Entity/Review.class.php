<?php

class Review {

    //attributes
    private $reviewId ;
    private $userId ;
    private $userName ;
    private $bookId ;
    private $rating ;
    private $reviewText ;
    private $lastUpdate ;

    //getters

    public function getReviewId () : int {

        return $this->reviewId ;

    }

    public function getUserId () : int {

        return $this->userId ;

    }

    public function getUserName () : string {
        return $this->userName;
    }

    public function getBookId () : int {

        return $this->bookId ;

    }

    public function getRating () : string {

        return $this->rating ;

    }

    public function getReviewText () : string {

        return $this->reviewText ;

    }

    public function getLastUpdate () : string {

        return $this->lastUpdate ;

    }

    //setters

    public function setUserId ( int $userId ) {

        $this->userId = $userId;

    }

    public function setUserName ( string $userName ) {

        $this->userName = $userName;

    }

    public function setBookId ( int $bookId ) {

        $this->bookId = $bookId ;

    }

    public function setRating ( string $rating ) {

        $this->rating = $rating ;

    }

    public function setReviewText ( string $reviewText ) {

        $this->reviewText = $reviewText ;

    }

    public function setLastUpdate ( string $lastUpdate ) {

        $this->lastUpdate = $lastUpdate ;

    }

}

?>
