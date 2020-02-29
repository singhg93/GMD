<?php

class RestClient {

    static function call( string $callData ) {

        $searchQuery = str_replace( " ", "%20", $callData );
        $options = "&maxResults=1&fields=items(volumeInfo/description)&key=".API_KEY."";

        $url = API_URL.$searchQuery.$options."";

        $result = file_get_contents( $url );

        return $result;
    }

}


?>
