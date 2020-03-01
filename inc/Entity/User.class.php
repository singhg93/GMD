<?php

class User {

    //attributes
    private $userid;
    private $username;
    private $firstname;
    private $lastname;
    private $email;
    private $passwordhash;

    //getters

    public function getUserId () : int {
        return $this->userid;
    }

    public function getUserName () : string {
        return $this->username;
    }

    public function getFirstName () : string {
        return $this->firstname;
    }

    public function getLastName () : string {
        return $this->lastname;
    }

    public function getEmail () : string {
        return $this->email;
    }

    public function getPasswordHash () : string {
        return $this->passwordhash;
    }

    //setters

    public function setUserName ( string $userName ) {
        $this->username = $userName;
    }

    public function setFirstName ( string $firstName ) {
        $this->firstname = $firstName ;
    }

    public function setLastName ( string $lastName ) {
        $this->lastname = $lastName ;
    }

    public function setEmail ( string $email ) {
        $this->email = $email ;
    }

    public function setPasswordHash ( string $passwordHash ) {
        $this->passwordhash = $passwordHash ;
    }

    public function verifyPassword(string $passwordToVerify) {
        //Return a boolean based on verifying if the password given is correct for the current user
        return password_verify($passwordToVerify,$this->getPasswordHash());
        
    }
}

?>
