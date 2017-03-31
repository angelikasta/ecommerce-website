<?php
    //Start session management
    session_start();
    
    if( array_key_exists("loggedInUserEmail", $_SESSION) ){
        echo "Customer Logged In";
    }
    else{
        echo 'Not logged in.';
    }

