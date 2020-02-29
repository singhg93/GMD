<?php

class BookDAO {

    //store PDOAgent in this
    private static $db;

    static function init() {

        //Initialize the internal PDO Agent

        try {
            // try to create an instance of the pdo agent
            self::$db = new PDOAgent ( "Book" );

            // if unsuccessful catch the exception
        } catch ( Exception $ex ) {
            // log the errors to the error log file
            error_log($ex->getMessage(),0);
            echo $ex->getMessage();
        }

    }

    // function to add a new book to the database
    static function createBook ( user $newBook ) {

        // write the query to add the book
        $sqlQuery = "INSERT INTO books ( isbn, title, author, publicationYear ) VALUES (:isbn, :title, :author, :publicationYear);";

        //Query
        self::$db->query($sqlQuery);

        //bind all the values
        self::$db->bind(':isbn', $newBook->getIsbn());
        self::$db->bind(':title', $newBook->getTitle());
        self::$db->bind(':author', $newBook->getAuthor());
        self::$db->bind(':publicationYear', $newBook->getPublicationYear());

        //execute
        self::$db->execute();
    }

    // function for getting a list of books
    static function getBooks( string $searchString) {

        // sql statement for getting the books which are sorted by the attribute type
        // i.e. by isbn or title or author or year
        $sqlQuery = "SELECT * FROM books WHERE isbn LIKE :searchString OR title LIKE :searchString OR author LIKE :searchString ORDER BY title ASC LIMIT 15;";

        $searchString = "%$searchString%";

        //query
        self::$db->query($sqlQuery);

        //bind all the values
        self::$db->bind(':searchString', $searchString);

        //execute
        self::$db->execute();

        //return the results
        return self::$db->getResultSet();
    }

    static function getBooksByAuthor( string $author ) {

        // sql statement
        $sqlQuery = "SELECT * FROM books WHERE author=:author";

        // prepare the query
        self::$db->query($sqlQuery);

        // bind the values
        self::$db->bind( ':author', $author );

        //execute
        self::$db->execute();

        // return the results
        return self::$db->rowCount();
    }

    // function for getting a single book based on isbn
    static function getBook( int $id ) {

        //sql statement for getting a single book out of the database
        $sqlQuery = "SELECT * FROM books WHERE bookId=:id;";

        //query
        self::$db->query( $sqlQuery );

        //bind
        self::$db->bind( ':id', $id );

        //execute
        self::$db->execute();

        //return the single book object
        return self::$db->getSingleResult();
    }
}

?>
