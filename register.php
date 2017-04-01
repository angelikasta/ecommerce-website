<!DOCTYPE html>
<html>
    <head>
        <title> GameWorld - Register </title>
        <link rel="stylesheet" type="text/css" href="new.css" />
        <!--google icons !-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    </head>
    <body>
        <div class="container">
            <div id="tophead">
                <!--search bar form-->
                <div id="searchBar">
                    <form>
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
                <!--navigation-->
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
                                </div>
                            </li>

                            <!--google shopping cart icon!-->
                            <a href="cart.html"><i class="material-icons" style="color:white;text-align:right;font-size:26px;">
                                    shopping_cart</i></a>
                        </ul>
                    </div>

                </nav>
            </header>
            <section>
                <!--change default text align setting to center !-->
                <div id="section" style="text-align:center;background-color:white;">
                    <br>
                    <h1 id ="h1">Register your account</h1>
                    <hr style="width:50%;">


                    <h2>
                        <!--registration form !-->
                        <div id="form2">

                            <form id = "userDetails" name ="regForm" method = "post">

                                First Name: 
                                <br> 
                                <input type="text" name="firstname" id="firstname"
                                       placeholder ="input required" style="width:60%" required>
                                <br>

                                Last Name: 
                                <br>
                                <input type="text" name="lastname" id="lastname" style="width:60%;"
                                       required>
                                <br>

                                Email: 
                                <br>
                                <input type="email" name="email" id="email"  
                                       placeholder="Enter a valid email address"
                                       style="width:80%" required> <br>

                                Password: 
                                <br>
                                <input type="password" name="password"  id="password" 
                                       placeholder ="minimum 5 characters" style="width:80%"
                                       required> <br>

                                Phone Number:
                                <br>
                                <input type="tel" id="phonenumber" name="phonenumber" pattern="^\d{10}$" 
                                       placeholder="Enter valid phone number, 10 digits" 
                                       style="width:60%"> <br>

                                Address:
                                <br>
                                <input type="text" id="address" name="address"  
                                       placeholder="First line"
                                       style="width:80%"> <br>
                                City:
                                <br>
                                <input type="text" id="city"  name="city"
                                       placeholder="City"
                                       style="width:60%"> <br>
                                Post Code:
                                <br>
                                <input type="text" id="postcode"  name="postcode"
                                       placeholder="City"
                                       style="width:40%"> <br>

                                Date Of Birth:
                                <br>
                                <input type="date" id="dateofbirth" name="dateofbirth" style="width:80%">
                                <br>

                                <input type="submit">
                            </form>


                        </div>
                    </h2>
                    <br>
                </div>
            </section>
            
            <?php
            //connect to database
            $mongoClient = new MongoClient();

            //Select a database
            $db = $mongoClient->gameShop;
            $collection = $db->customers;

            //extact the data that was sent to the server
            $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
            
            $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
            
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            
            $phonenumber = filter_input(INPUT_POST, 'phonenumber', FILTER_SANITIZE_STRING);
            
            $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
            
            $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
            
            $postcode = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING);
            
            $dateofbirth = filter_input(INPUT_POST, 'dateofbirth', FILTER_SANITIZE_STRING);


            //convert to PHP array
            $dataArray = [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email,
                "password" => $password,
                "phonenumber" => $phonenumber,
                "address" => $address,
                "city" => $city,
                "postcode" => $postcode,
                "dateofbirth" => $dateofbirth,
                //add an empty array for orders and searches
                "lastorder" => array(),
                "searches" => array()
            ];

            //Addthe new customer to the database
            $returnVal = $collection->insert($dataArray);

            //Echo resultback to user
            if ($returnVal['ok'] == 1) {
                echo 'ok';
            } else {
                echo 'Error adding customer';
            }

            //close the connection
            $mongoClient->close();
            ?>
            
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
