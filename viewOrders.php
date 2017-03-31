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
                <div id="section" style="text-align:center;background-color:white;">
                    <br>
                   
                    <h1 id ="h1">View Orders</h1>
                    
                    <?php
                    echo '<form method="post">';
                       
                        echo 'Order ID: <input type="text" name="id" placeholder="ORDER ID"
                               style="width:70%;">';
                    echo '</form>';
                    //Connect to MongoDB
                    $mongoClient = new MongoClient();

                    //Select a database
                    $db = $mongoClient->gameShop;
                    
                    $orderID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

                    $remCriteria = [
                        "_id" => new MongoId($orderID)
                    ];
                    $orders = $db->orders->findOne($remCriteria);
                    
                    $pro = $orders[1]["products"];
                    
       if($orders!="")   {          
    echo'<p> Order ID: ' . $orders["_id"] . "</p>";
    echo'<p> First Name: ' .$orders[0]['firstname'] . "</p>";
    echo'<p> Last Name: ' .$orders[0]['lastname'] . "</p>";
    echo'<p> Email: ' .$orders[0]['email'] . "</p>";
    echo'<p> Address: ' .$orders[0]['address'] . "</p>";
    echo'<p> City: ' .$orders[0]['city'] . "</p>";
    echo'<p> PostCode: ' .$orders[0]['postcode'] . "</p> ";
    echo'<p> Products ordered: </p>';                
    foreach ($pro as $prod){
        echo '<p>' .$prod['title'] . ", " .$prod['price'] . "</p>";
    }  }                 
                    
                    
                    
                    
                      
                    
                    ?>
                    

                    <br>



    


</div>
        </div>
        
</body>
</html>