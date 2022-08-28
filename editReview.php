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
    $ID = mysqli_real_escape_string($conn, $_POST['review_ID']);
    $path = mysqli_real_escape_string($conn, $_FILES["path"]["name"]);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $stars = mysqli_real_escape_string($conn, $_POST['stars']);
    $reviewImage = mysqli_real_escape_string($conn, file_get_contents($_FILES["path"]["tmp_name"]));
    $msg = "";
    #check if the menu item  already exist
    if (exist1($ID)) {
        #we check if the extension was valid or not
        if (substr_compare(checkExtension($path), "valid", 0) === 0) {
            if (exist2($name, $path, $ID)) {
                $error = true;
                $msg = "The person already has a review";
            } else {

                $sql = "UPDATE review SET review_path = '$path', review_name = '$name', review_comment = '$comment', review_stars = '$stars', review_image = '$reviewImage' WHERE review_id = $ID";
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
        $msg = "The Review doesn't exist, check out add reviews from admin page. ";
    }
}
function exist1($ID)
{
    $sql = "select * from review where review_id =$ID";
    $query = $GLOBALS['conn']->query($sql) or die(mysqli_error($GLOBALS['conn']));
    $msg = "";
    if (mysqli_num_rows($query) > 0) {
        return true;
    } else {
        return false;
    }
}
function exist2($name, $path, $ID)
{
    $sql = "select * from review where review_name ='$name' AND review_path='$path'";
    $query = $GLOBALS['conn']->query($sql) or die(mysqli_error($GLOBALS['conn']));
    $msg = "";
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        return $ID != $row['review_id'];
    } else {
        return false;
    }
}
?>

<html lang="en">

    <head>
        <title>Edit review</title>
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
        <!-- Review with ID printed for reference for admin -->
        <section class="review" id="review">

            <h1 class="heading"> instagram <span>reviews</span> </h1>

            <div class="box-container">

                <?php $sql = "select * from review"; 
                $result = mysqli_query($conn, $sql);
                //                checking if there is reviews already
                if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_array($result)) :
                ?>
                <div class="box">
                    <img src="images/quote-img.png" alt="" class="quote">
                    <p><br><br><?php echo $row['review_comment'] ?><br><br><br><br></p>
                    <?php echo '<img src="data:image/' . ';base64,' . base64_encode($row['review_image']) . '"/>' ?>;
                    <!-- bring the image from the database, it will display image from anywhere, no need to be in the same folder as project| edited by abdullah -->
                    <h3><?php echo $row['review_name'] ?></h3>
                    <h3><?php echo "ID: " . $row['review_id'] ?></h3>
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
                <?php endwhile;
                } else { ?>
                <h1 class="heading"> There is no <span>reviews</span> to be edited, please add reviews from admin view. </h1>
                <?php } ?>
            </div>

        </section>
        <!--        Starting of the Form---------------------------------->
        <div class="container mt-5 text-white">
            <h2 style="font-size: 2vw;" class="colorMain">Edit a Review</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-5 mt-3">
                    <label for="text" class="colorSecond" style="font-size: 1vw;">ID of review:</label>
                    <input type="text" class="form-control colorSecond" id="review_ID" name="review_ID" placeholder="ID of review">
                </div>
                <div class="mb-5 mt-3">
                    <label for="text" class="colorSecond" style="font-size: 1vw;">New name:</label>
                    <input type="text" class="form-control colorSecond" name="name" placeholder="Enter New Name" required>
                </div>
                <div class="mb-5 mt-3">
                    <label for="text" class="colorSecond" style="font-size: 1vw;">New comment:</label>
                    <input type="text" class="form-control colorSecond" name="comment" placeholder="Enter New Comment" required>
                </div>
                <div class="mb-5 mt-3">
                    <label for="text" class="colorSecond" style="font-size: 1vw;">New Rating:</label>
                    <input type="text" class="form-control colorSecond" name="stars" placeholder="Enter New Rating" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="colorSecond" style="font-size: 1vw;">Select a file:</label>
                    <input class="form-control colorSecond" type="file" id="path" name="path" required>
                </div>
                <div class="mb-5 mt-3">
                    <p style="font-size: 0.8vw; color: red;"> <?php if ($error) echo $msg ?></p>
                    <p style="font-size: 0.8vw; color: whitesmoke;"> <?php if (!$error) echo $msg ?></p>
                </div>
                <button type="submit" class="btn " name="submit" value="submit" id="submit">Submit</button>
            </form>
        </div>




    </body>

</html>