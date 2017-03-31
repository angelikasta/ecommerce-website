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
                    <h1 id ="h1">Search For Product To Update</h1>

                    <br>
                    <?php
                    echo '<form method="post">';
                       echo' <input type="text" name="id" placeholder="Product ID"
                               style="width:70%;">';
                    echo '</form>';
                    
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
                    
                    $productsTag = $products['tags'];
                    if($prodID !=""){
                    $tagArr = implode(", ", $productsTag);
                        
                         echo '<div id="form2"><form id="productDetails" name="addform" method = "post" action=""addProduct.php">';
                               echo 'Product Title: <br>
                                <input type ="text" id="title" name="title" value="' . $products['title'] . '" style="width:100%" required><br>';
                                echo 'Description: <br>
                                <input type = "text" id="description" name="description" value="'  . $products['description'] . '" style="width:80%" required><br>';
                                echo 'Year Of Release: <br>
                                <input type ="number" id="year" name="year" value="'  . $products['year'] . '" style="width:40%" required><br>';
                                echo 'Price: <br>
                                <input type = "currency" id="price" name="price" value="'  . $products['price'] . '" style="width:50%" required><br>';
                                
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
                                <input type = "text" id="tags"  name="tags[]" value="'  . $tagArr . '"style="width:80%" required><br>';
                                echo 'Console: 
                                <br>
                                <select id="console"
                                     name="console" value="'  . $products['console'] . '"style="width:80%">
                                    <option value="XBOX">Xbox</option>
                                    <option value="PS4">PlayStation</option>
                                </select><br>';
                                echo 'Quantity: <br>
                                <input type ="number" id="quantity" name = "quantity" value="'  . $products['quantity'] . '" style="width:40%" required><br>';
                                echo 'Image URL: <br>
                                <input type ="text" id="image_url" name="image_url" value="'  . $products['image_url'] . '"style="width:80%" required><br>';
                                echo '<input type="submit" value="UPDATE PRODUCT">';
                    }
                    
                   


                        ?>
                </div>

        

    </section>


</body>
</html>