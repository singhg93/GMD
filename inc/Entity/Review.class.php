<?php

class Review {

    //attributes
    private $reviewid ;
    private $userid ;
    private $username ;
    private $bookid ;
    private $rating ;
    private $reviewtext ;
    private $lastupdate ;

    //getters

    public function getReviewId () : int {

        return $this->reviewid ;

    }

    public function getUserId () : int {

        return $this->userid ;

    }

    public function getUserName () : string {
        return $this->username;
    }

    public function getBookId () : int {

        return $this->bookid ;

    }

    public function getRating () : string {

        return $this->rating ;

    }

    public function getReviewText () : string {

        return $this->reviewtext ;

    }

    public function getLastUpdate () : string {

        return $this->lastupdate ;

    }

    //setters

    public function setUserId ( int $userId ) {

        $this->userid = $userId;

    }

    public function setUserName ( string $userName ) {

        $this->username = $userName;

    }

    public function setBookId ( int $bookId ) {

        $this->bookid = $bookId ;

    }

    public function setRating ( string $rating ) {

        $this->rating = $rating ;

    }

    public function setReviewText ( string $reviewText ) {

        $this->reviewtext = $reviewText ;

    }

    public function setLastUpdate ( string $lastUpdate ) {

        $this->lastupdate = $lastUpdate ;

    }

}

?>
