<?php
function getSegment()
{   
    $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    // print_r($uriSegments); die;
    return $uriSegments;
}

?>