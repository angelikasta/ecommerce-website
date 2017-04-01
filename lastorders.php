<!DOCTYPE html>
<html>
    <head>
        <title>GameWorld - My Account</title>
        <link rel="stylesheet" type="text/css" href="new.css" />	
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
         <script src="basket.js"></script>
        
    </head>
    <body style="background-color:white">
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
                                </div>
                            </li>
                            
                            <!--google shopping cart icon!-->
                            <a href="cart.html"><i class="material-icons" style="color:white;text-align:right;font-size:26px;">
                                    shopping_cart</i></a>
                        </ul>
                    
                    </div>
                </nav>
            </header>
            <section>
                <div id="section" style="text-align:center;background-color:white;">

                    <h2 style="margin:0;padding:00;text-align:left;">My Account Info</h2>

                    <?php
                    
                    //DISPLAY LAST ORDER OF LOGGED IN CUSTOMER                      
                    session_start();

                    //Find out if customer is logged in
                    if (array_key_exists("customer_id", $_SESSION)) {
                        $customer = $_SESSION['customer_id'];

                        //conenct to mongo
                        $mongoClient = new MongoClient();

                        $db = $mongoClient->gameShop;
                        
                        //find the customer with the id
                        $cust = $db->customers->findOne(['_id' => new MongoId($customer)]);
                        
                       
                        echo '<h3>Latest Order </h3> <hr style="width:50%;">';
                        

                        $totalPrice = 0;
                        
                        //check if customer made an order in the past
                        if ($cust["lastorder"] != []) {
                            
                            echo '<h4> Products ordered: </h4> <hr style="width:20%;">';
                            
                            $lastorder = ($cust["lastorder"]);
                            $prods = ($lastorder["products"]);

                             //display their last order if it exists
                            foreach ($prods as $prod) {

                                echo '<p>' . $prod["title"] . " " . $prod["price"] . "</p>";
                                $totalPrice += $prod["price"];
                            }
                            
                            //display total price of the order
                        echo '<p> Total price is: ' . $totalPrice . "</p>";

                        echo "<br>";
                            
                        } 
                        
                        //no orders placed yet
                        if ($cust["lastorder"] == []) {
                            //display msg if no orders placed yet
                            echo "<p> No orders placed yet. </p>";
                        }
                        
                        
                        
                        //check if customer made some searches
                        if ($cust["searches"] != []){

                        //display the recommendations
                        echo '<h3> Recommendations: </h3>
                        <hr style="width:50%;">';
                        
                        //array with searches
                        $custkeys = ($cust["searches"]);
                    
                        
                        echo'<br>';
                        
                        //find the most common keyword in the array
                        $most = array_count_values($custkeys);
                        $mostkey = array_search(max($most), $most);
                    
                        
                        $findCriteria = [
                            '$text' => ['$search' => $mostkey]
                        ];
                        
                        //variable to control iteration
                        $it = 0;
                        
                        //find all products based on the keyword
                        $cursor = $db->products->find($findCriteria);
                        
                        //display the recommended products
                         foreach ($cursor as $product) {
                            echo '<center><article class="article">';
                            echo '<img src=' . $product["image_url"] . ">";
                            echo'<p>' . $product["title"] . "</p>";
                            echo'<p>' . $product["price"] . "</p>";
                            echo '<td><button onclick=\'basket.add("' . $product["_id"] . '", "' . $product["title"] . '", 1,' . $product["price"] . ')\'>ADD TO CART</button>';
                            echo '</article></center>';
                             
                             //display max of 4 products
                             if( ++$it == 4)
                                 break;
                        }
                        }
                        
                        
                        //if customer didnt make any searches yet display the msg
                        if ($cust["searches"] == []){
                              echo "<p>No recommendations yet. </p>";
                            
                        }
             
                        //customer not logged in   
                        } else {
                        echo 'Please log in to check your details!';
                    }
                    
                    
                    ?>
                    
                    
                    <br>

                </div>
                
                 <!--basket functionality -->
                    <h2 style="visibility: hidden;">Basket</h2>
                    <div id="BasketDiv" style="visibility: hidden;">Loading</div>
                    <script>
                        var basket = new Basket("basket.php");
                        basket.get();
                    </script>

                

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