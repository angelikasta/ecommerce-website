<!DOCTYPE html>
<html>
    <head>
        <title>CMS Edit Orders</title>
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
                            </li>

                        </ul>
                    </div>

                </nav>
            </header>
            <section>
                <div id="section" style="text-align:center;background-color:white;">
                    <br>
                    <h1 id ="h1">Search For Order To Update</h1>

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

                        //display the search form
                        echo '<form method="post">';
                        echo' <input type="text" name="id" placeholder="Order ID"
                               style="width:70%;">';
                        echo '</form>';


                        //Extract ID from POST data
                        $orderID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

                        //Build PHP array with criteria 
                        $remCriteria = [
                            "_id" => new MongoId($orderID)
                        ];
                        
                        //find the order
                        $orders = $db->orders->findOne($remCriteria);

                        $pro = $orders[1]["products"];

                        //display the form to update the order
                        echo '<div id="form2"><form id="orderDetails" name="addform" method = "post" action="addOrder.php">';

                        echo 'Customer name: <br>
                                <input type ="text" name="firstname" value="' . $orders[0]['firstname'] . '" style="width:100%" required><br>';
                        echo 'Customer Surname: <br>
                                <input type ="text"  name="lastname" value="' . $orders[0]['lastname'] . '" style="width:100%" required><br>';
                        echo 'Customer Address: <br>
                                <input type ="text"  name="address" value="' . $orders[0]['address'] . '" style="width:100%" required><br>';
                        echo 'City: <br>
                                <input type ="text"  name="city" value="' . $orders[0]['city'] . '" style="width:100%" required><br>';
                        echo 'Post Code: <br>
                                <input type ="text"  name="postcode" value="' . $orders[0]['postcode'] . '" style="width:100%" required><br>';
                        echo 'Email: <br>
                                <input type ="text"  name="email" value="' . $orders[0]['email'] . '" style="width:100%" required><br>';
                        echo '<input type="hidden" name="id" value="' . $orders['_id'] . '" required>';
                        
                         echo 'Shipment: <br>
                                <select id="shipment" name="shipment" value="' . $orders[2]['shipment'] . '"style="width:80%">
                                    <option value="no">no</option>
                                    <option value="yes">yes</option>
                                </select><br>';
                            echo '<input type="submit" value="UPDATE ORDER"></form><br>';
                        
                        echo "<br>";

                        if ($pro != "") {
                            foreach ($pro as $prod) {
                                echo '<input type ="hidden"  name="title" value="' . $prod['title'] . '" style="width:100%" required><br>';
                                echo ' <input type ="hidden"  name="price" value="' . $prod['price'] . '" style="width:100%" required><br>';
                            }
                           
                    }
                    }
                    else {
                        echo '<h2> Please log in first </h2>';
                    }
                    ?>
                    
                </div>
            </section>
        </div>
    </body>
</html>
