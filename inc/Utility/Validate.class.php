<?php

class Validate{

    private static $pattern = "#^[a-zA-Z\s]+$#";
    private static $pattern2 = "#^[a-zA-Z0-9]+$#";

    public static function validateRegistForm() {

        $errors = array();
        $input = array();

        $input['firstname'] = htmlentities(trim($_POST['firstname']));
        if (strlen($input['firstname']) == 0) {
            $errors[] = "First Name can't be empty!";
        }

        $input['lastname'] = htmlentities(trim($_POST['lastname']));
        if (strlen($input['lastname']) == 0) {
            $errors[] = "Last name can't be empty!";
        }

        $input['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if (!$input['email']){
            $errors[] = "Please enter a valid email";
        }

        $input['username'] = htmlentities(trim($_POST['username']));
        if ( strlen($input['username']) == 0 ) {
            $errors[] = "Username can't be empty";
        }
        
        $input['password'] = htmlentities(trim($_POST['password']));
        if( strlen($input['password']) < 8 ) {
            $errors[] = "Password must be at least 8 characters long";
        }

        if ( preg_match(self::$pattern, $input['password']) ) {
            $errors[] = "Password must contain a special character!";
        }
        if ( !preg_match(self::$pattern2, $input['username']) || !preg_match(self::$pattern, $input['firstname']) || !preg_match(self::$pattern, $input['lastname'])) {

        $errors[] = "First name, last name or the username can't contain special characters such as \"<>{}[]!@#$%^&*()-=?/\\|";
        $errors[] = "Username can't have spaces in it!";

        }

        return array( $errors, $input );
    }


    public static function validateEditReviewForm() {

        $input = array();
        $errors = array();
        $input['reviewText'] = htmlentities(trim($_POST['reviewText']));

        if ( strlen($input['reviewText']) > 1000 ) {
            $errors[] = "Please keep your review concise. Limit your characters to under 1000 characters.";
        }
        if (!isset($_POST['rating'] ) ) {
            $errors[] = "Please provide a star rating";
        } else {
            $input['rating'] = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
        }


        if ( is_null($input['rating']) || ($input['rating'] === false ) || ( $input['rating'] < 1 ) || ( $input['rating'] > 5 ) ) {

            $errors[] = "Please provide a valid rating";
        }

        $input['reviewId'] = filter_input(INPUT_POST, 'reviewId', FILTER_VALIDATE_INT);
        if (is_null($input['reviewId'] || ($input['reviewId'] === false)) ) {
            $errors[] = "Wrong review id";
        }

        return array( $errors, $input );

    }


    public static function validateReviewForm() {

        $input = array();
        $errors = array();
        $input['reviewText'] = htmlentities(trim($_POST['reviewText']));

        if ( strlen($input['reviewText']) > 1000 ) {
            $errors[] = "Please keep your review concise. Limit your characters to under 1000 characters.";
        }
        if (!isset($_POST['rating'] ) ) {
            $errors[] = "Please provide a star rating";
        } else {
            $input['rating'] = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);


            if ( is_null($input['rating']) || ($input['rating'] === false ) || ( $input['rating'] < 1 ) || ( $input['rating'] > 5 ) ) {

                $errors[] = "Please provide a valid rating";
            }
        }

        $input['bookId'] = filter_input(INPUT_POST, 'bookId', FILTER_VALIDATE_INT);
        if (is_null($input['bookId'] || ($input['bookId'] === false)) ) {
            $errors[] = "Wrong book id";
        }

        return array( $errors, $input );

    }

}

?>
