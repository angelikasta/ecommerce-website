<!DOCTYPE html>
<html>
    <head>
        <title>CMS Added Product</title>
        <link rel="stylesheet" type="text/css" href="new.css" />	
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
                            <li><a href="cmsindex.html">STAFF LOGIN</a></li>
                            <!--dropdown menu  !-->
                            <li class="dropdown">
                                <a class="dropbtn">PRODUCTS</a>
                                <div class="dropdown-content">
                                    <a href="deleteProducts.html">DELETE PRODUCTS</a>
                                    <a href="addProduct.html">ADD PRODUCTS</a>
                                    <a href="editProducts.html">EDIT PRODUCTS</a>


                                </div>
                            </li>
                            <li><a href="viewOrders.html">VIEW ORDERS</a></li>

                            <li><a href="viewCustomers.html">VIEW CUSTOMERS</a></li>


                        </ul>
                    </div>
                </nav>
            </header>
            <section>
                <div id="section" style="text-align:center;background-color:white;">
                    <br>
                    <h1 id ="h1">Add Product</h1>

                    <br>


                        <div id="form2" style="width:50%">

                            <!--add product form  !-->

                            <form id="productDetails" name="addform" method = "post" action="addProduct2.php">
                                Product Title: <br>
                                <input type ="text" id="title" name="title" style="width:100%" required><br>
                                Description: <br>
                                <input type = "text" id="description" name="description" style="width:80%" required><br>
                                Year Of Release: <br>
                                <input type ="number" id="year" name="year" style="width:40%" required><br>
                                Price: <br>
                                <input type = "currency" id="price" name="price" style="width:50%" required><br>
                                
                                <!--game categories -->
                                Categories: <br>
                                <input type ="checkbox" id="strategy" 
                                name = "category[]" value="strategy"
                                style="width:40%" >
                                Strategy games
                                <br>
                                <input type ="checkbox" id="action" name = "category[]"  value="action"
                                style="width:40%" >
                                Action games
                                <br>
                                <input type ="checkbox" id="rpg" name = "category[]" value="rpg" style="width:40%" >
                                RPG
                                <br>
                                <input type ="checkbox" id="fighting" name = "category[]" value="fighting" style="width:40%" >
                                Fighting games
                                <br>
                                <input type ="checkbox" id="driving" name = "category[]" value="driving" style="width:40%" >
                                Driving games
                                <br>
                                <input type ="checkbox" id="shooter" name = "category[]" 
                                value = "shooter" style="width:40%" >
                                Shooter games
                                <br>
                                <input type ="checkbox" id="children" name = "category[]" value="children" style="width:40%" >
                                Childrens games
                                <br>
                                <input type ="checkbox" id="sport" name = "category[]" value="children" style="width:40%" >
                                Sport games
                                <br>
                                
                                
                                Tags: <br>
                                <input type = "text" id="tags"  name="tags[]" style="width:80%" required><br>
                                Console: 
                                <br>
                                <select id="console"
                                     name="console" style="width:80%">
                                    <option value="XBOX">Xbox</option>
                                    <option value="PS4">PlayStation</option>
                                </select><br>
                                Quantity: <br>
                                <input type ="number" id="quantity" name = "quantity" style="width:40%" required><br>
                                Image URL: <br>
                                <input type ="text" id="image_url" name="image_url" style="width:80%" required><br>
                                <input type="submit" value="ADD PRODUCT">

                            </form>
                        </div>

                </div>



            </section>
        </div>
    </body>
</html>