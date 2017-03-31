<!DOCTYPE html>
<html>
    <head>
        <title>CMS Edit Products</title>
        <link rel="stylesheet" type="text/css" href="new.css" />	
        <!--google icons  !-->
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
                            <li><a href="cmsindex.html">STAFF LOGIN</a></li>
                            <!--dropdown menu  !-->
                            <li class="dropdown">
                                <a class="dropbtn">PRODUCTS</a>
                                <div class="dropdown-content">
                                    <a href="deleteProducts.php">DELETE PRODUCTS</a>
                                    <a href="addProduct.html">ADD PRODUCTS</a>
                                    <a href="editProducts.php">EDIT PRODUCTS</a>


                                </div>
                            </li>
                            <li><a href="viewOrders.html">VIEW ORDERS</a></li>

                            <li><a href="viewCustomers.html">VIEW CUSTOMERS</a></li>


                        </ul>
                    </div>
                
                </nav>
            </header>
            <section>
                <div id="section" style="text-align:center;background-color:white;">
                    <br>
                    <h1 id ="h1">Search For Product To Delete</h1>

                    <br>
                    <?php
                    echo '<form method="post">';
                       echo' <input type="text" name="id" placeholder="Product ID"
                               style="width:70%;">';
                    
                    //Connect to MongoDB
                    $mongoClient = new MongoClient();

                    //Select a database
                    $db = $mongoClient->gameShop;
                    
                    //Extract ID from POST data
                    $prodID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
                    
                    //Build PHP array with remove criteria 
                    $remCriteria = [
                        "_id" => new MongoId($prodID)
                    ];
                    
                    $products = $db->products->findOne($remCriteria);
                    
                    echo '<img style="width:200px;height:200px;"src='  . $products["image_url"] . ">";
                    echo'<p>' . $products["title"] . "</p>";
                    
                    
                    echo '<input type="submit" value="CLICK TO DELETE PRODUCT"></form>';
                    
                    
                   


                        ?>
                </div>

        

    </section>

        </div>
</body>
</html>