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
                    <h1 id ="h1">Search For Order To Update</h1>

                    <br>
                    <?php
                    echo '<form method="post">';
                       echo' <input type="text" name="id" placeholder="Order ID"
                               style="width:70%;">';
                    echo '</form>';
                    
                    //Connect to MongoDB
                    $mongoClient = new MongoClient();

                    //Select a database
                    $db = $mongoClient->gameShop;
                    
                    //Extract ID from POST data
                    $orderID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
                    
                    //Build PHP array with remove criteria 
                    $remCriteria = [
                        "_id" => new MongoId($orderID)
                    ];
                    
                    $orders = $db->orders->findOne($remCriteria);
                    
                    $pro = $orders[1]["products"];
                    
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
                    
                    if ($pro!=""){
                        foreach ($pro as $prod){
                                echo '<input type ="hidden"  name="title" value="' .$prod['title'] . '" style="width:100%" required><br>';
                                echo ' <input type ="hidden"  name="price" value="' .$prod['price'] . '" style="width:100%" required><br>';
                                
                        }
                        echo '<input type="submit" value="UPDATE ORDER"></form><br>';
                    }
                         echo "<br>";       
                    
                    
                    
                    ?>
                </div>
            </section>
        </div>
    </body>
</html>
