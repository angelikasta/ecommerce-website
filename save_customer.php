<!DOCTYPE html>
<html>
    <head>
        <title>GameWorld - My Account</title>
        <link rel="stylesheet" type="text/css" href="new.css" />	
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />

    </head>
    <body>
        <div class="container">
            <div id="tophead">
                <div id="searchBar">
                    <!--search form-->
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
                               <a class="dropbtn">SHOP BY CONSOLE</a>
                                <div class="dropdown-content">
                                    <a href="shoptestMongo.php">ALL GAMES</a>
                                    <a href="shoptestMongoXBOX.php">XBOX </a>
                                    <a href="shoptestMongoPlay.php">PLAYSTATION </a>

                                </div>
                            </li>
                            <li><a href="about.html">ABOUT US</a></li>
                            <!--dropdown menu-->
                            <li class="dropdown">
                                <a class="dropbtn">MY ACCOUNT</a>
                                <div class="dropdown-content">
                                <a href="loginAjax.php">LOGIN </a>
                                    <a href="register.php">REGISTER </a>
                                    <a href="update.php"> UPDATE MY INFO</a>
                                    <a href="lastorders.php"> MY ORDERS</a>
                            </li>
                            <!--google shopping cart icon!-->
                            <a href="cart.html"><i class="material-icons" style="color:white;text-align:right;font-size:26px;">
                                    shopping_cart</i></a>
                        </ul>
                    </div>
                    </div>
                </nav>
            </header>
            <section>
                <div id="section" style="text-align:center;background-color:white;">
      
                <h2 style="margin:0;padding:00;text-align:left;">My Account Info</h2>


<?php
//Connect to database
                    
session_start();
                    
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->gameShop;
                    

$customer = $_SESSION['customer_id'];
                    
$cust = $db->customers->findOne(['_id' => new MongoId($customer)]);
                    

//Extract the customer details 
$firstname= filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$phonenumber = filter_input(INPUT_POST, 'phonenumber', FILTER_SANITIZE_STRING);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
$postcode = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING);
$dateofbirth = filter_input(INPUT_POST, 'dateofbirth', FILTER_SANITIZE_STRING);
//deleting customers last order and searches!!
$lastorder = array();
$searches = array();                    
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

//Construct PHP array with data
$customerData = [
    "firstname" => $firstname,
    "lastname" => $lastname,
    "email" => $email,
    "password" => $password,
    "phonenumber" => $phonenumber,
    "address" => $address,
    "city" => $city,
    "postcode" => $postcode,
    "dateofbirth" => $dateofbirth,
    "lastorder" => $lastorder,
    "searches" => $searches,
    "_id" => new MongoId($id)
];

//Save the product in the database - it will overwrite the data for the product with this ID
$returnVal = $db->customers->update(array("_id" => new MongoId($id)), $customerData);
   


  
                    if ($returnVal['ok']==1){
                       echo "<p>Your details have been updated successfully</p>";
                        
                    }
                    else {
                        echo "<p>Error saving the updated details.</p>";
                    }
                    
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
                    <!--google icon!-->
                    <i class="material-icons" style="color:#4eab04; font-size:16px;
                       padding:0px 3px 0px 3px;">
                        star</i>
                    100% CUSTOMER SATISFACTION!
                </p>
                <p>
                    <!--google icon!-->
                    <i class="material-icons" style="color:#4eab04; font-size:16px;
                       padding:0px 3px 0px 3px;">
                        local_shipping</i>
                    100% FREE DELIVERY!
                </p>
                <p>
                    <!--google icon!-->
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
                    <!--google icon!-->
                    <i class="material-icons" style="color:#4eab04; font-size:16px;
                       padding:0px 3px 0px 3px;">
                        room</i>
                    Game World , 1234 Example Road,
                    <br>
                    London N4 89GR 
                </p>
                <p>
                    <!--google icon!-->
                    <i class="material-icons" style="color:#4eab04; font-size:16px;
                       padding:0px 3px 0px 3px;">
                        call</i>
                    0208-123-456
                </p>
                <p>
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


