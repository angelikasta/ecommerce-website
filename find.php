<!DOCTYPE html>
<html>
    <head>
        <title>GameWorld - Shop </title>
        <link rel="stylesheet" type="text/css" href="new.css" />
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
        <script src="basket.js"></script>
    </head>
    <body>
        <div class="container" style="background-color:white">
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
                            <!--google shop cart icon!-->
                            <a href="cart.html"><i class="material-icons" style="color:white;text-align:right;font-size:26px;">
                                    shopping_cart</i></a>

                        </ul>

                    </div>
                </nav>

            </header>

            <section>
                <!--change default section colour to white !-->
                <div id="section" style="background-color:white">

                    <div id="shopSection">
                        <br>
                        <h2>RESULTS</h2>
                        <hr>
                                 <!-- <form style="width:20%; text-align:right;" action="sort.php" method="get">
  <select name="selector">
    <option value="lowprice" selected>Low to High Price</option>
    <option value="highprice">High to Low Price</option>
  </select>
  <input type="submit" style="width:20%;font-size:9px; padding:5px;margin:2px;">
</form>
                        -->
                        <form method="post">
                        
                            <select name="sorting" style="width:80%">
                                    <option value="hightolow">Price High to Low</option>
                                    <option value="lowtohigh">Price Low to High</option>
                                </select>
                           <input type="submit">
                            </form>
                        
     
                        <?php
                        
                       session_start();
                        
                        //Connect to MongoDB
                        $mongoClient = new MongoClient();

                        //Select a database
                        $db = $mongoClient->gameShop;
                        
                         //Extract the data that was sent to the server
                        $search_string = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
                        
                        $sorting = filter_input(INPUT_POST, 'sorting', FILTER_SANITIZE_STRING);
                        
                        
                        
                        //register search on customer document if customer is logged in
                        if( array_key_exists("customer_id", $_SESSION) ){
                            $customer = $_SESSION['customer_id'];
                            
                            //find the customer who is logged in
                            $cust = $db->customers->findOne(['_id' => new MongoId($customer)]);
                            
                            //push the searched keywords into the array of searches
                             $newOrderCus = $db->customers->update( array('_id' => new MongoId($customer)), array('$push' => array("searches" => $search_string)));
                            
    }            
                       
                        //Create a PHP array with our search criteria
                        $findCriteria = [
                        '$text' => [ '$search' => $search_string ] 
                        ];
                        
                        
                        //Find all of the customers that match  this criteria
                        $cursor = $db->products->find($findCriteria);
                        
                        //price low to high as default
                        $cursor = $cursor->sort(array('price' => -1));
                        

if($sorting=="lowtohigh"){
    
$cursor = $cursor->sort(array("price" => 1));
    echo"<br><p>Results sorted by low to high price</p><br><hr>";
    
                        
}
                            
if($sorting=="hightolow"){
    
$cursor = $cursor->sort(array("price" => -1));
     echo"<br><p>Results sorted by high to low price</p><br><hr>";
    
    
}
   

                        
                         foreach ($cursor as $product){
                        echo '<article class="article">';
                            echo '<img src='  . $product["image_url"] . ">";
                            echo'<p>' . $product["title"] . "</p>";
                            echo'<p>' . $product["price"] . "</p>";
                             echo '<td><button onclick=\'basket.add("' . $product["_id"] . '", "' . $product["title"] . '", 1,' . $product["price"] . ')\'>ADD TO CART</button>';
                            echo '</article>';
                                              }
                        
                       
                         $mongoClient->close();

                        ?>
				

                        

                    </div>
                     <h2 style="visibility: hidden;">Basket</h2>
                    <div id="BasketDiv" style="visibility: hidden;">Loading</div>
                    <script>
                        var basket = new Basket("basket.php");
                        basket.get();
                    </script>
                </div>

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

