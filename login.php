<!DOCTYPE html>
<html>
    <head>
        <title>GameWorld - Login</title>
        <link rel="stylesheet" type="text/css" href="new.css" />
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />

    </head>
    <body>
        <div class="container">
            <div id="tophead">
                <div id="searchBar">
                    <form action="find.php" method="get">
                        <input type="text" name="search" placeholder="SEARCH...">
                    </form>
                </div>
            </div>

            <header>
                <div id="logoimg">
                    <a href="test.html">
                        <img src="img/logo1.png"/>
                    </a>
                </div>

                <nav>
                    <!--navigation-->
                    <div id="nav">
                        <ul>
                            <li><a href="test.html">HOME</a></li>
                            <!--dropdown menu !-->
                            <li class="dropdown">
                                <div class="dropdown-content">
                                    <a class="dropbtn">SHOP BY CONSOLE</a>
                                <div class="dropdown-content">
                                    <a href="shoptestMongo.php">ALL GAMES</a>
                                    <a href="shoptestMongoXBOX.php">XBOX </a>
                                    <a href="shoptestMongoPlay.php">PLAYSTATION </a>

                                </div>
                            </li>
                            <li><a href="about.html">ABOUT US</a></li>
                            <!--dropdown menu !-->
                            <li class="dropdown">
                                <a class="dropbtn">MY ACCOUNT</a>
                                <div class="dropdown-content">
                                    <a href="login.html">LOGIN </a>
                                    <a href="register.html">REGISTER </a>
                                    <a href="myinfo.html">MY INFO</a>
                            </li>
                            <!--google shopping cart icon !-->
                            <a href="cart.html"><i class="material-icons" style="color:white;text-align:right;font-size:26px;">
                                    shopping_cart</i></a>


                        </ul>
                    </div>
                    </div>
                </nav>
            </header>
            <section>
                <!--change default setting for text align to center !-->
                <div id="section" style="text-align:center; background-color:white">
                    <br>
                    <h1 id ="h1">Login</h1>
                    <br>
                    <h2>
                        <!-- login form !-->
                        <div id="form2" style="width:50%"><form action="login.php" method="post">
            Email: <input type="email" name="email" required>
            Password: <input type="password" name="password" required>
            <input type="submit">
        </form>
                        </div>
                        
                        <?php
    //Start session management
    session_start();

    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $email= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);    

    //Connect to MongoDB and select database
    $mongoClient = new MongoClient();
    $db = $mongoClient->gameShop;
   $collection = $db->customers;

    //Create a PHP array with our search criteria
    $findCriteria = [
        "email" => $email, 
     ];

    //Find all of the customers that match  this criteria
    $cursor = $db->customers->find($findCriteria);

    //Check that there is exactly one customer
    if($cursor->count() == 0){
        echo 'Email not recognized.';
        return;
    }
    else if($cursor->count() > 1){
        echo 'Database error: Multiple customers have same email address.';
        return;
    }
   
    //Get customer
    $customer = $cursor->getNext();
    
    //Check password
    if($customer['password'] != $password){
        echo 'Password incorrect.';
        return;
    }
        
    //Start session for this user
    $_SESSION['loggedInUserEmail'] = $email;
    
    //Inform web page that login is successful
    echo 'ok customer logged in,';
    
    //Close the connection
    $mongoClient->close();
                        
                        ?>
                        
                        
                        
                        
                        
                </div>

            </section>
                


            <!--Footer -->
            <footer>
                <div id="footer">
                    <article>
                        <h4>INFORMATION </h4>

                        <p>
                            <!--google icon-->
                            <i class="material-icons" style="color:#4eab04; font-size:16px;
                               padding:0px 3px 0px 3px;">
                                star</i>
                            100% CUSTOMER SATISFACTION!
                        </p>
                        <p>
                            <!--google icon-->
                            <i class="material-icons" style="color:#4eab04; font-size:16px;
                               padding:0px 3px 0px 3px;">
                                local_shipping</i>
                            100% FREE DELIVERY!
                        </p>
                        <p>
                            <!--google icon-->
                            <i class="material-icons" style="color:#4eab04; font-size:16px;
                               padding:0px 3px 0px 3px;">
                                check_box</i>
                            100% FREE RETURNS!
                        </p>
                    </article>

                    <article>
                        <h4>PAYMENTS</h4>
                        <img src="img/paypal2.png" style="width:280px;"/>
                    </article>

                    <article>
                        <h4>ABOUT US </h4>
                        <p>
                            <!--google icon-->
                            <i class="material-icons" style="color:#4eab04; font-size:16px;
                               padding:0px 3px 0px 3px;">
                                room</i>
                            Game World , 1234 Example Road,
                            <br>
                            London N4 89GR 
                        </p>
                        <p>
                            <!--google icon-->
                            <i class="material-icons" style="color:#4eab04; font-size:16px;
                               padding:0px 3px 0px 3px;">
                                call</i>
                            0208-123-456
                        </p>
                        <p>
                            <!--google icon-->
                            <i class="material-icons" style="color:#4eab04; font-size:16px;
                               padding:0px 3px 0px 3px;">
                                email</i>
                            info@gameworld.co.uk
                        </p>
                    </article>
                </div>
            </footer>
        </div>
    </body>
</html>

 