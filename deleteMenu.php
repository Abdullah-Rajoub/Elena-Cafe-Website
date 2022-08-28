<!DOCTYPE html>
<?php
session_start();
include_once('connection.php');

include('checkExist.php');
if (isset($_POST['submit'])) {

    # this method protects from sql injection attacks. 
    $menuName = mysqli_real_escape_string($conn, $_POST['menuName']);
    # We have these two variables to keep track of errors, and print them later
    $msg = "";
    $error = false;
    if (exist($menuName)) {
        $sql = "DELETE FROM menu WHERE menu_name = '$menuName'";
        $query = $conn->query($sql) or die(mysqli_error($conn));
        $msg = "The menu item was deleted successufly";
    } else {
        $error = true;
        $msg = "The menu item doesn't exist, please choose the correct menu item!";
    }
}

?>

<html lang="en">

    <head>
        <title>Delete Menu</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title lang="es">ELENA Café</title>
        <link rel="icon" type="image/x-icon" href="ELENA Cafe.jpg">

        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <!-- custom css file link  -->
        <link rel="stylesheet" href="css/style.css">

        <style>
            a {
                text-decoration: none;
            }

            .sections {
                font-size: 5vw;
                color: whitesmoke;
            }

            .links {

                transition-duration: 0.4s;
                transition-timing-function: ease-in;
                color: whitesmoke;
            }

            .colorMain {
                color: #d3ad7f;
            }

            label.colorSecond {
                color: #edd9c7;
                font-size: 100px;
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
                <a href="index.php#home" style="font-size: 3rem;">home</a>
                <a href="index.php#about" style="font-size: 3rem;">about</a>
                <a href="index.php#menu" style="font-size: 3rem;">menu</a>
                <!-- <a href="#products" style="font-size: 2rem;">products</a>         Will be deleted  -->
                <a href="index.php#gallery" style="font-size: 3rem;">gallery</a>
                <a href="index.php#review" style="font-size: 3rem;">review</a>
                <a href="index.php#contact" style="font-size: 3rem;">contact</a>
            </nav>
            <div class="icons" style="display:flex;">
                <!-- Start of : (login / register section) -->
                <a href="adminview.php" id="Register-btn" class="Register-btn" title="Admin View">Back</a>
                <!-- End of : (login / register section) -->
            </div>
            <div class="search-form">
                <input type="search" id="search-box" placeholder="search here...">
                <label for="search-box" class="fas fa-search"></label>
            </div>

        </header>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <!-------------------------------------------------- new_code---------------->

        <section class="menu" id="menu">
            <div class="box-container">
                <?php
                $sqlMenu = "SELECT * FROM menu";
                $result = $conn->query($sqlMenu) or die(mysqli_error($conn));
                while ($record = mysqli_fetch_array($result)) {
                ?>


                <div class="box">

                    <?php echo '<img src="data:image/' . ';base64,' . base64_encode($record['menu_image']) . '"/>' ?>;
                    <h3><?php echo $record['menu_name']; ?></h3>
                    <div class="price"><?php echo "$" . $record['disc_price']; ?><span><?php echo $record['org_price']; ?></span></div>
                </div>
                <?php } ?>
                <!-------------------------------------------------- end of new_code---------------->

                </section>
            <!--        Starting of the Form---------------------------------->
            <div class="container mt-5 text-white">
                <h2 style="font-size: 2vw;" class="colorMain">Delete a Menu Item</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-5 mt-3">
                        <label for="text" class="colorSecond" style="font-size: 1vw;">Name of the menu Item:</label>
                        <input type="text" class="form-control colorSecond" id="menuName" name="menuName" placeholder="Menu Item name">
                    </div>
                    <div class="mb-5 mt-3">
                        <p class="Danger" style="color: red; font-size: 0.8vw;"><?php if (isset($_POST['submit']) and $error) {
    echo $msg;
}  ?></p>
                        <p class="Danger" style="color: whitesmoke; font-size: 0.8vw;"><?php if (isset($_POST['submit']) and !$error) {
    echo $msg;
}  ?></p>
                    </div>
                    <button type="submit" class="btn" name="submit" value="submit" id="submit">Submit</button>
                </form>
            </div>




            </body>

        </html>