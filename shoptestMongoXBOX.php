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
                                </div>
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
                        <h2>XBOX GAMES</h2>
                        <hr>
                        
                        <!-- form to allow sorting -->
                        <form method="post">

                            <select name="sorting" style="width:20%; display:inline;padding:1;">
                                <option value="hightolow">Price High to Low</option>
                                <option value="lowtohigh">Price Low to High</option>
                                <option value="az">Title A-Z</option>
                                <option value="za">Title Z-A</option>
                            </select>
                            <input type="submit" value="SORT" style="width:7%; padding:0;">
                        </form>

                        <?php
                        
                        //connect to mongo
                        $mongoClient = new MongoClient();
                        
                        //connect to the database
                        $db = $mongoClient->gameShop;
                        
                        //find all products
                        $products = $db->products->find();
                        
                        //default sort high to low price
                        $products = $products->sort(array("price" => -1));
                        
                        //extract which sorting is chosen
                        $sorting = filter_input(INPUT_POST, 'sorting', FILTER_SANITIZE_STRING);
                        
                        
                        //sort the result based on option chosen
                        if ($sorting == "lowtohigh") {

                            $products = $products->sort(array("price" => 1));
                            echo"Results sorted by price: low to high<hr>";
                        }

                        if ($sorting == "hightolow") {

                            $products = $products->sort(array("price" => -1));
                            echo"Results sorted by price: high to low<hr>";
                        }
                        if ($sorting == "az") {

                            $products = $products->sort(array("title" => 1));
                            echo"Results sorted by title: A-Z<hr>";
                        }
                        if ($sorting == "za") {

                            $products = $products->sort(array("title" => -1));
                            echo"Results sorted by title: Z-A<hr>";
                        }

                        //display all items matching the criteria
                        foreach ($products as $document) {
                            if ($document["console"] == "XBOX") {
                                if ($document["quantity"] >= 1) {
                                    //check if the item is in stock and display all
                                    
                                    echo '<article class="article">';
                                    echo '<img src=' . $document["image_url"] . ">";
                                    echo'<p>' . $document["title"] . "</p>";
                                    echo'<p>' . $document["price"] . "</p>";
                                    echo '<td><button onclick=\'basket.add("' . $document["_id"] . '", "' . $document["title"] . '", 1,' . $document["price"] . ')\'>ADD TO CART</button>';
                                    echo '</article>';
                                    
                                } else {
                                    
                                    //display items currently out of stock
                                    echo '<article class="article">';
                                    echo '<img src=' . $document["image_url"] . ">";
                                    echo'<p>' . $document["title"] . "</p>";
                                    echo'<p>' . $document["price"] . "</p>";
                                    //change the appearance of the button for items out of stock
                                    echo '<td><button style="background:black; border:black;">OUT OF STOCK</button>';
                                    echo '</article>';
                                }
                            }
                        }

                        $mongoClient->close();
                        ?>


                    </div>
                    <!--basket functionality -->
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