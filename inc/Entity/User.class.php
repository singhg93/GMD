<?php

class User {

    //attributes
    private $userId;
    private $userName;
    private $firstName;
    private $lastName;
    private $email;
    private $passwordHash;

    //getters

    public function getUserId () : int {
        return $this->userId;
    }

    public function getUserName () : string {
        return $this->userName;
    }

    public function getFirstName () : string {
        return $this->firstName;
    }

    public function getLastName () : string {
        return $this->lastName;
    }

    public function getEmail () : string {
        return $this->email;
    }

    public function getPasswordHash () : string {
        return $this->passwordHash;
    }

    //setters

    public function setUserName ( string $userName ) {
        $this->userName = $userName;
    }

    public function setFirstName ( string $firstName ) {
        $this->firstName = $firstName ;
    }

    public function setLastName ( string $lastName ) {
        $this->lastName = $lastName ;
    }

    public function setEmail ( string $email ) {
        $this->email = $email ;
    }

    public function setPasswordHash ( string $passwordHash ) {
        $this->passwordHash = $passwordHash ;
    }

    public function verifyPassword(string $passwordToVerify) {
        //Return a boolean based on verifying if the password given is correct for the current user
        return password_verify($passwordToVerify,$this->getPasswordHash());
        
    }
}

?>
