<?php

//Start session management
session_start();

//Connect to MongoDB and select database
$mongoClient = new MongoClient();
$db = $mongoClient->gameShop;

//Create a basket document if we do not have one
if( !array_key_exists("order_id", $_SESSION) ){
    //Add an empty basket 
    $dataArray = ["products" => []];
    $returnVal = $db->orders->insert($dataArray);

    //Check result 
    if($returnVal['ok'] != 1){
        throw new Exception("Error adding empty order to MongoDB");
    }

    //Store basket ID in session key
    $_SESSION['order_id'] = (string)$dataArray['_id'];
}
//Request for basket
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    //Find basket with specified ID
    $findCriteria["_id"] = new MongoId($_SESSION['order_id']);
    $basketCursor = $db->orders->find($findCriteria);

    //Check that we have found exactly one basket
    $numResults = $orderCursor->count();//Number of products in database 
    if($numResults == 0){
        throw new Exception("Order not found");
    }

    //Get basket from basket cursor
    $order = $orderCursor->next();

    //Return product in JSON format
    echo json_encode($order);//Convert PHP representation of product into JSON 
}
//Modified basket has been sent to server
else if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //Get JSON document containing basket from POST
    $orderJSON = $_POST['json'];

    //Convert JSON string to PHP  array. 'true' converts to array instead of PHP object.
    $orderPHPArray = json_decode($orderJSON, true);

    //Add ID field to basket array
    $orderPHPArray['_id'] = new MongoId($_SESSION['order_id']);
    
    $returnVal = $db->orders->save($orderPHPArray);
    if($returnVal['ok'] != 1){
        throw new Exception("Error updating MongoDB order.");
    }

    //Basket updated successfully
    echo 'ok';
}
else{
    throw new Exception("Request method not recognized.");
}

//Close connection to server
$mongoClient->close();