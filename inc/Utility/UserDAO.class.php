<?php

class UserDAO {

    private static $db;

    static function init()  {
        //Initialize the internal PDO Agent

        try {
            self::$db = new PDOAgent( "User" );
        } catch ( Exception $ex ) {
            error_log($ex->getMessage(), 0);
            echo $ex->getMessage();
        }
    }

    static function createUser( User $newUser ) {

        $sqlQuery = "INSERT INTO users (username, firstname, lastname, email, passwordhash) VALUES (:username,  :firstname, :lastname, :email, :passwordhash);";

        //Query
        self::$db->query($sqlQuery);

        //Bind
        self::$db->bind( ':username', $newUser->getUserName());
        self::$db->bind( ':firstname', $newUser->getFirstName());
        self::$db->bind( ':lastname', $newUser->getLastName());
        self::$db->bind( ':email', $newUser->getEmail());
        self::$db->bind( ':passwordhash', $newUser->getPasswordHash());

        //Execute
        self::$db->execute();
    }

    static function deleteUser(int $userId) {
        $sqlForeignKeyZero = "SET foreign_key_checks=0";

        self::$db->query($sqlForeignKeyZero);
        self::$db->execute();

        $sqlDelete = "DELETE FROM users WHERE userid=:userid;";

        //query
        self::$db->query($sqlDelete);

        //bind
        self::$db->bind(':userid', $userId);

        //execute
        self::$db->execute();

        $sqlForeignKeyOne = "SET foreign_key_checks=1";

        self::$db->query($sqlForeignKeyOne);
        self::$db->execute();
    }

    static function getUser(string $userName) {

        $sqlDelete = "SELECT * FROM users WHERE username=:username LIMIT 1;";

        //query
        self::$db->query($sqlDelete);

        //bind
        self::$db->bind(':username', $userName);

        //execute
        self::$db->execute();

        //return
        return self::$db->getSingleResult();
    }

    static function getUsers () {
        $sqlQuery = "SELECT * FROM users;";

        //query
        self::$db->query($sqlQuery);

        //execute
        self::$db->execute();

        //
        return self::$db->getResultSet();
    }

}

?>
