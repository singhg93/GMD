<?php

class Book {

    //attributes
    private $bookid ;
    private $isbn;
    private $title;
    private $author;
    private $publicationyear;

    //getters

    public function getBookId () : int {
        return $this->bookid ;
    }

    public function getISBN () : string {
        return $this->isbn ;
    }

    public function getTitle () : string {
        return $this->title ;
    }

    public function getAuthor () : string {
        return $this->author ;
    }

    public function getPublicationYear () : string {
        return $this->publicationyear ;
    }

    //setters

    public function setISBN ( string $isbn ) {

        $this->ISBN = $isbn;

    }

    public function setTitle ( string $title ) {

        $this->title = $title;

    }

    public function setAuthor ( string $author ) {

        $this->author = $author;

    }

    public function setPublicationYear ( string $publicationYear ) {

        $this->publicationyear = $publicationYear;

    }

}

?>
