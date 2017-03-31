<!DOCTYPE html>

<html>
    <head>
        <title>GameWorld - Shop </title>

        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />

    </head>
    <body>


<?php

//Start session management
session_start();

//Connect to MongoDB and select database
$mongoClient = new MongoClient();
$db = $mongoClient->newData;


        
$upd = $db->d->update(
  array("price" => 9.99),
    array('$inc' => array("quantity" => -1)),
    array("upsert" => true)
);

$stuff = $db->d->find();

foreach ($stuff as $document){
   
                            echo'<p>' . $document["title"] . "</p>";
                            echo'<p>' . $document["price"] . "</p>";
                            echo'<p>' . $document["console"] . "</p>";
                            echo'<p>' . $document["quantity"] . "</p>";
                             echo '<td><button onclick=\'basket.add("' . $document["_id"] . '", "' . $document["title"] . '", 1,' . $document["price"] . ')\'>ADD TO CART</button>';
                        
};
$mongoClient->close();
?>
    </body>
</html>
