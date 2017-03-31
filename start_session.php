<?php
    //Start session  management
    session_start();
    
    //Set a session variable
    $_SESSION["username"] = 'David Gamez';

    //Output result
    echo 'Session started. username=' . $_SESSION["username"];
    