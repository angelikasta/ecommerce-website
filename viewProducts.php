<!DOCTYPE html>
<html>
    <head>
        <title>CMS Added Product</title>
        <link rel="stylesheet" type="text/css" href="new.css" />	
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    </head>"
    <body style="background-color:white">
        <div class="container">


            <header>
                <div id="logoimg">


                    <img src="img/logo1.png"/>

                </div>
                <!--navigation-->
                <nav>
                    <div id="nav">
                        <br>
                        <ul>
                            <!--staff login page !-->
                            <li><a href="cmsindex.html">STAFF LOGIN</a></li>
                            <!--dropdown menu  !-->
                            <li class="dropdown">
                                <a class="dropbtn" >PRODUCTS</a>
                                <div class="dropdown-content">
                                    <a href="viewProducts.php">VIEW ALL PRODUCTS</a>
                                    <a href="deleteProducts.php">DELETE PRODUCTS</a>
                                    <a href="addProduct.html">ADD PRODUCTS</a>
                                    <a href="editProducts.php">EDIT PRODUCTS</a>


                                </div>
                            </li>
                            <li><a href="viewOrders.php">VIEW ORDERS</a></li>


                        </ul>
                    </div>
                </nav>
            </header>
            <section>
                <div id="section" style="text-align:center;background-color:white;">
                
                    <br>       
<?php

//connect to database
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->gameShop;
$collection = $db->products;

 $products = $db->products->find();
                    echo '<h3> All Products </h3><hr>';
                    
                    foreach ($products as $product){
                    echo '<article class="article">';
                            echo '<img src='  . $product["image_url"] . ">";
                            echo'<p>' . $product["title"] . "</p>";
                            echo'<p>' . $product["_id"] . "</p>";
                            echo'<p>' . $product["year"] . "</p>";
                            echo'<p>' . $product["price"] . "</p>";
                            echo'<p>' . $product["console"] . "</p>";
                            
                            echo '</article>';
                    }

                

//close the connection
$mongoClient->close();
?>
                </div>
            </section>
        </div>
    </body>
</html>