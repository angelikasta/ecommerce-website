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
                            <li><a href="viewOrders.html">VIEW ORDERS</a></li>

                            <li><a href="viewCustomers.html">VIEW CUSTOMERS</a></li>


                        </ul>
                    
                    </div>
                </nav>
            </header>
                <div id="section" style="text-align:center;background-color:white;">
                    <br>

<?php
//Connect to MongoDB
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->gameShop;

//Extract the data that was sent to the server
$search_string = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);

$search_string2 = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
//Create a PHP array with our search criteria
$findCriteria = [
    '$text' => [ '$search' => $search_string ] 
 ];
                 
$findCriteria2 = [
  "_id" => new MongoID($search_string2) 
 ];
                    
//Find all of the customers that match  this criteria
if($search_string!=""){
$cursor = $db->customers->find($findCriteria);
} if ($search_string2!=""){
    $cursor = $db->customers->find($findCriteria2);
}
//Output the results as forms
echo "<h1>Customers</h1>";   
foreach ($cursor as $cust){
    echo '<form action="save_customer.php" method="post">';
    echo 'Name: <input type="text" name="firstname" value="' . $cust['firstname'] . '" required><br>';
    echo 'Email: <input type="email" name="email" value="' . $cust['email'] . '" required><br>';
    echo 'Password: <input type="password" name="password" value="' . $cust['password'] . '" required><br>'; 
    echo '<input type="hidden" name="id" value="' . $cust['_id'] . '" required>'; 
    echo '<input type="submit">';
    echo '</form><br>';
}

//Close the connection
$mongoClient->close();
                    
                    ?>
            </div>
        </div>
    </body>
</html>


 