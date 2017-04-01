<!DOCTYPE html>
<html>
    <head>
        <title>CMS Added Product</title>
        <link rel="stylesheet" type="text/css" href="new.css" />	
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    </head>
    <body>
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
            <section>
                <div id="section" style="text-align:center;background-color:white;">
                    <br>
                    <h1 id ="h1">Add Product</h1>
                    <hr>
                    <br>       
                    <?php
                    
                    //connect to database
                    $mongoClient = new MongoClient();

                    //Select a database
                    $db = $mongoClient->gameShop;
                    $collection = $db->products;

                    session_start();
                    
                    //check if staff member is signed in
                    if (array_key_exists("staff_id", $_SESSION)) {
                        $staff = $_SESSION['staff_id'];

                        //extact the data that was sent to the server
                        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);

                        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
                        
                        //change to integer
                        $year = intval(filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT));

                        //change to float
                        $price = floatval(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT));

                        $console = filter_input(INPUT_POST, 'console', FILTER_SANITIZE_STRING);

                        //change to integer
                        $quantity = intval(filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT));

                        $image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_STRING);




                        //convert to PHP array
                        $dataArray = [
                            "title" => $title,
                            "description" => $description,
                            "year" => $year,
                            "price" => $price,
                            "category" => ($_POST['category']),
                            "tags" => ($_POST['tags']),
                            "console" => $console,
                            "quantity" => $quantity,
                            "image_url" => $image_url
                        ];

                        //Addthe new product to the database
                        $returnVal = $collection->insert($dataArray);

                        //Echo resultback to user
                        if ($returnVal['ok'] == 1) {
                            echo 'Product added successfully!';
                        } else {
                            echo 'Error adding customer';
                        }
                    } else {
                        //display a msg to staff member to log in
                        echo '<h2>Please log in first </h2>';
                    }

                    //close the connection
                    $mongoClient->close();
                    
                    ?>
                </div>
            </section>
        </div>
    </body>
</html>