<?php
    //Start session management
    session_start();
    
    //Find out if session exists
    if( array_key_exists("customer_id", $_SESSION) ){
        $customer = $_SESSION['customer_id'];
    }
    else{
        echo 'Please log in to check your details!';
    }
    
    