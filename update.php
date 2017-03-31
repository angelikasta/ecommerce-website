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
                  
                    session_start();
              
                   if( array_key_exists("customer_id", $_SESSION) ){
         
                    $customer = $_SESSION['customer_id'];
                    
                    $mongoClient = new MongoClient();
                    
                        $db = $mongoClient->gameShop;
                    
                
                        
                       
                        $newOrderCus = $db->customers->update( array('_id' => new MongoId($customer)), array('$set' => array("lastorder" => [])));
                        
                       $newOrderCus2 = $db->customers->update( array('_id' => new MongoId($customer)), array('$set' => array("searches" => [])));
                       
                       $cust = $db->customers->findOne(['_id' => new MongoId($customer)]);
                       
                       
                    
                    echo '<h3> Update details </h3>
                    <hr style="width:50%;">';
                    
                    echo "<br>";
                  
                        echo '<div id="form2"><form action="save_customer.php" method="post">';
    echo 'First name: <input type="text" name="firstname" value="' . $cust['firstname'] . '" required><br>';
    echo 'Last name: <input type="text" name="lastname" value="' . $cust['lastname'] . '" required><br>';
    echo 'Email: <input type="text" name="email" value="' . $cust['email'] . '" required><br>';
    echo 'Password: <input type="password" name="password" value="' . $cust['password'] . '" required><br>'; 
    echo 'Phone number: <input type="text" name="phonenumber" value="' . $cust['phonenumber'] . '" required><br>';
    echo 'Address: <input type="text" name="address" value="' . $cust['address'] . '" required><br>';
    echo 'City: <input type="text" name="city" value="' . $cust['city'] . '" required><br>';
    echo 'Post code: <input type="text" name="postcode" value="' . $cust['postcode'] . '" required><br>';
    echo 'Date of birth <input type="date" name="dateofbirth" value="' . $cust['dateofbirth'] . '" required>'; 
                       
                       
                    //add array of products??
                       
    echo '<input type="hidden" name="lastorder" value=" ">';
    echo '<input type="hidden" name="searches" value=" ">';
    echo '<input type="hidden" name="id" value="' . $cust['_id'] . '" required>'; 
    echo '<input type="submit">';
    echo '</form><br></div><br>';
                   }
                    else {
                        
                        echo "<p> Please log in to change your details first </p>";
                    }
                    
                    ?>
                    
                    <br>
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