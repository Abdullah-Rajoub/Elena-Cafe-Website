<!DOCTYPE html>
<?php
session_start();
include_once('connection.php');
include_once('checkExstension.php');
# to keep track of errors we have these two variables: 

$error = false;
$msg = "";
if (isset($_POST['submit'])) {

    #mysqli_real_escape_string --> prevents sql injection attacks 
    $path = mysqli_real_escape_string($conn, $_FILES["path"]["name"]);
    $reviewImage = mysqli_real_escape_string($conn, file_get_contents($_FILES["path"]["tmp_name"]));
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $stars = mysqli_real_escape_string($conn, $_POST['stars']);
    $msg = "";
    #check if the ducome already exist
    if (!exist($path, $name)) {
        #we check if the extension was valid or not
        if (lessThanThree()) {
            if (substr_compare(checkExtension($path), "valid", 0) === 0) {
                $sql = "INSERT INTO review (review_path, review_name, review_comment, review_stars, review_image) VALUES ('$path', '$name', '$comment', $stars, '$reviewImage')";
                $query = $conn->query($sql) or die(mysqli_error($conn));
                $msg = "Inserted Correctly! ";
            }
            #if the extension is not valid
            else {
                $error = true;
                $msg =  checkExtension($path);
            }
        } else {
            $error = true;
            $msg = "The maximum number of reviews have been reached (3). Please delete some in admin page.";
        }
    }
    # if the recrd already exist we say an error. 
    else {
        $error = true;
        $msg = "The person specified already made a review";
    }
}


function exist($path, $name)
{
    $sql = "select * from review where review_path ='$path' AND review_name='$name'";
    $query = $GLOBALS['conn']->query($sql) or die(mysqli_error($GLOBALS['conn']));
    $msg = "";
    if (mysqli_num_rows($query) > 0) {
        return true;
    } else {
        return false;
    }
}
function lessThanThree()
{
    $sql = "select * from review";
    $query = $GLOBALS['conn']->query($sql) or die(mysqli_error($GLOBALS['conn']));
    $msg = "";
    if (mysqli_num_rows($query) < 10) {
        return true;
    } else {
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Add Review</title>
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

        </header>s
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <!--        Starting of the Form---------------------------------->
        <div class="container mt-5 text-white">
            <h2 style="font-size: 2vw;" class="colorMain">Add a Review</h2>
            <form action="" method="post" enctype="multipart/form-data">
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
                    <input type="text" class="form-control colorSecond" name="stars" placeholder="Enter New Rating out of 5" required>
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