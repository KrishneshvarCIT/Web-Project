<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shopping_cart";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }

    ?>





    <html>
        <head>
            <title>A² Clothing</title>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/css/bootstrap.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.bundle.min.js"></script>


            <style>
                img{
                    width: 100% !important;
                    height: 100px !important;
                    object-fit: contain;
                }

                h3,h2{
                    text-align: center;
                    white-space: nowrap;
                }

                h6{
                    text-align: center;
                }

            </style>
        </head>

        <body>

            <section id="header">
                <a href="index.php"><img src="Images/resultlogo.png" alt="Logo here" class="logo"></a>

                <div>
                    <ul id="navbar">
                        <li><a  href="index.php">Home</a></li>
                        <li><a href="shop.php">Shop</a></li>
                        <li><a  href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a class="active" href="cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                        
                    </ul>
                </div>

            </section>

            <section id="page-header" class="about-header">
                <h2>#Cart</h2>
                <p>Checkout</p>
            </section>

        <section id="cart" class="section-p1">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Image</td>
                            <td>Product</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Add to Cart</td>
                            
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                        
                            <?php
                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                    // echo $row['id']." ". $row['name']." ". $row['image']." ". $row['price']." "."<br>";
                    
                    ?>
                    <div class="col-md-3 text-center">
                       <td> <img src="Images/<?php echo $row['image']?>" > </td>
                       <td><?php echo $row['name']?> </td>
                       <td><?php echo $row['price']?> </td>
                       <td><input type="number" value="0" id="quantity<?php echo $row['id']?>"></td>

                       <input type="hidden" id="name<?php echo $row['id'] ?>" value='<?php echo $row['name']?>'>
                       <input type="hidden" id="price<?php echo $row['id'] ?>" value='<?php echo $row['price']?>'>
                       
                       <td> <button class="btn btn-danger normal add" data-id="<?php echo $row['id'] ?>">Add to Cart</button> </td>
                    </tr>
                    </div>


                    <?php
                    }
                    ?>
                        </div>
                        </tr>
                    </tbody>

                </table>
        </section>


        <section id="cart" class="section-m1">
            <div class="col-md-1">

            </div>
            <div class="col-md-4">
                <h2 class="text-center">Checkout</h2>
                <br>
                <div id="displayCheckout">
                    <?php 
                         if(!empty($_SESSION['cart1'])){
                            $outputTable = '';
                            $total = 0;
                            $outputTable .= "<table class='table table-bordered' id='cart'><thead><tr><td>Name</td><td>Price</td><td>Quantity</td><td>SubTotal</td><td>Action</td></tr></thead>";
                            foreach($_SESSION['cart1'] as $key => $value){
                                $subTotal = $value['p_price'] * $value['p_quantity'];
                                $outputTable .= "<tr><td>".$value['p_name']."</td><td>".$value['p_price']."</td><td>".$value['p_quantity']."</td><td class='subtotal'>".$subTotal."</td><td><button class='btn btn-danger delete' id=".$value['p_id'].">Remove</button></td></tr>";
                
                                $total += ($value['p_price'] * $value['p_quantity']);
                            }
                            $outputTable .= "</table>";
                            $outputTable .= "<div class='text-center'><b>Total: ".$total."</b></div>";
                            echo $outputTable;
                        }                   
                    ?>
                </div>

            </div>
        </section>


            <!--Footer-->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="footer-col">
                            <h4>company</h4>
                            <ul>
                                <li><a href="#">about us</a></li>
                                <li><a href="#">our services</a></li>
                            </ul>
                        </div>
                        <div class="footer-col">
                            <h4>get help</h4>
                            <ul>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">shipping</a></li>
                                <li><a href="#">returns</a></li>
                                <li><a href="#">order status</a></li>
                                <li><a href="#">payment options</a></li>
                            </ul>
                        </div>
                        <div class="footer-col">
                            <h4>Navigate</h4>
                            <ul>
                                <li><a href="#">Kids</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Teens</a></li>
                                <li><a href="#">other</a></li>
                            </ul>
                        </div>
                        <div class="footer-col">
                            <h4>follow us</h4>
                            <div class="social-links">
                                <a href="#" class="fb"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="tw"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="insta"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="liin"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    <div class="copyright">
                        <p> &copy 2023-2024 ||  All Rights Reserved to KEA</p>
                                    <p class="shopname">A-Squared</p>
                    </div>
        
                    </div>
                </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="script.js"></script>


<script>
    $(document).ready(function(){
       alldeleteBtn = document.querySelectorAll('.delete')
       alldeleteBtn.forEach(onebyone => {
            onebyone.addEventListener('click',deleteINsession)
       })

       <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shopping_cart";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }

    ?>





    <html>
        <head>
            <title>A² Clothing</title>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/css/bootstrap.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.bundle.min.js"></script>


            <style>
                img{
                    width: 100% !important;
                    height: 100px !important;
                    object-fit: contain;
                }

                h3,h2{
                    text-align: center;
                    white-space: nowrap;
                }

                h6{
                    text-align: center;
                }

            </style>
        </head>

        <body>

            <section id="header">
                <a href="index.html"><img src="Images/resultlogo.png" alt="Logo here" class="logo"></a>

                <div>
                    <ul id="navbar">
                        <li><a  href="index.html">Home</a></li>
                        <li><a href="shop.html">Shop</a></li>
                        <li><a  href="about.html">About</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a class="active" href="cart.html"><i class="fas fa-shopping-cart"></i></a></li>
                        
                    </ul>
                </div>

            </section>

            <section id="page-header" class="about-header">
                <h2>#Cart</h2>
                <p>Checkout</p>
            </section>

        <section id="cart" class="section-p1">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Image</td>
                            <td>Product</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Add to Cart</td>
                            
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                        
                            <?php
                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                    // echo $row['id']." ". $row['name']." ". $row['image']." ". $row['price']." "."<br>";
                    
                    ?>
                    <div class="col-md-3 text-center">
                       <td> <img src="Images/<?php echo $row['image']?>" > </td>
                       <td><?php echo $row['name']?> </td>
                       <td><?php echo $row['price']?> </td>
                       <td><input type="number" value="0" id="quantity<?php echo $row['id']?>"></td>

                       <input type="hidden" id="name<?php echo $row['id'] ?>" value='<?php echo $row['name']?>'>
                       <input type="hidden" id="price<?php echo $row['id'] ?>" value='<?php echo $row['price']?>'>
                       
                       <td> <button class="btn btn-danger normal add" data-id="<?php echo $row['id'] ?>">Add to Cart</button> </td>
                    </tr>
                    </div>


                    <?php
                    }
                    ?>
                        </div>
                        </tr>
                    </tbody>

                </table>
        </section>


       <div class="col-md-1"></div>
            <div class="col-md-4">
                <h3 class='text-center'>Checkout</h3>
                <div id="displayCheckout">
                    <?php
                    if (!empty($_SESSION['cart1'])) {
                        $outputTable = '';
                        $total = 0;
                        $outputTable .= "<table class='table table-bordered'><thead><tr><td>Name</td><td>Price</td><td>Quantity</td><td>Action</td> </tr></thead>";
                        foreach ($_SESSION['cart1'] as $key => $value) {
                            $outputTable .= "<tr><td>" . $value['p_name'] . "</td><td>" . ($value['p_price'] * $value['p_quantity']) . "</td><td>" . $value['p_quantity'] . "</td><td><button id=" . $value['p_id'] . " class='btn btn-danger normal delete '>Remove</button></td></tr>";
                            $total = $total + ($value['p_price'] * $value['p_quantity']);
                        }
                        $outputTable .= "</table>";
                        $outputTable .= "<div class='text-center'><b>Total: " . $total . "</b></div>";
                        echo $outputTable;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
    alldeleteBtn = document.querySelectorAll('.delete');
    alldeleteBtn.forEach(onebyone => {
        onebyone.addEventListener('click', deleteINsession);
    });

    function deleteINsession() {
        removable_id = this.id;
        $.ajax({
            url: 'cart1.php',
            method: 'POST',
            dataType: 'json',
            data: {
                id_to_remove: removable_id,
                action: 'remove'
            },
            success: function(data) {
                $('#displayCheckout').html(data);
                alldeleteBtn = document.querySelectorAll('.delete');
                alldeleteBtn.forEach(onebyone => {
                    onebyone.addEventListener('click', deleteINsession);
                });
            }
        }).fail(function(xhr, textStatus, errorThrown) {
            alert(xhr.responseText);
        });
    }

    $('.add').click(function() {
        id = $(this).data('id');
        name = $('#name' + id).val();
        price = $('#price' + id).val();
        quantity = $('#quantity' + id).val();
        $.ajax({
            url: 'cart1.php',
            method: 'POST',
            dataType: 'json',
            data: {
                cart1_id: id,
                cart1_name: name,
                cart1_price: price,
                cart1_quantity: quantity,
                action: 'add'
            },
            success: function(data) {
                $('#displayCheckout').html(data);
                alldeleteBtn = document.querySelectorAll('.delete');
                alldeleteBtn.forEach(onebyone => {
                    onebyone.addEventListener('click', deleteINsession);
                });
            }
        }).fail(function(xhr, textStatus, errorThrown) {
            alert(xhr.responseText);
        });
    });
});

    </script>
</body>
</html>

<?php
mysqli_close($conn);
?>