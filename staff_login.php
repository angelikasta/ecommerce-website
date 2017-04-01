<?php
    //Start session management
    session_start();

    //Get name and address strings 
    $email= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);    

    //Connect to MongoDB and select database
    $mongoClient = new MongoClient();

    $db = $mongoClient->gameShop;

    $collection = $db->staff;

    //Create a PHP array with our search criteria
    $findCriteria = [
        "email" => $email, 
     ];

    //Find all of the staff that match  this criteria
    $cursor = $db->staff->find($findCriteria);

    //Check that there is exactly one staff member
    if($cursor->count() == 0){
        echo 'Email not recognized.';
        return;
    }
    else if($cursor->count() > 1){
        echo 'Database error: Multiple staff have same email address.';
        return;
    }
   
    //Get staff member
    $staff = $cursor->getNext();
    
    //Check password
    if($staff['password'] != $password){
        echo 'Password incorrect.';
        return;
    }
        
    //Start session for this user
    $_SESSION['loggedInUserEmail'] = $email;

    $_SESSION['staff_id'] = $staff['_id'];
    
    //Inform web page that login is successful
    echo 'Welcome! Staff logged in';
    
    //Close the connection
    $mongoClient->close();
    