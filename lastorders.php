<!DOCTYPE html>
<html>
    <head>
        <title>GameWorld - My Account</title>
        <link rel="stylesheet" type="text/css" href="new.css" />	
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />

    </head>
    <body>
        <div class="container">
            <div id="tophead">
                <div id="searchBar">
                    <!--search form-->
                    <form action="find.php" method="get">
                        <input type="text" name="search" placeholder="SEARCH...">
                    </form>
                </div>
            </div>

            <header>
                <div id="logoimg">

                    <a href="test.html">
                        <img src="img/logo1.png"/>
                    </a>
                </div>

                <nav>
                    <!--navigation-->
                    <div id="nav">
                        <ul>

                            <li><a href="test.html">HOME</a></li>
                            <!--dropdown menu !-->
                            <li class="dropdown">
                               <a class="dropbtn">SHOP BY CONSOLE</a>
                                <div class="dropdown-content">
                                    <a href="shoptestMongo.php">ALL GAMES</a>
                                    <a href="shoptestMongoXBOX.php">XBOX </a>
                                    <a href="shoptestMongoPlay.php">PLAYSTATION </a>

                                </div>
                            </li>
                            <li><a href="about.html">ABOUT US</a></li>
                            <!--dropdown menu-->
                            <li class="dropdown">
                                <a class="dropbtn">MY ACCOUNT</a>
                                <div class="dropdown-content">
                                   <a href="loginAjax.php">LOGIN </a>
                                    <a href="register.php">REGISTER </a>
                                    <a href="update.php"> UPDATE MY INFO</a>
                                    <a href="lastorders.php"> MY ORDERS</a>
                            </li>
                            <!--google shopping cart icon!-->
                            <a href="cart.html"><i class="material-icons" style="color:white;text-align:right;font-size:26px;">
                                    shopping_cart</i></a>
                        </ul>
                    </div>
                    </div>
                </nav>
            </header>
            <section>
                <div id="section" style="text-align:center;background-color:white;">
      
                <h2 style="margin:0;padding:00;text-align:left;">My Account Info</h2>
                    <h3>Latest Order </h3>
                    
                    <hr style="width:50%;">
                    
                   <?php 
                    
       //DISPLAY LAST ORDER OF LOGGED IN CUSTOMER                      
                   session_start();
    
    //Find out if session exists
        if( array_key_exists("customer_id", $_SESSION) ){
        $customer = $_SESSION['customer_id'];
            
            
                    $mongoClient = new MongoClient();
                    
                        $db = $mongoClient->gameShop;
                               
                    
                        $cust = $db->customers->findOne(['_id' => new MongoId($customer)]);
        
                    
                   // var_dump($cust);
                     echo '<h4> Products ordered: </h4>
                    <hr style="width:20%;">';
                   
                    $totalPrice = 0;
                    
                    if($cust["lastorder"]!=[]){
                    $lastorder = ($cust["lastorder"]);
                    $prods = ($lastorder["products"]);
                    
                    
                    foreach ($prods as $prod){
                  
                      echo '<p>' . $prod["title"] . " " . $prod["price"] . "</p>";
                     $totalPrice += $prod["price"];
                    }
                        }
                    else {
                         echo "<p> No orders placed yet. </p>";
                    }
                    
                    
                    echo '<p> Total price is: '. $totalPrice . "</p>";
                    
                    echo "<br>";
                    
                    echo '<h4> Recommendations: </h4>
                    <hr style="width:20%;">';
                    
                    $custkeys = ($cust["searches"]);
                    
                   $custkeys2 = json_encode($custkeys);
            
            
    }
    else{
        echo 'Please log in to check your details!';
        }
                    
           
                    
                    ?>
                     <div id = "RecomendationDiv"></div>
                    <script>
                        
                    function Recommender(){
                        
                    this.keywords = {};//Holds the keywords
                    this.timeWindow = 10000;//Keywords older than this window will be deleted
                    this.load();
                    }
                        
                    Recommender.prototype.addKeyword = function(word){
    //Increase count of keyword
    if(this.keywords[word] === undefined)
        this.keywords[word] = {count: 1, date: new Date().getTime()};
    else{
        this.keywords[word].count++;
        this.keywords[word].date = new Date().getTime();
    }
    
    console.log(JSON.stringify(this.keywords));
    
    //Save state of recommender
    this.save();
};
                        /* Returns the most popular keyword */
Recommender.prototype.getTopKeyword = function(){
    //Clean up old keywords
    this.deleteOldKeywords();
    
    //Return word with highest count
    var maxCount = 0;
    var maxKeyword = "";
    for(var word in this.keywords){
        if(this.keywords[word].count > maxCount){
            maxCount = this.keywords[word].count;
            maxKeyword = word;
        }
    }
    return maxKeyword;
};


/* Saves state of recommender. Currently this uses local storage, 
    but it could easily be changed to save on the server */
Recommender.prototype.save = function(){
    localStorage.recommenderKeywords = JSON.stringify(this.keywords);
};


/* Loads state of recommender */
Recommender.prototype.load = function(){
    if(localStorage.recommenderKeywords === undefined)
        this.keywords = {};
    else
        this.keywords = JSON.parse(localStorage.recommenderKeywords);
    
    //Clean up keywords by deleting old ones
    this.deleteOldKeywords();
};


//Removes keywords that are older than the time window
Recommender.prototype.deleteOldKeywords = function(){
    var currentTimeMillis = new Date().getTime();
    for(var word in this.keywords){
        if(currentTimeMillis - this.keywords[word].date > this.timeWindow){
            delete this.keywords[word];
        }
    }
};
  var recommender = new Recommender();
            
            //Display recommendation
            window.onload = showRecommendation;
              
            var words = <?php echo $custkeys2 ?>;
            
            console.log(words);
                        
                        words.forEach(function (wor){
                         recommender.addKeyword(wor); 
                         console.log(wor);
                        });
                        
            var keywords = recommender.getTopKeyword();
           
             showRecommendation();
                 
        
                        
             function showRecommendation(){
               
                document.getElementById("RecomendationDiv").innerHTML = recommender.getTopKeyword();
                 
              
            };
            
               
                        
                    
                    </script>
                    
                    <br>
                    
                   
        </div>

    </section>

    <!--Footer -->
    <footer>
        <div id="footer">
            <article>
                <h4>INFORMATION </h4>

                <p>
                    <!--google icon!-->
                    <i class="material-icons" style="color:#4eab04; font-size:16px;
                       padding:0px 3px 0px 3px;">
                        star</i>
                    100% CUSTOMER SATISFACTION!
                </p>
                <p>
                    <!--google icon!-->
                    <i class="material-icons" style="color:#4eab04; font-size:16px;
                       padding:0px 3px 0px 3px;">
                        local_shipping</i>
                    100% FREE DELIVERY!
                </p>
                <p>
                    <!--google icon!-->
                    <i class="material-icons" style="color:#4eab04; font-size:16px;
                       padding:0px 3px 0px 3px;">
                        check_box</i>
                    100% FREE RETURNS!
                </p>
            </article>

            <article>
                <h4>PAYMENTS</h4>
                <img src="img/paypal2.png" style="width:280px;"/>
            </article>

            <article>
                <h4>ABOUT US </h4>
                <p>
                    <!--google icon!-->
                    <i class="material-icons" style="color:#4eab04; font-size:16px;
                       padding:0px 3px 0px 3px;">
                        room</i>
                    Game World , 1234 Example Road,
                    <br>
                    London N4 89GR 
                </p>
                <p>
                    <!--google icon!-->
                    <i class="material-icons" style="color:#4eab04; font-size:16px;
                       padding:0px 3px 0px 3px;">
                        call</i>
                    0208-123-456
                </p>
                <p>
                    <i class="material-icons" style="color:#4eab04; font-size:16px;
                       padding:0px 3px 0px 3px;">
                        email</i>
                    info@gameworld.co.uk
                </p>
            </article>

        </div>
    </footer>
</div>
</body>
</html>