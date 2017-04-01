<!DOCTYPE html>
<html>
    <head>
        <title>GameWorld - Checkout</title>
        <link rel="stylesheet" type="text/css" href="new.css" />	
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
        <script src="basket.js"></script>

    </head>
    <body style="background:white;">
        <div class="container">
            <div id="tophead">
                <!--search bar form-->
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
                            <!--dropdown menu  !-->
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
                                </div>
                            </li>
                            
                            <!--google shopping cart icon !-->
                            <a href="cart.html"><i class="material-icons" style="color:white;text-align:right;font-size:26px;">
                                    shopping_cart</i></a>

                        </ul>
                    
                    </div>
                </nav>
            </header>
            <section>
                <!--change default setting of text align to center !-->
                <div id="section" style="text-align:center;background-color:white">
                    <h2 style="margin:0;padding:00;text-align:left;">Checkout</h2>


                    <?php
                    session_start();

                    $mongoClient = new MongoClient();
                    $db = $mongoClient->gameShop;
                    
                    //check if customer is logged in
                    if (array_key_exists("customer_id", $_SESSION)) {
                    
                    $customer = $_SESSION['customer_id'];

                    $basket_id = $_SESSION['basket_id'];

                    //find the basket of the customer
                    $prod = $db->baskets->findOne(['_id' => new MongoId($basket_id)]);
                    
                    //find the customer
                    $cust = $db->customers->findOne(['_id' => new MongoId($customer)]);

                    echo '<h3>Order confirmed</h3>
                    <hr style="width:50%;">';
                        
                    //display products ordered
                    echo '<h4> Products ordered: </h4>
                    <hr style="width:20%;">';
                    
                    //variable to store total price of the order
                    $totalPrice = 0;

                        
                    foreach ($prod["products"] as $product) {

                        //changes quantity of products -1 in products collection
                        $newProducts = $db->products->update(array('_id' => new MongoId($product['id'])), array('$inc' => array("quantity" => -1)));
                        
                        //display the items ordered
                        echo '<p>' . $product["title"] . " " . $product["price"] . "</p>";
                        $totalPrice += $product["price"];
                    }

                    //display the total price
                    echo '<p> Total price is: ' . $totalPrice . "</p>";

                    echo "<br>";
                    
                    //display customers details
                    echo '<p> Your details:  </p> <hr style="width:20%;">';

                    echo '<p>' . $cust["firstname"] . " " . $cust["lastname"] . "</p>";
                    echo '<p>' . $cust["address"] . "</p>";
                    echo '<p>' . $cust["city"] . "</p>";
                    echo '<p>' . $cust["postcode"] . "</p>";
                    // }
                    //unset($stuff['_id']);    
                        
                    $ship = array("shipment" => "no");
                    
                    //create the order document with customer details and product details
                    $newOrder = $db->orders->insert([$cust, $prod, $ship]);

                    //add the order to customers document
                    $newOrderCus = $db->customers->update(array('_id' => new MongoId($customer)), array('$set' => array("lastorder" => $prod)));
                    }
                    else {
                        echo '<h3>Please login or register before completing an order</h3>';
                    }
                    
                    
                        
                    $mongoClient->close();
                        
                    ?>  
                    
                    <h3 style="text-align:left;display:inline-block;padding:10px;">
                        <!--google icon!-->
                        <i class="material-icons" style="color:#4eab04; font-size:28px;">
                            star</i>
                        100% CUSTOMER SATISFACTION!
                    </h3>
                    <!--change default appearance of h3  !-->
                    <h3 style="text-align:left;display:inline-block;padding:10px;">
                        <!--google icon!-->
                        <i class="material-icons" style="color:#4eab04;font-size:28px;">
                            local_shipping</i>
                        100% FREE UK DELIVERY!

                    </h3>
                    <!--change default appearance of h3  !-->
                    <h3 style="text-align:left;display:inline-block;padding:10px;">
                        <!--google icon!-->
                        <i class="material-icons" style="color:#4eab04; font-size:28px;">
                            check_box</i>
                        100% FREE RETURNS!

                    </h3>


                </div>
                
                <!--basket object  -->
                <h2 style="visibility: hidden;">Basket</h2>
                <div id="BasketDiv" style="visibility: hidden;">Loading</div>
                <script>
                    var basket = new Basket("basket.php");
                    basket.get();
                </script>

            </section>

            <!--footer-->
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
                            <!--google icon!-->
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