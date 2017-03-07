<!DOCTYPE html>
<html>
    <head>
        <title>GameWorld - Cart</title>
        <link rel="stylesheet" type="text/css" href="new.css" />	
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
        <script src="basket.js"></script>

    </head>
    <body>
        <div class="container">
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
                    <!--navigation-->
                    <div id="nav">
                        <ul>

                            <li><a href="test.html">HOME</a></li>
                            <!--dropdown menu  !-->
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
                                    <a href="login.html">LOGIN </a>
                                    <a href="register.html">REGISTER </a>
                                    <a href="myinfo.html">MY INFO</a>
                            </li>
                            <!--google shopping cart icon !-->
                            <a href="cart.html"><i class="material-icons" style="color:white;text-align:right;font-size:26px;">
                                    shopping_cart</i></a>


                        </ul>
                    </div>
                    </div>
                </nav>
            </header>
            <section>
                <!--change default setting of text align to center !-->
                <div id="section" style="text-align:center;background-color:white">
            <h2 style="margin:0;padding:00;text-align:left;">Checkout</h2>
                  
                            
               
                        
                        
                    </div>
                </div>
                </div>
            </section>

            <!--footer-->
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
                            <!--google icon!-->
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