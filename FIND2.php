<!DOCTYPE html>
<html>
    <head>
        <title>GameWorld - Shop </title>
        <link rel="stylesheet" type="text/css" href="new.css" />
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">		
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
                                    <a href="login.html">LOGIN </a>
                                    <a href="register.html">REGISTER </a>
                                    <a href="myinfo.html">MY INFO</a>
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
                    <!--side navigation !-->
                    <div id="sidenav">
                        <ul>
                            <div class="sidecontentcat">
                                <h3>GENRE</h3>

                            </div>
                            <!--side bar content-->
                            <li class="sidecontent">
                                <a href="#">STRATEGY GAMES </a><br>
                                <a href="#">ACTION & ADVENTURE  </a><br>
                                <a href="#">RPG </a><br>
                                <a href="#">FIGHTING GAMES </a><br>
                                <a href="#">DRIVING & RACING</a><br>
                                <a href="#">SHOOTER</a><br>
                                <a href="#">CHILDREN'S</a><br>
                            </li>
                   
                        </ul>
                    </div>

                    <div id="shopSection">
                        <br>
                        <h2>RESULTS</h2>
                        <hr>
                        
     
                        <?php
                        //Connect to MongoDB
                        $mongoClient = new MongoClient();

                        //Select a database
                        $db = $mongoClient->gameShop;

                        //Extract the data that was sent to the server
                        $search_string = 'filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING)';

                        //Create a PHP array with our search criteria
                        $findCriteria = [
                        '$text' => [ '$search' => $search_string ] 
                        ];
                        
                       
                        //Find all of the customers that match  this criteria
                        $cursor = $db->products->find($findCriteria);

                        //Output the results
                    
                        foreach ($cursor as $product){
                        echo '<article class="article">';
                            echo '<img src='  . $product["image_url"] . ">";
                            echo'<p>' . $product["title"] . "</p>";
                            echo'<p>' . $product["price"] . "</p>";
                             echo '<td><button onclick=\'basket.add("' . $product["_id"] . '", "' . $product["title"] . '", 1,' . $product["price"] . ')\'>ADD TO CART</button>';
                            echo '</article>';
                                              }
                        
                        

                        //Close the connection
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

