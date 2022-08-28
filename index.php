<?php
session_start();
if (isset($_SESSION['edit'])) {
    $_SESSION['edit'] = "";
}
include_once('connection.php');
include('showimage.php');
if (isset($_POST['support'])) { // To upload support messages 
    if ($_POST['support_name'] != "" and $_POST['support_email'] != "" and $_POST['support_number'] != ""  and $_POST['support_message'] != "") {
        $name = $_POST['support_name'];
        mysqli_real_escape_string($conn, $name);
        $email = $_POST['support_email'];
        mysqli_real_escape_string($conn, $email);
        $number = $_POST['support_number'];
        mysqli_real_escape_string($conn, $number);
        $message = $_POST['support_message'];
        mysqli_real_escape_string($conn, $message);
        $sql = "INSERT INTO support (`support_name`, `support_email`, `support_number`, `support_message`) VALUES ('$name','$email','$number','$message')";
        $result = mysqli_query($conn, $sql);
    }
}

if (isset($_POST['hire'])) { // To upload hire requests
    if ($_POST['hire_name'] != "" and $_POST['hire_email'] != "" and $_POST['hire_number'] != ""  and $_POST['hire_position'] != "") {
        $name = $_POST['hire_name'];
        mysqli_real_escape_string($conn, $name);
        $email = $_POST['hire_email'];
        mysqli_real_escape_string($conn, $email);
        $number = $_POST['hire_number'];
        mysqli_real_escape_string($conn, $number);
        $position = $_POST['hire_position'];
        mysqli_real_escape_string($conn, $position);
        $sql = "INSERT INTO hire (`hire_name`, `hire_email`, `hire_number`, `hire_position`) VALUES ('$name','$email','$number','$position')";
        $result = mysqli_query($conn, $sql);
    }
}
################################# if press on logout--> session_destroy()##################
if (isset($_GET['logout'])) {
    session_destroy();
    header('location:index.php');
}
########################################### session admin is not set--> not logged in --> show page with login and register##########
if (!isset($_SESSION['admin'])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=divice-width, initial-scale=1.0">
        <title lang="es">ELENA Café</title>
        <link rel="shortcut icon" href="images/ELENA%20Cafe.ico">

        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <!-- custom css file link  -->
        <link rel="stylesheet" href="css/style.css">
        <style>
            input[type="number"] {
                -webkit-appearance: textfield;
                -moz-appearance: textfield;
                appearance: textfield;
                background-color: rgb(216, 172, 124);
            }

            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
            }

            .number-input {
                border: 2px solid rgb(216, 172, 124);
                background-color: rgb(216, 172, 124);
                display: inline-flex;
            }

            .number-input,
            .number-input * {
                box-sizing: border-box;
            }

            .number-input button {
                outline: none;
                -webkit-appearance: none;
                background-color: transparent;
                border: none;
                align-items: center;
                justify-content: center;
                width: 3rem;
                height: 3rem;
                cursor: pointer;
                margin: 0;
                position: relative;
            }

            .number-input button:before,
            .number-input button:after {
                display: inline-block;
                position: absolute;
                content: '';
                width: 1rem;
                height: 2px;
                background-color: #212121;
                transform: translate(-50%, -50%);
            }

            .number-input button.plus:after {
                transform: translate(-50%, -50%) rotate(90deg);
            }

            .number-input input[type=number] {
                font-family: sans-serif;
                max-width: 5rem;
                padding: .5rem;

                border-width: 0 2px;
                font-size: 2rem;
                height: 3rem;
                font-weight: bold;
                text-align: center;
            }
        </style>
    </head>

    <body>

        <!-- header section starts  -->

        <header class="header">
            <!-- FA: (Changing the Logo style and border and height = 8 rem) -->
            <a href="#" class="logo">
                <img src="ELENA Cafe.jpg" alt="" style="border-radius: 50% 20% / 10% 40%; border: 2px solid var(--main-color); height: 8rem;">
            </a>

            <!-- FA: (Changing font-size to 2rem) -->
            <nav class="navbar">
                <a href="#home" style="font-size: 3rem;">home</a>
                <a href="#about" style="font-size: 3rem;">about</a>
                <a href="#menu" style="font-size: 3rem;">menu</a>
                <!-- <a href="#products" style="font-size: 2rem;">products</a>         Will be deleted  -->
                <a href="#gallery" style="font-size: 3rem;">gallery</a>
                <a href="#review" style="font-size: 3rem;">review</a>
                <a href="#contact" style="font-size: 3rem;">contact</a>
            </nav>




            <div class="icons">
                <!-- Start of : (login / register section) -->
                <a href="login.php" id="Login-btn" class="Login-btn">Login</a>
                <a href="Register.php" id="Register-btn" class="Register-btn">Register</a>
                <!-- <a href="adminview.php" id="Register-btn" class="Register-btn">admin</a> -->
                <!-- End of : (login / register section) -->
                <div class="fas fa-bars" id="menu-btn"></div>
            </div>



            <div class="search-form">
                <input type="search" id="search-box" placeholder="search here...">
                <label for="search-box" class="fas fa-search"></label>
            </div>

        </header>

        <!-- header section ends -->

        <!-- home section starts  -->

        <section class="home" id="home">

            <div class="content">
                <!-- FA: (Changing style of <h3> tag) -->
                <h3 style="font-size: 55px;">fresh coffee in the morning</h3>
                <p>ELENA is coffee lovers destination.☕</p>
                <a href="#menu" class="btn">get yours now</a>
            </div>

        </section>

        <!-- home section ends -->

        <!-- about section starts  -->

        <section class="about" id="about">

            <h1 class="heading"> <span>about</span> us </h1>

            <div class="row">

                <div class="image">
                    <img src="images/about-img.jpeg" alt="">
                </div>

                <div class="content">
                    <h3>what makes our coffee special?</h3>
                    <p>ELENA is one of the newest coffee shops in SaudiArabia, which is now located in Riyadh, we serve alot of delicious desserts and high quality coffee. Remember, ELENA is coffee lovers destination.☕</p>
                    <a href="#" class="btn">learn more</a>
                </div>

            </div>

        </section>

        <!-- about section ends -->

        <!-- menu section starts  -->
        <!-------------------------------------------------- new_code---------------->

        <section class="menu" id="menu">
            <div class="box-container">
                <?php
                $sqlMenu = "SELECT * FROM menu";
                $result = $conn->query($sqlMenu) or die(mysqli_error($conn));
                while ($record = mysqli_fetch_array($result)) {
                ?>


                    <div class="box">
                        <?php $extension = getExtension($record['menu_path']);
                        ?>
                        <?php echo '<img  src="data:image/' . $extension . ';base64,' . base64_encode($record['menu_image']) . '">' ?>;
                        <h3><?php echo $record['menu_name']; ?></h3>
                        <div class="price"><?php echo "$" . $record['disc_price']; ?><span><?php echo $record['org_price']; ?></span></div>
                        <h3 style="font-size: 20px;">Quantity</h3>
                        <div class="number-input">
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                            <input class="quantity" type="number" name=<?php echo $record['menu_id']; ?> id=<?php echo $record['menu_id']; ?> class="btn" style="width:80%; text-align: center;" placeholder="Quantatiy" min="0" max="30" form="checkout" value="0">
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                        </div>

                    </div>
                <?php } ?>
                <!-------------------------------------------------- end of new_code---------------->
            </div>
        </section>
        <form method="post" name="checkout" id="checkout" action="shoppingCart.php">
            <input type="submit" form="checkout" class=" btn btn-lg btn-block" style="background-color: #d3ad7f; display:block; width: 70%;margin: auto;" value="Checkout">
            <!-----here lies the form, it is accessed every where else using form attribute-->
        </form>

        <!-- menu section ends -->

        <!-- review section starts Edited by Abdulaziz-->

        <section class="review" id="review">

            <h1 class="heading"> instagram <span>reviews</span> </h1>

            <div class="box-container">

                <?php $sql = "select * from review";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_array($result)) :
                ?>
                    <div class="box">
                        <img src="images/quote-img.png" alt="" class="quote">
                        <p><br><br><?php echo $row['review_comment'] ?><br><br><br><br></p>
                        <?php echo '<img src="data:image/' . $extension . ';base64,' . base64_encode($row['review_image']) . '"/>' ?>;
                        <!-- bring the image from the database, it will display image from anywhere, no need to be in the same folder as project| edited by abdullah -->
                        <h3><?php echo $row['review_name'] ?></h3>
                        <div class="stars">
                            <?php
                            $str = $row['review_stars'];

                            while ($str > 0) // This is the logic behind printing the number of starts 
                            {
                                if (($str >= 1)) // Here if it's bigger than 1 (the rating) it means it's a full star
                                    echo '<i class="fas fa-star"></i>' . " ";
                                else // less than one will print half a star no matter what it is
                                    echo '<i class="fas fa-star-half-alt"></i>' . " ";
                                $str--;
                            }

                            echo "<br>";
                            ?>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div>

        </section>

        <!-- review section ends Edited by Abdulaziz-->


        <!--   HI: contact section starts  -->

        <section class="contact" id="contact">

            <h1 class="heading"> <span>contact</span> us </h1>

            <div class="row">

                <iframe class="map" src="https://maps.google.com/maps?q=4034%20%D8%A7%D9%84%D9%88%D8%A7%D8%AF%D9%8A%D8%8C%20%D8%AD%D9%8A%20%D9%84%D8%A8%D9%86%D8%8C%20%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6%2012936%206086%D8%8C%D8%8C%20%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6%2012936&t=&z=19&ie=UTF8&iwloc=&output=embed"></iframe>
                <form action="" method="POST">
                    <!--  HI:  This is for the javascript that is responsible for switching forms -->
                    <input disabled id="Button1" type="button" value="Support" onclick="switchVisible(); disablefirstbutton();" />
                    <input id="Button2" type="button" value="Hiring" onclick="switchVisible();disablesecondbutton();" />
                    <div class="">
                        <div id="Support" style="display: inline;">

                            <div class="inputBox">
                                <span class="fas fa-user"></span>
                                <input type="text" placeholder="name" name="support_name">
                            </div>
                            <div class="inputBox">
                                <span class="fas fa-envelope"></span>
                                <input type="email" placeholder="email" name="support_email">
                            </div>
                            <div class="inputBox">
                                <span class="fas fa-phone"></span>
                                <input type="number" placeholder="number" name="support_number">
                            </div>
                            <div class="inputBox">
                                <span class="fas fa-comment  "></span>
                                <input type="text" placeholder="message" name="support_message" role="textbox">

                            </div>
                            <input type="submit" value="Send" class="btn" name="support">


                        </div>

                        <div id="HireMe" style="display: none; color: aliceblue;">

                            <div class="inputBox">
                                <span class="fas fa-user"></span>
                                <input type="text" placeholder="name" name="hire_name">
                            </div>
                            <div class="inputBox">
                                <span class="fas fa-envelope"></span>
                                <input type="email" placeholder="email" name="hire_email">
                            </div>
                            <div class="inputBox">
                                <span class="fas fa-phone"></span>
                                <input type="number" placeholder="number" name="hire_number">
                            </div>
                            <div class="inputBox" style="color: aliceblue;">
                                <label for="position">
                                    <h1 style="padding-left: 2rem; padding: 20.8px; ">Position</h1>
                                </label>
                                <select name="hire_position" id="position" class="" style="background-color: black;color: white; height: 50px; padding-left: 2rem; ">
                                    <option value="Barista" selected>Barista</option>
                                    <option value="Manager">Manager</option>
                                </select>


                            </div>


                            <input type="submit" value="contact now" class="btn" name="hire">
                        </div>
                    </div>



                </form>

            </div>
        </section>

        <!-- HI: contact section ends -->
        <!-- gallery section starts  / replace BLOG-->

        <section class="gallery" id="gallery">

            <h1 class="heading"> our <span>gallery</span> </h1>

            <div class="accordian">
                <ul>
                    <?php $sql = "select * from carousel limit 5"; //Limit is 5 because carousel won't work well after 5 images
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    while ($row = mysqli_fetch_array($result)) : //Start of the loop
                    ?>

                        <li>
                            <div class="image_title">
                                <a href="#"><?php echo $row['carousel_tag'] ?></a>
                                <!-- Here we print the tag from the database -->
                            </div>
                            <a>
                                <?php echo '<img style="width: 190px; height:160px;"  src="data:image/' . ';base64,' . base64_encode($row['carousel_image']) . '"/>' ?>;
                                <!-- bring the image from the database, it will display image from anywhere, no need to be in the same folder as project| edited by abdullah -->
                                <!-- Here we print the path from the database -->
                            </a>
                        </li>
                    <?php endwhile; ?>
                    <!-- End of loop -->
                </ul>
            </div>

        </section>

        <!-- gallery section ends /Replace BLOG-->

        <!-- HI: footer section starts  -->

        <section class="footer">

            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="https://twitter.com/Elenacafeksa" class="fab fa-twitter" target="_blank"></a>
                <a href="https://www.instagram.com/elena_cafe.sa/?hl=en" class="fab fa-instagram" target="_blank"></a>
                <a href="#" class="fab fa-linkedin"></a>
                <a href="#" class="fab fa-pinterest"></a>
            </div>

            <div class="links">
                <a href="#home">home</a>
                <a href="#about">about</a>
                <a href="#menu">menu</a>
                <a href="#gallary">gallary</a>
                <a href="#review">review</a>
                <a href="#contact">contact</a>
            </div>


        </section>

        <!-- footer section ends -->
        <!-- custom js file link  -->
        <script src="js/script.js"></script>

    </body>

    </html>
    <!-- ############################################ Logged In ########################################################### -->
    <?php } else {
    ################################ ckecking if the user is an admin ######################################
    if ($_SESSION['admin'] == '1') {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=divice-width, initial-scale=1.0">
            <title lang="es">ELENA Café</title>
            <link rel="icon" type="image/x-icon" href="ELENA Cafe.jpg">

            <!-- font awesome cdn link  -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

            <!-- custom css file link  -->
            <link rel="stylesheet" href="css/style.css">

        </head>
        <style>
            input[type="number"] {
                -webkit-appearance: textfield;
                -moz-appearance: textfield;
                appearance: textfield;
                background-color: rgb(216, 172, 124);
            }

            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
            }

            .number-input {
                border: 2px solid rgb(216, 172, 124);
                background-color: rgb(216, 172, 124);
                display: inline-flex;
            }

            .number-input,
            .number-input * {
                box-sizing: border-box;
            }

            .number-input button {
                outline: none;
                -webkit-appearance: none;
                background-color: transparent;
                border: none;
                align-items: center;
                justify-content: center;
                width: 3rem;
                height: 3rem;
                cursor: pointer;
                margin: 0;
                position: relative;
            }

            .number-input button:before,
            .number-input button:after {
                display: inline-block;
                position: absolute;
                content: '';
                width: 1rem;
                height: 2px;
                background-color: #212121;
                transform: translate(-50%, -50%);
            }

            .number-input button.plus:after {
                transform: translate(-50%, -50%) rotate(90deg);
            }

            .number-input input[type=number] {
                font-family: sans-serif;
                max-width: 5rem;
                padding: .5rem;

                border-width: 0 2px;
                font-size: 2rem;
                height: 3rem;
                font-weight: bold;
                text-align: center;
            }
        </style>

        <body>

            <!-- header section starts  -->

            <header class="header">
                <!-- FA: (Changing the Logo style and border and height = 8 rem) -->
                <a href="#" class="logo">
                    <img src="ELENA Cafe.jpg" alt="" style="border-radius: 50% 20% / 10% 40%; border: 2px solid var(--main-color); height: 8rem;">
                </a>

                <!-- FA: (Changing font-size to 2rem) -->
                <nav class="navbar">
                    <a href="#home" style="font-size: 3rem;">home</a>
                    <a href="#about" style="font-size: 3rem;">about</a>
                    <a href="#menu" style="font-size: 3rem;">menu</a>
                    <!-- <a href="#products" style="font-size: 2rem;">products</a>         Will be deleted  -->
                    <a href="#gallery" style="font-size: 3rem;">gallery</a>
                    <a href="#review" style="font-size: 3rem;">review</a>
                    <a href="#contact" style="font-size: 3rem;">contact</a>
                </nav>




                <div class="icons">
                    <!-- Start of : (login / register section) -->
                    <div style="display:flex">

                        <a href="adminview.php" id="Register-btn" class="Register-btn" title="Admin View" style="height:0%">Admin</a>

                        <a href="index.php?logout=yes" id="Register-btn" class="Register-btn" style="height:0%; margin-left:2">Logout</a>


                        <a href="" title="">
                            <?php
                            $name = $_SESSION['name'];
                            $sql = "SELECT account_image FROM account where account_username='$name'";
                            $result = $conn->query($sql);
                            $rowImg = mysqli_fetch_array($result);
                            echo '<img src="data:image/' . ';base64,' . base64_encode($rowImg['account_image']) . '"style="width:100px;;height:70px;  top: 19px; right: 15px; border-radius: 50%;">'  ?>
                        </a>
                        <!-- <a href="adminview.php" id="Register-btn" class="Register-btn">admin</a> -->
                        <!-- End of : (login / register section) -->
                        <div class="fas fa-bars" id="menu-btn"></div>

                    </div>
                </div>



                <div class="search-form">
                    <input type="search" id="search-box" placeholder="search here...">
                    <label for="search-box" class="fas fa-search"></label>
                </div>

            </header>

            <!-- header section ends -->

            <!-- home section starts  -->

            <section class="home" id="home">

                <div class="content">
                    <!-- FA: (Changing style of <h3> tag) -->
                    <h3 style="font-size: 55px;">fresh coffee in the morning</h3>
                    <p>ELENA is coffee lovers destination.☕</p>
                    <a href="#menu" class="btn">get yours now</a>
                </div>

            </section>

            <!-- home section ends -->

            <!-- about section starts  -->

            <section class="about" id="about">

                <h1 class="heading"> <span>about</span> us </h1>

                <div class="row">

                    <div class="image">
                        <img src="images/about-img.jpeg" alt="">
                    </div>

                    <div class="content">
                        <h3>what makes our coffee special?</h3>
                        <p>ELENA is one of the newest coffee shops in SaudiArabia, which is now located in Riyadh, we serve alot of delicious desserts and high quality coffee. Remember, ELENA is coffee lovers destination.☕</p>
                        <a href="#" class="btn">learn more</a>
                    </div>

                </div>

            </section>

            <!-- about section ends -->

            <!-- menu section starts  -->
            <!-------------------------------------------------- new_code---------------->

            <section class="menu" id="menu">
                <div class="box-container">
                    <?php
                    $sqlMenu = "SELECT * FROM menu";
                    $result = $conn->query($sqlMenu) or die(mysqli_error($conn));
                    while ($record = mysqli_fetch_array($result)) {
                    ?>


                        <div class="box">
                            <?php $extension = getExtension($record['menu_path']);
                            ?>
                            <?php echo '<img src="data:image/' . $extension . ';base64,' . base64_encode($record['menu_image']) . '"/>' ?>;
                            <h3><?php echo $record['menu_name']; ?></h3>
                            <div class="price"><?php echo "$" . $record['disc_price']; ?><span><?php echo $record['org_price']; ?></span></div>
                            <h3 style="font-size: 20px;">Quantity</h3>
                            <div class="number-input">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                                <input class="quantity" type="number" name=<?php echo $record['menu_id']; ?> id=<?php echo $record['menu_id']; ?> class="btn" style="width:80%; text-align: center;" placeholder="Quantatiy" min="0" max="30" form="checkout" value="0">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                            </div>


                        </div>
                    <?php } ?>
                    <!-------------------------------------------------- end of new_code---------------->
                </div>
            </section>
            <form method="post" name="checkout" id="checkout" action="shoppingCart.php">
                <input type="submit" form="checkout" class=" btn btn-lg btn-block" style="background-color: #d3ad7f; display:block; width: 70%;margin: auto;" value="Checkout">
                <!-----here lies the form, it is accessed every where else using form attribute-->
            </form>

            <!-- menu section ends -->

            <!-- review section starts Edited by Abdulaziz-->

            <section class="review" id="review">

                <h1 class="heading"> instagram <span>reviews</span> </h1>

                <div class="box-container">

                    <?php $sql = "select * from review";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($result)) :
                    ?>
                        <div class="box">
                            <img src="images/quote-img.png" alt="" class="quote">
                            <p><br><br><?php echo $row['review_comment'] ?><br><br><br><br></p>
                            <?php echo '<img src="data:image/' . $extension . ';base64,' . base64_encode($row['review_image']) . '"/>' ?>;
                            <!-- bring the image from the database, it will display image from anywhere, no need to be in the same folder as project| edited by abdullah -->
                            <h3><?php echo $row['review_name'] ?></h3>
                            <div class="stars">
                                <?php
                                $str = $row['review_stars'];

                                while ($str > 0) // This is the logic behind printing the number of starts 
                                {
                                    if (($str >= 1)) // Here if it's bigger than 1 (the rating) it means it's a full star
                                        echo '<i class="fas fa-star"></i>' . " ";
                                    else // less than one will print half a star no matter what it is
                                        echo '<i class="fas fa-star-half-alt"></i>' . " ";
                                    $str--;
                                }

                                echo "<br>";
                                ?>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>

            </section>

            <!-- review section ends Edited by Abdulaziz-->

            <!--   HI: contact section starts  -->

            <section class="contact" id="contact">

                <h1 class="heading"> <span>contact</span> us </h1>

                <div class="row">

                    <iframe class="map" src="https://maps.google.com/maps?q=4034%20%D8%A7%D9%84%D9%88%D8%A7%D8%AF%D9%8A%D8%8C%20%D8%AD%D9%8A%20%D9%84%D8%A8%D9%86%D8%8C%20%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6%2012936%206086%D8%8C%D8%8C%20%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6%2012936&t=&z=19&ie=UTF8&iwloc=&output=embed"></iframe>
                    <form action="" method="POST">
                        <!--  HI:  This is for the javascript that is responsible for switching forms -->
                        <input disabled id="Button1" type="button" value="Support" onclick="switchVisible(); disablefirstbutton();" />
                        <input id="Button2" type="button" value="Hiring" onclick="switchVisible();disablesecondbutton();" />
                        <div class="">
                            <div id="Support" style="display: inline;">

                                <div class="inputBox">
                                    <span class="fas fa-user"></span>
                                    <input type="text" placeholder="name" name="support_name">
                                </div>
                                <div class="inputBox">
                                    <span class="fas fa-envelope"></span>
                                    <input type="email" placeholder="email" name="support_email">
                                </div>
                                <div class="inputBox">
                                    <span class="fas fa-phone"></span>
                                    <input type="number" placeholder="number" name="support_number">
                                </div>
                                <div class="inputBox">
                                    <span class="fas fa-comment  "></span>
                                    <input type="text" placeholder="message" name="support_message" role="textbox">

                                </div>
                                <input type="submit" value="Send" class="btn" name="support">


                            </div>

                            <div id="HireMe" style="display: none; color: aliceblue;">

                                <div class="inputBox">
                                    <span class="fas fa-user"></span>
                                    <input type="text" placeholder="name" name="hire_name">
                                </div>
                                <div class="inputBox">
                                    <span class="fas fa-envelope"></span>
                                    <input type="email" placeholder="email" name="hire_email">
                                </div>
                                <div class="inputBox">
                                    <span class="fas fa-phone"></span>
                                    <input type="number" placeholder="number" name="hire_number">
                                </div>
                                <div class="inputBox" style="color: aliceblue;">
                                    <label for="position">
                                        <h1 style="padding-left: 2rem; padding: 20.8px; ">Position</h1>
                                    </label>
                                    <select name="hire_position" id="position" class="" style="background-color: black;color: white; height: 50px; padding-left: 2rem; ">
                                        <option value="Barista" selected>Barista</option>
                                        <option value="Manager">Manager</option>
                                    </select>


                                </div>


                                <input type="submit" value="contact now" class="btn" name="hire">
                            </div>
                        </div>



                    </form>

                </div>
            </section>

            <!-- HI: contact section ends -->
            <!-- gallery section starts  / replace BLOG-->

            <section class="gallery" id="gallery">

                <h1 class="heading"> our <span>gallery</span> </h1>

                <div class="accordian">
                    <ul>
                        <?php $sql = "select * from carousel limit 5"; //Limit is 5 because carousel won't work well after 5 images
                        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        while ($row = mysqli_fetch_array($result)) : //Start of the loop
                        ?>

                            <li>
                                <div class="image_title">
                                    <a href="#"><?php echo $row['carousel_tag'] ?></a>
                                    <!-- Here we print the tag from the database -->
                                </div>
                                <a>
                                    <?php echo '<img style="width: 190px; height:160px;"  src="data:image/' . ';base64,' . base64_encode($row['carousel_image']) . '"/>' ?>;
                                    <!-- bring the image from the database, it will display image from anywhere, no need to be in the same folder as project| edited by abdullah -->
                                    <!-- Here we print the path from the database -->
                                </a>
                            </li>
                        <?php endwhile; ?>
                        <!-- End of loop -->
                    </ul>
                </div>

            </section>

            <!-- gallery section ends /Replace BLOG-->

            <!-- HI: footer section starts  -->

            <section class="footer">

                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="https://twitter.com/Elenacafeksa" class="fab fa-twitter" target="_blank"></a>
                    <a href="https://www.instagram.com/elena_cafe.sa/?hl=en" class="fab fa-instagram" target="_blank"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-pinterest"></a>
                </div>

                <div class="links">
                    <a href="#home">home</a>
                    <a href="#about">about</a>
                    <a href="#menu">menu</a>
                    <a href="#gallary">gallary</a>
                    <a href="#review">review</a>
                    <a href="#contact">contact</a>
                </div>


            </section>

            <!-- footer section ends -->
            <!-- custom js file link  -->
            <script src="js/script.js"></script>

        </body>

        </html>

    <?php
    }
    // ######################################################## Not Admin ####################################################
    else {
        include('checkSessionTime.php');
    ?>

        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=divice-width, initial-scale=1.0">
            <title lang="es">ELENA Café</title>
            <link rel="icon" type="image/x-icon" href="ELENA Cafe.jpg">

            <!-- font awesome cdn link  -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

            <!-- custom css file link  -->
            <link rel="stylesheet" href="css/style.css">
            <style>
                input[type="number"] {
                    -webkit-appearance: textfield;
                    -moz-appearance: textfield;
                    appearance: textfield;
                    background-color: rgb(216, 172, 124);
                }

                input[type=number]::-webkit-inner-spin-button,
                input[type=number]::-webkit-outer-spin-button {
                    -webkit-appearance: none;
                }

                .number-input {
                    border: 2px solid rgb(216, 172, 124);
                    background-color: rgb(216, 172, 124);
                    display: inline-flex;
                }

                .number-input,
                .number-input * {
                    box-sizing: border-box;
                }

                .number-input button {
                    outline: none;
                    -webkit-appearance: none;
                    background-color: transparent;
                    border: none;
                    align-items: center;
                    justify-content: center;
                    width: 3rem;
                    height: 3rem;
                    cursor: pointer;
                    margin: 0;
                    position: relative;
                }

                .number-input button:before,
                .number-input button:after {
                    display: inline-block;
                    position: absolute;
                    content: '';
                    width: 1rem;
                    height: 2px;
                    background-color: #212121;
                    transform: translate(-50%, -50%);
                }

                .number-input button.plus:after {
                    transform: translate(-50%, -50%) rotate(90deg);
                }

                .number-input input[type=number] {
                    font-family: sans-serif;
                    max-width: 5rem;
                    padding: .5rem;
                    border-width: 0 2px;
                    font-size: 2rem;
                    height: 3rem;
                    font-weight: bold;
                    text-align: center;
                }
            </style>
        </head>

        <body>

            <!-- header section starts  -->

            <header class="header">
                <!-- FA: (Changing the Logo style and border and height = 8 rem) -->
                <a href="#" class="logo">
                    <img src="ELENA Cafe.jpg" alt="" style="border-radius: 50% 20% / 10% 40%; border: 2px solid var(--main-color); height: 8rem;">
                </a>

                <!-- FA: (Changing font-size to 2rem) -->
                <nav class="navbar">
                    <a href="#home" style="font-size: 3rem;">home</a>
                    <a href="#about" style="font-size: 3rem;">about</a>
                    <a href="#menu" style="font-size: 3rem;">menu</a>
                    <!-- <a href="#products" style="font-size: 2rem;">products</a>         Will be deleted  -->
                    <a href="#gallery" style="font-size: 3rem;">gallery</a>
                    <a href="#review" style="font-size: 3rem;">review</a>
                    <a href="#contact" style="font-size: 3rem;">contact</a>
                </nav>




                <div class="icons">
                    <!-- Start of : (login / register section) -->
                    <a href="index.php?logout=yes" id="Login-btn" class="Login-btn">Logout</a>
                    <a href="profile.php" title="Check Profile">
                        <?php
                        $name = $_SESSION['name'];
                        $sql = "SELECT account_image FROM account where account_username='$name'";
                        $result = $conn->query($sql);
                        $rowImg = mysqli_fetch_array($result);
                        echo '<img src="data:image/' . ';base64,' . base64_encode($rowImg['account_image']) . '"style="width:100px;;height:70px; position: absolute; top: 19px; right: 15px; border-radius: 50%;">'  ?>
                    </a>
                    <!-- <a href="adminview.php" id="Register-btn" class="Register-btn">admin</a> -->
                    <!-- End of : (login / register section) -->
                    <div class="fas fa-bars" id="menu-btn"></div>
                </div>



                <div class="search-form">
                    <input type="search" id="search-box" placeholder="search here...">
                    <label for="search-box" class="fas fa-search"></label>
                </div>

            </header>

            <!-- header section ends -->

            <!-- home section starts  -->

            <section class="home" id="home">

                <div class="content">
                    <!-- FA: (Changing style of <h3> tag) -->
                    <h3 style="font-size: 55px;">fresh coffee in the morning</h3>
                    <p>ELENA is coffee lovers destination.☕</p>
                    <a href="#menu" class="btn">get yours now</a>
                </div>

            </section>

            <!-- home section ends -->

            <!-- about section starts  -->

            <section class="about" id="about">

                <h1 class="heading"> <span>about</span> us </h1>

                <div class="row">

                    <div class="image">
                        <img src="images/about-img.jpeg" alt="">
                    </div>

                    <div class="content">
                        <h3>what makes our coffee special?</h3>
                        <p>ELENA is one of the newest coffee shops in SaudiArabia, which is now located in Riyadh, we serve alot of delicious desserts and high quality coffee. Remember, ELENA is coffee lovers destination.☕</p>
                        <a href="#" class="btn">learn more</a>
                    </div>

                </div>

            </section>

            <!-- about section ends -->

            <!-- menu section starts  -->
            <!-------------------------------------------------- new_code---------------->

            <section class="menu" id="menu">
                <div class="box-container">
                    <?php
                    $sqlMenu = "SELECT * FROM menu";
                    $result = $conn->query($sqlMenu) or die(mysqli_error($conn));
                    while ($record = mysqli_fetch_array($result)) {
                    ?>


                        <div class="box">
                            <?php $extension = getExtension($record['menu_path']);
                            ?>
                            <?php echo '<img src="data:image/' . $extension . ';base64,' . base64_encode($record['menu_image']) . '"/>' ?>;
                            <h3><?php echo $record['menu_name']; ?></h3>
                            <div class="price"><?php echo "$" . $record['disc_price']; ?><span><?php echo $record['org_price']; ?></span></div>
                            <h3 style="font-size: 20px;">Quantity</h3>
                            <div class="number-input">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                                <input class="quantity" type="number" name=<?php echo $record['menu_id']; ?> id=<?php echo $record['menu_id']; ?> class="btn" style="width:80%; text-align: center;" placeholder="Quantatiy" min="0" max="30" form="checkout" value="0">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                            </div>
                        </div>
                    <?php } ?>
                    <!-------------------------------------------------- end of new_code---------------->
                </div>
            </section>
            <form method="post" name="checkout" id="checkout" action="shoppingCart.php">
                <input type="submit" form="checkout" class=" btn btn-lg btn-block" style="background-color: #d3ad7f; display:block; width: 70%;margin: auto;" value="Checkout">
                <!-----here lies the form, it is accessed every where else using form attribute-->
            </form>

            <!-- menu section ends -->

            <!-- review section starts Edited by Abdulaziz-->

            <section class="review" id="review">

                <h1 class="heading"> instagram <span>reviews</span> </h1>

                <div class="box-container">

                    <?php $sql = "select * from review";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($result)) :
                    ?>
                        <div class="box">
                            <img src="images/quote-img.png" alt="" class="quote">
                            <p><br><br><?php echo $row['review_comment'] ?><br><br><br><br></p>
                            <?php echo '<img src="data:image/' . $extension . ';base64,' . base64_encode($row['review_image']) . '"/>' ?>;
                            <!-- bring the image from the database, it will display image from anywhere, no need to be in the same folder as project| edited by abdullah -->
                            <h3><?php echo $row['review_name'] ?></h3>
                            <div class="stars">
                                <?php
                                $str = $row['review_stars'];

                                while ($str > 0) // This is the logic behind printing the number of stars 
                                {
                                    if (($str >= 1)) // Here if it's bigger than 1 (the rating) it means it's a full star
                                        echo '<i class="fas fa-star"></i>' . " ";
                                    else // less than one will print half a star no matter what it is
                                        echo '<i class="fas fa-star-half-alt"></i>' . " ";
                                    $str--;
                                }

                                echo "<br>";
                                ?>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>

            </section>

            <!-- review section ends Edited by Abdulaziz-->

            <!--   HI: contact section starts  -->

            <section class="contact" id="contact">

                <h1 class="heading"> <span>contact</span> us </h1>

                <div class="row">

                    <iframe class="map" src="https://maps.google.com/maps?q=4034%20%D8%A7%D9%84%D9%88%D8%A7%D8%AF%D9%8A%D8%8C%20%D8%AD%D9%8A%20%D9%84%D8%A8%D9%86%D8%8C%20%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6%2012936%206086%D8%8C%D8%8C%20%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6%2012936&t=&z=19&ie=UTF8&iwloc=&output=embed"></iframe>
                    <form action="" method="POST">
                        <!--  HI:  This is for the javascript that is responsible for switching forms -->
                        <input disabled id="Button1" type="button" value="Support" onclick="switchVisible(); disablefirstbutton();" />
                        <input id="Button2" type="button" value="Hiring" onclick="switchVisible();disablesecondbutton();" />
                        <div class="">
                            <div id="Support" style="display: inline;">

                                <div class="inputBox">
                                    <span class="fas fa-user"></span>
                                    <input type="text" placeholder="name" name="support_name">
                                </div>
                                <div class="inputBox">
                                    <span class="fas fa-envelope"></span>
                                    <input type="email" placeholder="email" name="support_email">
                                </div>
                                <div class="inputBox">
                                    <span class="fas fa-phone"></span>
                                    <input type="number" placeholder="number" name="support_number">
                                </div>
                                <div class="inputBox">
                                    <span class="fas fa-comment  "></span>
                                    <input type="text" placeholder="message" name="support_message" role="textbox">

                                </div>
                                <input type="submit" value="Send" class="btn" name="support">


                            </div>

                            <div id="HireMe" style="display: none; color: aliceblue;">

                                <div class="inputBox">
                                    <span class="fas fa-user"></span>
                                    <input type="text" placeholder="name" name="hire_name">
                                </div>
                                <div class="inputBox">
                                    <span class="fas fa-envelope"></span>
                                    <input type="email" placeholder="email" name="hire_email">
                                </div>
                                <div class="inputBox">
                                    <span class="fas fa-phone"></span>
                                    <input type="number" placeholder="number" name="hire_number">
                                </div>
                                <div class="inputBox" style="color: aliceblue;">
                                    <label for="position">
                                        <h1 style="padding-left: 2rem; padding: 20.8px; ">Position</h1>
                                    </label>
                                    <select name="hire_position" id="position" class="" style="background-color: black;color: white; height: 50px; padding-left: 2rem; ">
                                        <option value="Barista" selected>Barista</option>
                                        <option value="Manager">Manager</option>
                                    </select>


                                </div>


                                <input type="submit" value="contact now" class="btn" name="hire">
                            </div>
                        </div>



                    </form>
                </div>

            </section>

            <!-- HI: contact section ends -->
            <!-- gallery section starts  / replace BLOG-->

            <section class="gallery" id="gallery">

                <h1 class="heading"> our <span>gallery</span> </h1>

                <div class="accordian">
                    <ul>
                        <?php $sql = "select * from carousel limit 5"; //Limit is 5 because carousel won't work well after 5 images
                        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        while ($row = mysqli_fetch_array($result)) : //Start of the loop
                        ?>

                            <li>
                                <div class="image_title">
                                    <a href="#"><?php echo $row['carousel_tag'] ?></a>
                                    <!-- Here we print the tag from the database -->
                                </div>
                                <a>
                                    <?php echo '<img style="width: 190px; height:160px;"  src="data:image/' . ';base64,' . base64_encode($row['carousel_image']) . '"/>' ?>;
                                    <!-- bring the image from the database, it will display image from anywhere, no need to be in the same folder as project| edited by abdullah -->
                                    <!-- Here we print the path from the database -->
                                </a>
                            </li>
                        <?php endwhile; ?>
                        <!-- End of loop -->
                    </ul>
                </div>

            </section>

            <!-- gallery section ends /Replace BLOG-->

            <!-- HI: footer section starts  -->

            <section class="footer">

                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="https://twitter.com/Elenacafeksa" class="fab fa-twitter" target="_blank"></a>
                    <a href="https://www.instagram.com/elena_cafe.sa/?hl=en" class="fab fa-instagram" target="_blank"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-pinterest"></a>
                </div>

                <div class="links">
                    <a href="#home">home</a>
                    <a href="#about">about</a>
                    <a href="#menu">menu</a>
                    <a href="#gallary">gallary</a>
                    <a href="#review">review</a>
                    <a href="#contact">contact</a>
                </div>


            </section>

            <!-- footer section ends -->
            <!-- custom js file link  -->
            <script src="js/script.js"></script>

        </body>

        </html>


<?php
    }
}


?>