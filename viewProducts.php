<!DOCTYPE html>
<html>
    <head>
        <title>CMS View Product</title>
        <link rel="stylesheet" type="text/css" href="new.css" />	
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
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
                            <li><a href="cmslogin.php">STAFF LOGIN</a></li>
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
                            <li class="dropdown">
                                <a class="dropbtn" >ORDERS</a>
                                <div class="dropdown-content">
                                    <a href="viewOrders.php">VIEW ORDERS</a>
                                    <a href="editOrders.php">EDIT ORDERS</a>
                                    <a href="deleteOrders.php">DELETE ORDERS</a>

                                </div>
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
                    
                    //ensure the staff member is logged in
                    session_start();
                    if (array_key_exists("staff_id", $_SESSION)) {
                        $staff = $_SESSION['staff_id'];

                        //find all products
                        $products = $db->products->find();
                        echo '<h3> All Products </h3><hr>';
                        
                        //display all products
                        foreach ($products as $product) {
                            echo '<article class="article">';
                            echo '<img src=' . $product["image_url"] . ">";
                            echo'<p>' . $product["title"] . "</p>";
                            echo'<p>' . $product["_id"] . "</p>";
                            echo'<p>' . $product["year"] . "</p>";
                            echo'<p>' . $product["price"] . "</p>";
                            echo'<p>' . $product["console"] . "</p>";

                            echo '</article>';
                        }
                    } else {
                        //display msg to staff member to log in
                        echo '<h2> Please log in first <h2>';
                    }


                    //close the connection
                    $mongoClient->close();
                ?>
                    
                </div>
            </section>
        </div>
    </body>
</html>