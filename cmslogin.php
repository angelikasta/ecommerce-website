<!DOCTYPE html>
<html>
    <head>
        <title> CMS Staff Login </title>
        <link rel="stylesheet" type="text/css" href="new.css" />	
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    </head>
    <body>
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
                            <li><a href="cmslogin.php">STAFF LOGIN</a></li>
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

            <section>
                <div id="section" style="text-align:center;">
                    <br>
                    <h1 id ="h1">Staff Login</h1>
                    <br>
                    <h2>
                        <!--staff login form !-->

                        <div id="form2" style="width:50%">
                            <p id="LoginPara">

                                StaffID: <br>
                                <input type ="email" id="email" name="email" style="width:100%" required><br>
                                Password: <br>
                                <input type = "password" id="password" name="password" style="width:80%" required><br>
                                <button onclick="login()">Submit</button>
                            </p>
                            <!-- display error msg when appriopriate -->
                            <p style="color:white" id="ErrorMessages"></p>
                        </div>
                        <script>
                            
                            //Global variables 
                            var loggedInStr = "<p> Staff Logged In </p> <button onclick='logout()'>Logout</button>";
                            
                            //login msg
                            var loginStr = document.getElementById("LoginPara").innerHTML;
                            
                            var request = new XMLHttpRequest();

                            window.onload = checkLogin;

                            //Checks whether user is logged in.
                            function checkLogin() {
                                //Create event handler that specifies what should happen when server responds
                                request.onload = function () {
                                    if (request.responseText === "Staff Logged In") {
                                        document.getElementById("LoginPara").innerHTML = loggedInStr;
                                    } else {
                                        console.log(request.responseText);
                                        document.getElementById("LoginPara").innerHTML = loginStr;
                                    }
                                };
                                
                                //Set up and send request
                                request.open("GET", "check_loginCMS.php");
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
                                            document.getElementById("ErrorMessages").innerHTML = ""; //Clear error messages
                                        } else
                                            document.getElementById("ErrorMessages").innerHTML = request.responseText;
                                    } else
                                        document.getElementById("ErrorMessages").innerHTML = "Error communicating with server";
                                };

                                //Extract login data
                                var usrEmail = document.getElementById("email").value;
                                var usrPassword = document.getElementById("password").value;

                                //Set up and send request
                                request.open("POST", "staff_login.php");
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

                    </h2>

                </div>

            </section>
        </div>
    </body>
</html>
