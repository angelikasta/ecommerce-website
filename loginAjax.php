<!DOCTYPE html>
<html>
    <head>
        <title>GameWorld - Login</title>
        <link rel="stylesheet" type="text/css" href="new.css" />
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />

    </head>
    <body>
        <div class="container">
            <div id="tophead">
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
                                </div>
                            </li>
                            <!--google shop cart icon!-->
                            <a href="cart.html"><i class="material-icons" style="color:white;text-align:right;font-size:26px;">
                                    shopping_cart</i></a>

                        </ul>
                    
                    </div>
                </nav>
            </header>
            <section>
                <!--change default setting for text align to center !-->
                <div id="section" style="text-align:center;background-color:white;">
                    <br>
                    <h1 id ="h1">Login</h1>
                    <hr style="width:50%;">
                    <br>
                    
                    <!--login form!-->
                    <div id="form2" style="width:50%">
                        <p id="LoginPara">

                            Email: <input type="text" id="email">
                            Password: <input type="password" id="password">
                            <button onclick="login()">Submit</button>
                        </p>
                        
                        <!--display error msgs as appriopriate-->
                        <p style="color:white" id="ErrorMessages"></p>
                    </div>
                    <script>
                        
                        //Global variables 
                        var loggedInStr = "<p> Customer Logged In </p> <button onclick='logout()'>Logout</button>";
                        
                        var loginStr = document.getElementById("LoginPara").innerHTML;
                        var request = new XMLHttpRequest();

                        //Check login when page loads
                        window.onload = checkLogin;

                        //Checks whether user is logged in.
                        function checkLogin() {
                            
                            //Create event handler that specifies what should happen when server responds
                            request.onload = function () {
                                if (request.responseText === "Customer Logged In") {
                                    document.getElementById("LoginPara").innerHTML = loggedInStr;
                                } else {
                                    console.log(request.responseText);
                                    document.getElementById("LoginPara").innerHTML = loginStr;
                                }
                            };
                            //Set up and send request
                            request.open("GET", "check_login.php");
                            request.send();
                        }

                        //Attempts to log in user to server
                        function login() {
                            //Create event handler that specifies what should happen when server responds
                            request.onload = function () {
                                //Check HTTP status code
                                if (request.status === 200) {
                                    //Get data from server
                                    var responseData = request.responseText;

                                    //Add data to page
                                    if (responseData === "ok") {
                                        document.getElementById("LoginPara").innerHTML = loggedInStr;
                                        document.getElementById("ErrorMessages").innerHTML = "";//Clear error messages
                                    } else
                                        document.getElementById("ErrorMessages").innerHTML = request.responseText;
                                } else
                                    document.getElementById("ErrorMessages").innerHTML = "Error communicating with server";
                            };

                            //Extract login data
                            var usrEmail = document.getElementById("email").value;
                            var usrPassword = document.getElementById("password").value;

                            //Set up and send request
                            request.open("POST", "customer_login.php");
                            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            request.send("email=" + usrEmail + "&password=" + usrPassword);
                        }

                        //Logs the user out.
                        function logout() {
                            //Create event handler that specifies what should happen when server responds
                            request.onload = function () {
                                checkLogin();
                            };
                            //Set up and send request
                            request.open("GET", "logout.php");
                            request.send();
                        }


                    </script>    
                </div>
            </section>
            
            <!--Footer -->
            <footer>
                <div id="footer">
                    <article>
                        <h4>INFORMATION </h4>
                        <p>
                            <!--google icon-->
                            <i class="material-icons" style="color:#4eab04; font-size:16px;
                               padding:0px 3px 0px 3px;">
                                star</i>
                            100% CUSTOMER SATISFACTION!
                        </p>
                        <p>
                            <!--google icon-->
                            <i class="material-icons" style="color:#4eab04; font-size:16px;
                               padding:0px 3px 0px 3px;">
                                local_shipping</i>
                            100% FREE DELIVERY!
                        </p>
                        <p>
                            <!--google icon-->
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
                            <!--google icon-->
                            <i class="material-icons" style="color:#4eab04; font-size:16px;
                               padding:0px 3px 0px 3px;">
                                room</i>
                            Game World , 1234 Example Road,
                            <br>
                            London N4 89GR 
                        </p>
                        <p>
                            <!--google icon-->
                            <i class="material-icons" style="color:#4eab04; font-size:16px;
                               padding:0px 3px 0px 3px;">
                                call</i>
                            0208-123-456
                        </p>
                        <p>
                            <!--google icon-->
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
