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

        $sqlQuery = "INSERT INTO users (userName, firstName, lastName, email, passwordHash) VALUES (:userName,  :firstName, :lastName, :email, :passwordHash);";

        //Query
        self::$db->query($sqlQuery);

        //Bind
        self::$db->bind( ':userName', $newUser->getUserName());
        self::$db->bind( ':firstName', $newUser->getFirstName());
        self::$db->bind( ':lastName', $newUser->getLastName());
        self::$db->bind( ':email', $newUser->getEmail());
        self::$db->bind( ':passwordHash', $newUser->getPasswordHash());

        //Execute
        self::$db->execute();
    }

    static function deleteUser(int $userId) {
        $sqlForeignKeyZero = "SET foreign_key_checks=0";

        self::$db->query($sqlForeignKeyZero);
        self::$db->execute();

        $sqlDelete = "DELETE FROM users WHERE userId=:userId;";

        //query
        self::$db->query($sqlDelete);

        //bind
        self::$db->bind(':userId', $userId);

        //execute
        self::$db->execute();

        $sqlForeignKeyOne = "SET foreign_key_checks=1";

        self::$db->query($sqlForeignKeyOne);
        self::$db->execute();
    }

    static function getUser(string $userName) {

        $sqlDelete = "SELECT * FROM users WHERE userName=:userName LIMIT 1;";

        //query
        self::$db->query($sqlDelete);

        //bind
        self::$db->bind(':userName', $userName);

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
