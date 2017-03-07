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
           
                    <div id="shopSection">
                        <br>
                        <h2>ALL GAMES</h2>
                        <hr>
                        
                        <?php
                        
                        $mongoClient = new MongoClient();
                        $db = $mongoClient->gameShop;
                        
                    
                        //Find xbox
                        $products = $db->products->find();
                        
                        if($products->count() > 0){                                        
                        foreach ($products as $document) {
                            
                           echo '<article class="article">';
                            echo '<img src='  . $document["image_url"] . ">";
                            echo'<p>' . $document["title"] . "</p>";
                            echo'<p>' . $document["price"] . "</p>";
                             echo '<td><button onclick=\'basket.add("' . $document["_id"] . '", "' . $document["title"] . '", 1,' . $document["price"] . ')\'>ADD TO CART</button>';
                            echo '</article>';
                                              }
                        
                        
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