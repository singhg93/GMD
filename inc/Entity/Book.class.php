<?php

class Book {

    //attributes
    private $bookId ;
    private $isbn;
    private $title;
    private $author;
    private $publicationYear;

    //getters

    public function getBookId () : int {
        return $this->bookId ;
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
        return $this->publicationYear ;
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

        $this->publicationYear = $publicationYear;

    }

}

?>
