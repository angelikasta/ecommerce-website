<!DOCTYPE html>
<html>
    <head>
        <title> CMS Delete Products</title>
        <link rel="stylesheet" type="text/css" href="new.css" />
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    </head>
    <body style="background-color:white;"> 
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
                            </li>

                        </ul>

                    </div>
                </nav>
            </header>
            <div id="section" style="text-align:center;background-color:white;">
                <br>

                <h1 id ="h1">Delete Product</h1>

                <br>

          
                <?php
                //Connect to MongoDB
                $mongoClient = new MongoClient();

                //Select a database
                $db = $mongoClient->gameShop;
                
                //ensure staff member is logged in
                session_start();
                if (array_key_exists("staff_id", $_SESSION)) {
                    $staff = $_SESSION['staff_id'];



                    //Extract ID from POST data
                    $prodID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

                    //Build PHP array with remove criteria 
                    $remCriteria = [
                        "_id" => new MongoId($prodID)
                    ];
                    
                    //find product with this id
                    $products = $db->products->findOne($remCriteria);

                    //Delete the product document
                    $returnVal = $db->products->remove($remCriteria);
                    
                    //delete the product form
                    echo '<form method="post">';

                    echo 'Product ID: <input type="text" name="id" placeholder="DELETE PRODUCTS..." style="width:70%;">';
                    echo '</form>';
                    
                    //if product is found display it and echo the result to the user
                    if ($prodID != "") {

                        echo '<img style="width:200px;height:200px;" src=' . $products["image_url"] . ">";
                        echo'<p>' . $products["title"] . "</p>";
                        echo'<p>' . $products["price"] . "</p>";
                        echo '<br>';
                        echo '<h3> Ok, ' . $returnVal['n'] . ' documents deleted.</h3>';
                    }
                    //show the form to search for the product
                    if ($prodID == "") {
                        echo 'Input ProductID and press enter to delete the product';
                    } else {
                        
                        echo 'Error deleting product';
                    }
                    
                    //display all products
                    $products = $db->products->find();
                    echo '<h3> All Products </h3>';
                    foreach ($products as $product) {
                        echo '<article class="article">';
                        echo '<img src=' . $product["image_url"] . ">";
                        echo'<p>' . $product["title"] . "</p>";
                        echo'<p>' . $product["_id"] . "</p>";
                        echo '</article>';
                    }
                } else {
                    //display msg for staff member to log in
                    echo '<h2> Please log in first </h2>';
                }

                //Close the connection
                $mongoClient->close();
                ?>

            </div>
        </div>

    </body>
</html>