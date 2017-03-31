//Constructor for basket object
function Basket(serverBasketPage){
    //Page that interfaces with MongoDB basket
    this.serverBasketPage = serverBasketPage;

    //Holds local copy of basket information
    this.productArray = [];
}


//Adds product to basket
Basket.prototype.add = function(productID, productTitle, quantity, price){
    
    this.productArray.push({title: productTitle, id: productID, quantity: quantity, price: price});
    this.send();
    this.loadBasket();
    
};



//Removes product from basket
Basket.prototype.remove = function(index){
    this.productArray.splice(index, 1);
    this.send(); 
    this.loadBasket();
};


//Sends modified basket to server
Basket.prototype.send = function(){
    //Create request object 
    var request = new XMLHttpRequest();

    //Create event handler that specifies what should happen when server responds
    request.onload = function(){
        if(request.status === 200){//Check HTTP status code
            //Check response
           if(request.responseText !== 'ok')
               alert("Error sending basket to server: " + request.responseText);
        }
        else
            alert("Error communicating with server: " + request.status);
    };

    //Set up request with HTTP method and URL 
    request.open("POST", this.serverBasketPage);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //Send request
    request.send("json=" + JSON.stringify({products: this.productArray}));
};


//Gets basket from server
Basket.prototype.get = function(){
    //Create request object 
    var request = new XMLHttpRequest();
    
    //Need a reference to the basket class so that we can access it from inner function
    var caller = this;

    //Create event handler that specifies what should happen when server responds
    request.onload = function(){
        if(request.status === 200){//Check HTTP status code
            
            //Get data from server
            var basketJSON = request.responseText;
            
            //Store most accurate version of basket
            caller.productArray = JSON.parse(basketJSON)['products'];

            //Add data to page
            caller.loadBasket();
        }
        else
            alert("Error communicating with server: " + request.status);
    };

    //Set up and send request 
    request.open("GET", this.serverBasketPage);
    request.send();
};


//Loads basket from productArray variable 
Basket.prototype.loadBasket = function(){

    //Build HTML string
    var totalPrice = 0;
    
    var htmlStr = "<form action='checkout.php' method='post'><table><tr><th>Item</th><th>Quantity</th> <th>Price</th><th>Remove</th></tr>";
    
    for(var i=0; i<this.productArray.length; ++i){
        htmlStr += '<tr><th>'+ this.productArray[i].title + " </th><th>" + this.productArray[i].quantity + "</th><th>" + this.productArray[i].price + "</th>";
        htmlStr += "<th> <button onclick='basket.remove(" + i + ")'>Remove</button> </th></tr>";
        totalPrice += this.productArray[i].price;
    }
    
    
    
        htmlStr += "<tr><th></th><th>Total price</th><th style='width:50%;'>" + Math.round(totalPrice * 100) / 100 + "</th><th></th></tr>";
        htmlStr += "<tr><th></th><th>Total quantity</th><th style='width:50%;'>" + this.productArray.length + "</th><th></th></tr>";
        htmlStr +=  "<tr><th style='width:50%'></th><th></th><th style='width:50%; text-align:right;'><input type='submit' value='Buy It Now'></th></tr>";
        htmlStr += "</table></form>";
        
    
    
    //Add HTML to page
    document.getElementById("BasketDiv").innerHTML = htmlStr;
    

};
