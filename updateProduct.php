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
                    
                    //Connect to MongoDB
                    $mongoClient = new MongoClient();

                    //Select a database
                    $db = $mongoClient->gameShop;

                    session_start();
                    
                    //check if staff member is logged in
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

                        //if product is found extract strings from tags and sepereate by comas
                        if ($products != "") {
                            $productsTag = $products['tags'];
                            $tagArr = implode(", ", $productsTag);
                        }

                        //extact the data that was sent to the server
                        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);

                        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
                        
                        //change to int
                        $year = intval(filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT));

                        //change to int
                        $price = intval(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING));

                        $console = filter_input(INPUT_POST, 'console', FILTER_SANITIZE_STRING);

                        //change to int
                        $quantity = intval(filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT));

                        $image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_STRING);

                        $category = $_POST['category'];
                        $tags = $_POST['tags'];


                        //convert to PHP array
                        if ($id != "") {
                            $dataArray = [
                                "title" => $title,
                                "description" => $description,
                                "year" => $year,
                                "price" => $price,
                                "category" => $category,
                                "tags" => $tags,
                                "console" => $console,
                                "quantity" => $quantity,
                                "image_url" => $image_url,
                                "_id" => new MongoId($id)
                            ];

                            $collection = $db->products;

                            //Add the the product to the database
                            $returnVal = $db->products->update(array("_id" => new MongoId($id)), $dataArray);

                            //Echo resultback to user
                            if ($returnVal['ok'] == 1) {
                                echo '<hr>Product updated successfully!';
                            } else {
                                echo '<hr>Error updating products';
                            }
                        }
                    } else {
                        //display msg to log in for staff
                        echo '<h2>Please log in first </h2>';
                    }
                    
                    $mongoClient->close();
                    
                    ?>
                </div>

            </section>
        </div>

    </body>
</html>