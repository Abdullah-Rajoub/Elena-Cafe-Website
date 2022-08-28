<?php

include('checkExstension.php');
include('connection.php');
session_start();
##################################### before user presses on edit profile#################################
if ((!isset($_SESSION['edit']) or $_SESSION['edit'] === "")) {
    $tmpName = $_SESSION['name'];
    $newSql = "select * from account where account_username='$tmpName'";
    $newRecord = $conn->query($newSql);
    $row = mysqli_fetch_array($newRecord) or die(mysqli_error($conn));
?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Login php </title>
        <!--  Elena Favicon  -->
        <link rel="icon" type="image/x-icon" href="ELENA Cafe.jpg">
        <!-- CSS FILE -->
        <link rel="stylesheet" href="css/Register-style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Bootstrap 5 Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Title Page-->
        <title>Register</title>

        <!-- Font special for pages-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

        <!-- Main CSS-->
        <link rel="stylesheet" href="css/main.css">
        <style>
            body {
                background: url(images/login.jpeg) no-repeat;
                background-size: cover;
                background-position: center;
            }
        </style>


    </head>


    <body>
        <div class="container-fluid mt-5 text-white" style="position: absolute; top: 20%;">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div style="display: flex;">
                        <?php echo '<img style="width: 50%; margin: auto; justify-content: center" class="rounded-circle" src="data:image/' . ';base64,' . base64_encode($row['account_image']) . '">' ?>
                    </div>
                    <h1 class="mt-3" style="text-align: center"> <span class="secondary" style="color:rgb(180, 180, 180)"> <?php echo $row['account_username'] ?> </span> </h1>
                    <a href="edit.php" class="btn btn-secondary mt-4" style="width:30%; border:0; border-radius:100%;  display: block; margin:auto; background-color:rgba(67,52,49,255); color: rgb(180, 180, 180);"> Edit Profile </a>
                    <a href="index.php" class="btn btn-secondary mt-4" style="width:30%; border:0; border-radius:100%;  display: block; margin:auto; background-color:rgba(67,52,49,255); color: rgb(180, 180, 180);"> Cancel </a>

                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>

    </html>
<?php ################################## after user presses on edit profile#####################
} else {


?>

    <?php


    # checking the user enter something, if he has print anything, we will just display the log in page normally/with an error 
    # if session invalid is set to true; 
    if ((!isset($_POST['submit']))) {
    ?>

        <!DOCTYPE html5>
        <html lang="en">

        <head>
            <!-- Required meta tags-->
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- Title Page-->
            <title>Register</title>

            <!-- Font special for pages-->
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

            <!-- Main CSS-->
            <link rel="stylesheet" href="css/main.css">


            <style>
                body {
                    background: url(images/login.jpeg) no-repeat;
                    background-size: cover;
                    background-position: center;
                }
            </style>

        </head>

        <style>


        </style>


        <body>
            <div class="page-wrapper bg-dark p-t-100 p-b-50">

                <div class="wrapper wrapper--w900">

                    <div class="card card-6">

                        <div class="card-heading">
                            <h2 class="title">Update Your Credentials</h2>
                        </div>
                        <div class="faruoq_child">
                            <span class="farouq_childs"></span>
                            <span class="farouq_childs"></span>
                            <span class="farouq_childs"></span>
                            <span class="farouq_childs"></span>
                            <div class="card-body">
                                <form method="POST" action="profile.php" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="name">Enter your username</div>
                                        <div class="value">
                                            <div class="input-group">
                                                <input class="input--style-6" type="text" name="runame" placeholder="Your name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="name">Enter your password</div>
                                        <div class="value">
                                            <div class="input-group">
                                                <input class="input--style-6" type="password" name="rpwd" placeholder="Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="name">Enter new username</div>
                                        <div class="value">
                                            <div class="input-group">
                                                <input class="input--style-6" type="text" name="nuname" placeholder="Your name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="name">Enter new password</div>
                                        <div class="value">
                                            <div class="input-group">
                                                <input class="input--style-6" type="password" name="npwd" placeholder="Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="name">Upload your picture</div>
                                        <div class="value">
                                            <div class="input-group js-input-file">
                                                <input class="input-file" type="file" name="file_cv" id="file" required>
                                                <label class="label--file" for="file" style=" background: #19052c;">Choose
                                                    file</label>
                                                <span class="input-file__info">No file chosen</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <input class="btn btn--radius-2 btn--blue-2" type="submit" value="Update" name="submit">
                                        <p>&nbsp;</p>
                                        <a href="index.php" style="text-decoration:none;"><input class="btn btn--radius-2 btn--blue-2" type="button" value="Cancel" name="cancel"></a>
                                        <div class="Just-A-Link text-center">
                                            <?php if (isset($_SESSION['msg']) and $_SESSION['msg'] != "") {
                                            ?>
                                                <div class=" text-center Just-A-Link  ">
                                                    <a class="text-decoration-none " style="color:red"><?php echo $_SESSION['msg']; ?> </a>
                                                </div>
                                            <?php
                                                $_SESSION['msg'] = "";
                                            }
                                            ?>
                                            <input class=" d-inline-block " style="width: fit-content;" type="checkbox" id="terms_and_conditions" name="terms_and_conditions" required>
                                            <label for="terms_and_conditions">I read and agreed to</label> <a class="text-decoration-none" href="terms_and_conditions.html">Terms & Conditions</a>
                                            <div class=" text-center Just-A-Link  ">
                                                <a class="text-decoration-none  " href="login.php">You already have an account?</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <!----------------------------------------------------------------------------END OF NOT SUBMITTED-------------------------->
        </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
        <?php } else {
        ######### check if the extension of image is valid. ########################################################
        if (checkExtension($_FILES["file_cv"]["name"]) == "valid") {
            $msg = "";
            $runame = $_POST['nuname'];
            $rpwd = md5($_POST['npwd']);
            $accountImage = mysqli_real_escape_string($conn, file_get_contents($_FILES["file_cv"]["tmp_name"]));

            #doing a select quiry to checkt there is a user with this pass and uname
            $luname = $_POST['runame'];
            $lpwd = md5($_POST['rpwd']);
            $sql = "select * from account where account_username='$runame'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)) {
                $_SESSION['msg'] = "This user name is already in use. Please choose another!";
                header("location: profile.php");
            }
            $sql = "select * from account where account_username='$luname' AND account_password='$lpwd'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            # check if there is a recrod with the specifed select query, (user exiist)
            if ($row['account_username'] != "") {
                ## unsetting session edit... becuase we are editing it now, so when user goes into profile again he will be not editing

                //    inserting the new user stuff (pass, uname,...) into db
                $sql = "UPDATE account SET account_username='$runame', account_password='$rpwd', account_image='$accountImage' WHERE account_username='$luname'";
                $result = mysqli_query($conn, $sql);
                $_SESSION['name'] = $runame;
                $check = "select * from account where account_username='$runame'";
                $checked = mysqli_query($conn, $check);
                $row = mysqli_fetch_array($checked);


        ?>
                <?php

                $runame = $_POST['runame'];
                $rpwd = $_POST['rpwd'];
                ?>

                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title> Register page </title>
                    <!--  Elena Favicon  -->
                    <link rel="icon" type="image/x-icon" href="ELENA Cafe.jpg">
                    <!-- CSS FILE -->
                    <link rel="stylesheet" href="Register-style.css">
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <script>
                        var sec = 0;

                        function countDown() {
                            sec += 1;
                            document.getElementById('countDown').innerHTML = "This message will be redircted in"++;
                            " sec ... ☠️";
                        }
                        //                sets the interval for the function
                        //                half a secodn
                        setInterval(countDown, 1000);

                        function redirect() {
                            window.location = "index.php";
                        }
                        setTimeout('redirect()', 2000);
                    </script>

                </head>

                <style>
                    body {
                        background: url(images/login.jpeg) no-repeat;
                        background-size: cover;
                        background-position: center;
                    }
                </style>

                <body>
                    <div class="container-fluid mt-5 text-white" style="position: absolute; top: 20%;">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div style="display: flex;">
                                    <?php echo '<img style="width: 50%; margin: auto; justify-content: center" class="rounded-circle" src="data:image/' . ';base64,' . base64_encode($row['account_image']) . '">' ?>
                                </div>
                                <h1 class="mt-3" style="text-align: center"><?php echo "Welcome" ?> <span style="color:rgb(216,172,124);"> <?php echo $_SESSION['name'] ?> </span> </h1>
                                <p style="text-align: center;">You will be redircted in 5 seconds</p>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                    <script>
                        const myTimeout = setTimeout(myGreeting, 5000);

                        function myGreeting() {
                            window.location.replace('index.php');
                        }
                    </script>
                </body>

                </html>



<?php


            } else {
                $_SESSION['msg'] = "Wrong password/username.";
                header("location: profile.php");
            }
        } else {
            $_SESSION['msg'] = "The image uploaded is not valid, Please choose another image.";
            header("location: profile.php");
        }
    }
}
?>