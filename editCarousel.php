<!DOCTYPE html>
<?php
session_start();
include_once('connection.php');

include_once('checkExstension.php');
$error = false;
$msg = "";
if (isset($_POST['submit'])) {

    # this method protects from sql injection attacks. 

    #mysqli_real_escape_string --> prevents sql injection attacks 
    $ID = mysqli_real_escape_string($conn, $_POST['Carousel_ID']);
    $path = mysqli_real_escape_string($conn, $_FILES["path"]["name"]);
    $tag = mysqli_real_escape_string($conn, $_POST['tag']);
    #getting the image data
    $carouselImage = mysqli_real_escape_string($conn, file_get_contents($_FILES["path"]["tmp_name"]));
    $msg = "";
    #check if the menu item  already exist
    if (exist1($ID)) {
        #we check if the extension was valid or not
        if (substr_compare(checkExtension($path), "valid", 0) === 0) {
            if (exist2($path, $tag, $ID)) {
                $error = true;
                $msg = "The gallery item you specified already exists";
            } else {

                $sql = "UPDATE carousel SET carousel_path = '$path', carousel_tag = '$tag', carousel_image = '$carouselImage' WHERE carousel_id = $ID";
                $query = $conn->query($sql) or die(mysqli_error($conn));
                $msg = "Edited Successfuly! ";
            }
        }
        #if the extension is not valid
        else {
            $error = true;
            $msg =  checkExtension($path);
        }
    }
    # if the recrd already exist we say an error. 
    else {
        $error = true;
        $msg = "The Gallery item doesn't exist, check out add pictures from admin page. ";
    }
}
function exist1($ID)
{
    $sql = "select * from carousel where carousel_id =$ID";
    $query = $GLOBALS['conn']->query($sql) or die(mysqli_error($GLOBALS['conn']));
    $msg = "";
    if (mysqli_num_rows($query) > 0) {
        return true;
    } else {
        return false;
    }
}
function exist2($path, $tag, $ID)
{
    $sql = "select * from carousel where carousel_path ='$path' AND carousel_tag='$tag'";
    $query = $GLOBALS['conn']->query($sql) or die(mysqli_error($GLOBALS['conn']));
    $msg = "";
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        return $ID != $row['carousel_id'];
    } else {
        return false;
    }
}
?>

<html lang="en">

    <head>
        <title>Edit carousel</title>
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
        <br>
        <br>
        <!-- Carousel with ID printed for reference for admin -->
        <section class="gallery" id="gallery" style="margin-bottom:0; padding:0; position:relative">

            <h1 class="heading"> our <span>gallery</span> </h1>

            <div class="accordian mt-3" style="margin-bottom:0;">
                <ul>
                    <?php $sql = "select * from carousel limit 5"; //Limit is 5 because carousel won't work well after 5 images
                    $result = mysqli_query($conn, $sql);
                    //                            checking if there is gallary items in db already
                    if (mysqli_num_rows($result)) {
                        while ($row = mysqli_fetch_array($result)) : //Start of the loop
                    ?>

                    <li>
                        <div class="image_title" style="margin-bottom:0;">
                            <a href="#"><?php echo $row['carousel_tag'] ?></a>
                            <a href="#"><?php echo "ID: " . $row['carousel_id'] ?></a>
                            <!-- Here we print the tag from the database -->
                        </div>
                        <a>
                            <?php echo '<img style="width: 190px; height:160px;"  src="data:image/' . ';base64,' . base64_encode($row['carousel_image']) . '"/>' ?>;
                            <!-- bring the image from the database, it will display image from anywhere, no need to be in the same folder as project| edited by abdullah -->
                            <!-- Here we print the path from the database -->
                        </a>
                    </li>
                    <?php endwhile;
                    } else { ?>
                    <!-- End of loop -->
                </ul>
                <!-- if there no gallarry items, this will be printed instead-->
                <h1 class="heading"> There is no <span>Gallary</span> items to be edited, please add Gallary items from admin view. </h1>
                <?php } ?>
            </div>

        </section>
        <!--        Starting of the Form---------------------------------->
        <div class="container text-white" style="margin-top:0; padding:0;">
            <h2 style="font-size: 2vw; margin:0" class="colorMain" >Edit a Gallery Item</h2>
            <form action="" method="post" enctype="multipart/form-data" style="margin-top:0;">
                <div class="mb-2">
                    <label for="text" class="colorSecond" style="font-size: 1vw;">ID of item:</label>
                    <input type="text" class="form-control colorSecond" id="Carousel_ID" name="Carousel_ID" placeholder="ID of item">
                </div>
                <div class="mb-2">
                    <label for="text" class="colorSecond" style="font-size: 1vw;">New Photo Tag:</label>
                    <input type="text" class="form-control colorSecond" name="tag" placeholder="Enter New Photo Tag" required>
                </div>
                <div class="mb-2">
                    <label for="path" class="colorSecond" style="font-size: 1vw;">Select a file:</label>
                    <input class="form-control colorSecond" type="file" id="path" name="path" required>
                </div>
                <div class="">
                    <p style="font-size: 0.8vw; color: red;"> <?php if ($error) echo $msg ?></p>
                    <p style="font-size: 0.8vw; color: whitesmoke;"> <?php if (!$error) echo $msg ?></p>
                </div>
                <button type="submit" class="btn" name="submit" value="submit" id="submit">Submit</button>
            </form>
        </div>




    </body>

</html>