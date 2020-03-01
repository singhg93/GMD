<?php


class Page {
    //Attributes
    public static $title = "";
    
    //Methods
    // function for the header
    static function header(){?>

        <!doctype html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <!-- FontAwesome Icons -->
            <script src="https://kit.fontawesome.com/1f469ea0b4.js"></script>
            <link rel="stylesheet" href="web\css\styles.css">
            <title><?php echo self::$title; ?></title>
        </head>
        <body>

        <nav class="navbar navbar-expand navbar-light bg-white pt-3">
            <div class="collapse navbar-collapse">
                <a class="nav-link text-dark" href="index.php">GMD Books</a>
            </div>
        <?php

            // if the user is logged in 
            if (LoginManager::verifyLogin()){

                // show the username and logout button
                echo "<p class='mx-2'><i class='fas fa-user mx-1'></i>".$_SESSION['username']."</p><a class='btn btn-warning' href='GroupProject-logout.php?location=".urlencode($_SERVER['REQUEST_URI'])."'>Logout</a>";

            }else {

                //else render the login prompt
                echo "<a href='GroupProject-login.php?location=".urlencode($_SERVER['REQUEST_URI'])."' class='btn btn-info btn-rounded mb-4'>Log In</a>";
            }
            ?>
                
        </nav>
        <div class="container" style="min-height: 524px;">
        
    <?php   }


    // function to show any message
    static function showMessage( array $messages ) { 
        //iterate through array and display each message
        foreach ( $messages as $message ) {
            echo "<h6 class=\"text-center\">$message</h6>";
        }
        
    }

    static function bookName( $statement ) {

        echo $statement;

    }

    // function to show footer
    static function footer(){?>
        
        </div>
<h6 class="footer text-center bg-primary text-light">Created by : Melodie Lucero, Darren Singh, Gursewak Singh</h6>
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
        </html>

    <?php   }

    //function for login form
    static function showLoginForm( $location = null){?>

        <div class="card border-3 col-md-8 m-auto py-5">
            <h2 class="card-title m-auto">Sign In</h2>
            <div class="card-body py-5">
                    <form class="form" method="POST" action="GroupProject-login.php">
                        <div class="form-group col-md-8 m-auto ">
                        <?php 
                            if ($location != null ){
                                $loc = htmlspecialchars($location);
                                echo "<input type='hidden' name='location' value='$loc'/>";
                            }
                        ?>
                            <label class="font-weight-bold" for="username">Username</label>
                            <input class="form-control form-control-lg mb-4" name="username" id="username";  type="text" placeholder="Username">
                        </div>
                        <div class="form-group col-md-8 m-auto">
                            <label class="font-weight-bold" for="password">Password</label>
                            <input class="form-control form-control-lg mb-5" name="password" id="Password" type="password" placeholder="Password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info m-auto ">Log In</button>
                        </div>
                    </form>
            </div>
            <div class="text-center w-100">
                <a href='GroupProject-register.php' class="btn btn-outline-info btn-sm">Create a New Account</a>
            </div>
        </div>

    <?php   }


    // function for showing the register form
    static function registerForm(){?>

        <div class="card border-0 shadow-lg col-md-8 m-auto p-5">
        <h2 class="card-title m-auto">Sign Up</h2>
            <div class="card-body py-5">
                    <form class="form" method="POST" action="GroupProject-register.php">
                        <div class="form-group col-md-8 m-auto">
                            <label class="font-weight-bold" for="firstname">First Name</label>
                            <input class="form-control form-control-lg mb-4" name="firstname" id="firstname";  type="text" required>
                        </div>
                        <div class="form-group col-md-8 m-auto">
                            <label class="font-weight-bold" for="lastname">Last Name</label>
                            <input class="form-control form-control-lg mb-4" name="lastname" id="lastname" type="text" required>
                        </div>
                        <div class="form-group col-md-8 m-auto">
                            <label class="font-weight-bold" for="email">Email</label>
                            <input class="form-control form-control-lg mb-4" name="email" id="email" type="email" required>
                        </div>
                        <div class="form-group col-md-8 m-auto">
                            <label class="font-weight-bold" for="username">Username</label>
                            <input class="form-control form-control-lg mb-4" name="username" id="username";  type="text" required>
                        </div>
                        <div class="form-group col-md-8 m-auto">
                            <label class="font-weight-bold" for="password">Password</label>
                            <input class="form-control form-control-lg" name="password" id="Password" type="password" required>
                            <p class="mb-5"><em>Passwords must consist of at least 8 characters.</em></p>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info m-auto">Create Your GMD Account</button>
                        </div>
                    </form>
            </div>
        </div>

    <?php   }

    // function to show the book search form
    static function bookSearchForm(){?>
        <!-- Search bar for book queries -->
        <form class="form-inline justify-content-center my-5" method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input class="form-control form-control-lg w-75 text-center text-white bg-dark bookSearch" name="bookSearch" type="text" placeholder="Title, Author or ISBN">
                <button class="btn btn-outline-dark mx-1 py-2" type="submit"><i class="fas fa-search mr-2"></i>Search</button>
        </form>
            
    <?php   }

    // function to list all the books that are passed in
    static function listBooks($books){
            //returns false if books array is empty
            if ($books) {
                //display table heading
                echo "<br>";
                echo "<div class='card bg-transparent border border-0 shadow justify-content-center'>";
                echo "<table class='table table-hover'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th scope='col'>ISBN</th>";
                echo "<th scope='col'>Title</th>";
                echo "<th scope='col'>Author</th>";
                echo "<th scope='col'>Year</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                // iterate through each book and display data in the table row
                foreach ($books as $book) {
                    echo "<tr>";
                    echo "<td><a href='?action=detail&bookId=".$book->getBookID()."'>".$book->getIsbn()."</a></td>";
                    echo "<td>".$book->getTitle()."</td>";
                    echo "<td>".$book->getAuthor()."</td>";
                    echo "<td>".$book->getPublicationYear()."</td>";
                    echo "</tr>";
                }
                //close table
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                // display message if search query was empty
                self::showMessage(array("No Results Found"));
            }
        
    }

    // function to show the book details
    static function bookDetails($book, $bookDescription ){?>

        <div class="card border border-0 shadow mb-3 mt-5">
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card-body">
                    <img class="card-img" src="http://covers.openlibrary.org/b/isbn/<?php echo $book->getISBN(); ?>.jpg">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">

                    <?php
                    echo '<h2 class="card-title">'.$book->getTitle().'</h2>
                         <h6 class="ml-1">'.$book->getAuthor().'</h6>'.
                        '<p class="card-text my-4">'.$bookDescription.'</p>
                        <hr>
                        <p class="ml-1"> ISBN: '.$book->getISBN().'</p>
                        <p class="ml-1"> Publication Year: '.$book->getPublicationYear().'</p>';
                    ?>

                    </div>
                </div>
            </div>
            <!-- Amazon link to purchase book -->
            <a target="_blank" rel="noopener noreferrer" class="text-primary ml-auto mr-4 mb-4" href="https://www.amazon.ca/s?k=<?php echo $book->getISBN(); ?>&ref=nb_sb_noss"><button class="btn btn-dark mr-2 p-3 my-1">Buy on Amazon</button></a>
        </div>

    <?php   }

    // function to list all the reviews
    static function listReviews($reviews, $bookId){
            
        echo '<div class="card border border-0 my-4">';
        echo '<div class="card-body mx-4 my-2">';

        if($reviews){
            echo '<hr>';
            
            foreach($reviews as $review){
                echo    '<div class="mb-3">'.self::displayStarRating($review->getRating()).'</div>';
                echo    '<p>'.$review->getReviewText().'</p>';
                echo    '<h6>by - '.$review->getUserName().'</h6>';
                echo    '<p><small class="">@'. date( "H:i - d M, Y", $review->getLastUpdate() ).'</small><p>';
                if(LoginManager::verifyLogin() && $review->getUserId() == $_SESSION['userId']){

                    echo    '<a href="GroupProject-postReview.php?action=editReview&bookId='.$bookId.'&reviewId='.$review->getReviewID().'&location='.urlencode($_SERVER['REQUEST_URI']).'">EDIT</a><br>';
                    
                    echo    '<a href="GroupProject-postReview.php?action=deleteReview&reviewId='.$review->getReviewID().'&location='.urlencode($_SERVER['REQUEST_URI']).'">DELETE</a><br>';
                }
                    
                echo    '<hr>';
            }

        } else{
        echo '<h2 class="text-center">No Reviews Yet</h2><hr>';
        }
        
        echo '<div class="text-center">';

        echo "<a href=\"GroupProject-postReview.php?action=showForm&bookId=$bookId&location=".urlencode($_SERVER['REQUEST_URI'])."\" class=\"btn btn-info p-3 mt-3\">Write a Review</a>";

            
        echo '</div>';
        echo '</div>';
        echo '</div>';

    }
    // function to show the post review form
    static function postReviewForm( $bookId, $location = null) { ?>

       <div Class = "card border-3 col-md-8 m-auto py-5">
          <h2 Class = "card-title m-auto">Create A Review</h2>
            <div Class = "card-body py-5">
              <Form Class = "form-group col-md-8 m-auto" Method = "POST" Action = "GroupProject-postReview.php">

                <input type="hidden" name="bookId" value="<?php echo $bookId; ?>">
                <input type="hidden" name="action" value="newReview">
                <?php 
                    if ( $location != null ) {
                     echo '<input type="hidden" name="location" value="'. htmlspecialchars($location).'">';

                    }
                ?>
                <div Class = "text-center">

                  <Label Class = "font-weight-bold" For = "reviewText">Leave A Review</Label>
                  <Textarea Class = "form-control mb-4"  Type = "text" Placeholder = "Describe your experience"  name = "reviewText" Rows = "7" Maxlength = "1000"></Textarea>
                
                <Label Class = "font-weight-bold" For = "rating">How Would You Rate This Book?</Label>
                <!--  reference : https://stackoverflow.com/a/22570536 -->
                <span class="star-rating star-5" require>
                <input type="radio" name="rating" value="1"><i></i>
                <input type="radio" name="rating" value="2"><i></i>
                <input type="radio" name="rating" value="3"><i></i>
                <input type="radio" name="rating" value="4"><i></i>
                <input type="radio" name="rating" value="5"><i></i>
                </span>
                </div>
      
                <div Class = "text-center">
                  <Button Type = "submit" Class = "btn btn-info m-auto" Value = "Submit Review">Submit Review</Button>
                </div>
              </Form>
            <div>
          </div>
        </div>

    <?php   }
    // function to show the post review form
    static function editReviewForm(Review $review, $location = null) { ?>

       <div Class = "card border-3 col-md-8 m-auto py-5">
          <h2 Class = "card-title m-auto">Edit Your Review</h2>
            <div Class = "card-body py-5">
              <Form Class = "form-group col-md-8 m-auto" Method = "POST" Action = "GroupProject-postReview.php">

                <input type="hidden" name="action" value="updateReview"> 
                <input type="hidden" name="reviewId" value="<?php echo $review->getReviewID();?>"> 
                <?php 
                    if ( $location != null ) {
                     echo '<input type="hidden" name="location" value="'. htmlspecialchars($location).'">';

                    }
                ?>


                <div Class = "text-center">
                  <Label Class = "font-weight-bold" For = "post-review-textbox">Edit Review</Label>
                  <Textarea Class = "form-control mb-4"  Type = "text" Placeholder = "Edit your Review" name = "reviewText" Rows = "15" Maxlength = "1000"><?php echo $review->getReviewText();?></Textarea>
                  
                  <span class="star-rating star-5">                      
                      <!--  reference : https://stackoverflow.com/a/22570536 -->
                      <?php 
                    for($i=1;$i<6;$i++){
                        if($review->getRating()==$i){
                            echo "<input type=\"radio\" name=\"rating\" value=\"$i\" checked><i></i>";
                        }else{
                            echo "<input type=\"radio\" name=\"rating\" value=\"$i\"><i></i>";
                        }
                    }
                    ?>
                </span>
                </div>
                <div Class = "text-center">
                  <Button Type = "submit" Class = "btn btn-info m-auto" Value = "Submit Review">Submit Edits</Button>
                </div>
              </Form>
            <div>
          </div>
        </div>

    <?php   }

    // function to show the summary for reviews for a book
    static function reviewSummary(array $bookReviews){
        //Checks if there any reviews
        if($bookReviews){

            //Create K&V array for ratings
            $ratingStats = array(
                '5' => 0,
                '4' => 0,
                '3' => 0,
                '2' => 0,
                '1' => 0,
            );
            
            //iterate through reviews
            foreach($bookReviews as $review){
                //grab review rating and catagorize into ratingStats array
                switch($review->getRating()){
                    
                    case 5:
                    $ratingStats['5']++;
                    break; 
                    case 4:
                    $ratingStats['4']++;
                    break; 
                    case 3:
                    $ratingStats['3']++;
                    break; 
                    case 2:
                    $ratingStats['2']++;
                    break; 
                    case 1:
                    $ratingStats['1']++;
                    break; 
                    default:
                    //log error if rating cannot be catagorized
                    error_log("ERROR: Failed to catagorize $review rating for".$review->getBookID(),0);
                    break;
                }
            }
            
            echo '<div class="container">';
            echo '<div class="col-4">';
            
            //loop through each rating and display stats 
            for($i=5;$i>0;$i--){
                
                echo '<div class="progress my-1">';
                echo '<div class="progress-bar bg-dark" role="progressbar" style="min-width:45px" >';
                echo "<span class=\"mr-auto ml-2 text-weight-bold\">$i Star</span>";
                echo '</div>';
                echo  '<div class="progress-bar bg-info" role="progressbar"  style="width:'.($ratingStats["$i"]/array_sum($ratingStats)*100).'%">';
                echo '</div>';
                printf('<span class="mr-auto ml-1 font-weight-bold">%.0f%%',($ratingStats["$i"]/array_sum($ratingStats)*100));
                echo '</span></div>';
            }
            
            echo '</div>';
            echo '</div>'; 
        }
            
    }

    // function to show the star rating
    private static function displayStarRating(int $rating){
        // loop through 1 to 5
        for($x=1;$x<6;$x++){
            // if rating greater or equal to value, display filled the star icon
            if($rating >= $x){
                echo '<i class="fa fa-star checked"></i>';
            }   else{
                echo '<i class="fa fa-star"></i>';
            }
        }
    }
}



?>
