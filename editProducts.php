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
                    <h1 id ="h1">Search For Product To Update</h1>

                    <br>
                    <?php
                    
                    //form to search for the product
                    echo '<form method="post">';
                    echo' <input type="text" name="id" placeholder="Product ID"
                               style="width:70%;">';
                    echo '</form>';

                    //Connect to MongoDB
                    $mongoClient = new MongoClient();

                    //Select a database
                    $db = $mongoClient->gameShop;
                    
                    //ensure staff member is logged in
                    session_start();
                    
                    if (array_key_exists("staff_id", $_SESSION)) {
                        
                        $staff = $_SESSION['staff_id'];

                        //Extract ID from POST data
                        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

                        //Build PHP array with the criteria 
                        $remCriteria = [
                            "_id" => new MongoId($id)
                        ];
                        
                        
                        //find the product with the id
                        $products = $db->products->findOne($remCriteria);

                        //if produduct is found assing tags array and seperate each element by a coma
                        if ($products != "") {
                            $productsTag = $products['tags'];
                            $tagArr = implode(", ", $productsTag);

                            
                            //display a form to update the product
                            echo '<div id="form2"><form id="productDetails" name="addform" method = "post" action="updateProduct.php"';
                            echo 'Product Title: <br>
                                <input type ="text" id="title" name="title" value="' . $products['title'] . '" style="width:100%" required><br>';
                            echo 'Description: <br>
                                <input type = "text" id="description" name="description" value="' . $products['description'] . '" style="width:80%" required><br>';
                            echo 'Year Of Release: <br>
                                <input type ="number" id="year" name="year" value="' . $products['year'] . '" style="width:40%" required><br>';
                            echo 'Price: <br>
                                <input type = "currency" id="price" name="price" value="' . $products['price'] . '" style="width:50%" required><br>';

                            echo 'Categories: <br>
                                <input type ="checkbox" id="strategy" 
                                name = "category[]" value="strategy"
                                style="width:40%" >';
                            echo 'Strategy games
                                <br>
                                <input type ="checkbox" id="action" name = "category[]"  value="action"
                                style="width:40%" >';
                            echo 'Action games
                                <br>
                                <input type ="checkbox" id="rpg" name = "category[]" value="rpg" style="width:40%" >';
                            echo 'RPG
                                <br>
                                <input type ="checkbox" id="fighting" name = "category[]" value="fighting" style="width:40%" >';
                            echo 'Fighting games
                                <br>
                                <input type ="checkbox" id="driving" name = "category[]" value="driving" style="width:40%" >';
                            echo 'Driving games
                                <br>
                                <input type ="checkbox" id="shooter" name = "category[]" 
                                value = "shooter" style="width:40%" >';
                            echo 'Shooter games
                                <br>
                                <input type ="checkbox" id="children" name = "category[]" value="children" style="width:40%" >';
                            echo 'Childrens games
                                <br>
                                <input type ="checkbox" id="sport" name = "category[]" value="children" style="width:40%" >';
                            echo 'Sport games
                                <br>';

                            echo 'Tags: <br>
                                <input type = "text" id="tags"  name="tags[]" value="' . $tagArr . '"style="width:80%" required><br>';
                            echo 'Console: 
                                <br>
                                <select id="console"
                                     name="console" value="' . $products['console'] . '"style="width:80%">
                                    <option value="XBOX">Xbox</option>
                                    <option value="Playstation">PlayStation</option>
                                </select><br>';
                            echo 'Quantity: <br>
                                <input type ="number" id="quantity" name = "quantity" value="' . $products['quantity'] . '" style="width:40%" required><br>';
                            echo 'Image URL: <br>
                                <input type ="text" id="image_url" name="image_url" value="' . $products['image_url'] . '"style="width:80%" required><br>';
                            echo '<input type="hidden" name="id" value="' . $products['_id'] . '">';
                            echo '<input type="submit" value="UPDATE PRODUCT"></form><br></div>';
                        }

                        //display all products and their id
                        $products = $db->products->find();
                        echo '<h3> All Products </h3>';
                        foreach ($products as $product) {
                            echo '<article class="article">';
                            echo '<img src=' . $product["image_url"] . ">";
                            echo'<p>' . $product["title"] . "</p>";
                            echo'<p>' . $product["_id"] . "</p>";
                            echo '</article>';
                        }
                    } 
                    //display a msg to log in for staff
                    else {
                        echo '<h2>Please log in first </h2>';
                    }
                    
                    
                ?>
            </div>

        </section>
    </div>

</body>
</html>