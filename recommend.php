    <!DOCTYPE html>
<html>
    <head>
        <title>GameWorld - Shop </title>
        <link rel="stylesheet" type="text/css" href="new.css" />
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
        <script src="basket.js"></script>
        <script src="recommender.js"></script>
    </head>
    <body>
        <div class="container" style="background-color:white">
            <div id="tophead">
                <!--search bar form-->
                <div id="searchBar">
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
                            <!--google shop cart icon!-->
                            <a href="cart.html"><i class="material-icons" style="color:white;text-align:right;font-size:26px;">
                                    shopping_cart</i></a>

                        </ul>

                    </div>
                </nav>

            </header>

            <section>
                <!--change default section colour to white !-->
                <div id="section" style="background-color:white">

                    <div id="shopSection">
        <h2>Search for Products</h2>
        <div>
            <input type="text" id="SearchInput">
            <button onclick="search()">Search</button>
        </div>
        
        <h2>Recommendations</h2>
        <div id="RecomendationDiv"></div>
        <script>
            //Create recommender object - it loads its state from local storage
            var recommender = new Recommender();
            
            //Display recommendation
            window.onload = showRecommendation;
            
            //Searches for products in database
                
                //#FIXME# PERFORM SEARCH FOR PRODUCTS
            
            
            //Display the recommendation in the document
            function showRecommendation(){
                document.getElementById("RecomendationDiv").innerHTML = recommender.getTopKeyword();
            }
        </script>
        

    </body>
</html>
