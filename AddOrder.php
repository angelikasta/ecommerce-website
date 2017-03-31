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
                    <h1 id ="h1">Update Order</h1>
                    <hr>
                    <br>       
<?php
                    
     //connect to database
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->gameShop;
$collection = $db->products;
                    
 //extact the data that was sent to the server
$firstname= filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname= filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$address= filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$city= filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);                             
$postcode= filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING);
$email= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);                 
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
 
//keep customer order the same
$remCriteria = [
                        "_id" => new MongoId($id)
                    ];
                    
                    $orders = $db->orders->findOne($remCriteria);
$pro = $orders[1]["products"];

                    
                    
                    
$customerData = [
    "firstname" => $firstname,
    "lastname" => $lastname,
    "email" => $email,
    "address" => $address,
    "city" => $city,
    "postcode" => $postcode,
    "products" => $pro,
    "_id" => new MongoId($id)
];
                    
//Save the product in the database - it will overwrite the data for the product with this ID
$returnVal = $db->orders->update(array("_id" => new MongoId($id)), $customerData);
   


  
                    if ($returnVal['ok']==1){
                       echo "<p>Order has been updated successfully</p>";
                        
                    }
                    else {
                        echo "<p>Error saving the updated order.</p>";
                    }
                    
//Close the connection
$mongoClient->close();
                    
                    ?>                    
                </div>
            </section>
        </div>
    </body>
</html>
