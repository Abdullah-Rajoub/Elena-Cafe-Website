<?php


include('connection.php');
include('checkExstension.php');
session_start();
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
        <script>
            var sec = 0;

            function countDown() {
                sec += 1;
                document.getElementById('countDown').innerText = "This message will be redircted in"++;
                " sec ... ☠️";
            }
            //                sets the interval for the function
            //                half a secodn
            setInterval(countDown, 3000);

            function redirect() {
                window.location = "index.php";
            }
            setTimeout('redirect ()', 2000);
        </script>

    </head>

    <style>


    </style>


    <body>
        <div class="page-wrapper bg-dark p-t-100 p-b-50">

            <div class="wrapper wrapper--w900">

                <div class="card card-6">

                    <div class="card-heading">
                        <h2 class="title">Register</h2>
                    </div>
                    <div class="faruoq_child">
                        <span class="farouq_childs"></span>
                        <span class="farouq_childs"></span>
                        <span class="farouq_childs"></span>
                        <span class="farouq_childs"></span>
                        <div class="card-body">
                            <form method="POST" action="Register.php" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="name">Enter your email</div>
                                    <div class="value">
                                        <input class="input--style-6" type="email" placeholder="example@email.com" name="remail">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="name">Enter your username</div>
                                    <div class="value">
                                        <div class="input-group">
                                            <input class="input--style-6" type="text" name="runame" placeholder="Your name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="name">Enter your password</div>
                                    <div class="value">
                                        <div class="input-group">
                                            <input class="input--style-6" type="password" name="rpwd" placeholder="Password">
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
                                    <input class="btn btn--radius-2 btn--blue-2" type="submit" value="Register" name="submit">
                                    <p>&nbsp;</p>
                                    <a href="index.php" style="text-decoration:none;"><input class="btn btn--radius-2 btn--blue-2" type="button" value="Cancel" name="cancel"></a>
                            <div class="Just-A-Link text-center">
                                        <?php if (isset($_SESSION['invalid']) and $_SESSION['invalid'] == "true") {
                                        ?>
                                            <div class=" text-center Just-A-Link  ">
                                                <a class="text-decoration-none " style="color:red">An account already exists! </a>
                                            </div>
                                        <?php
                                            $_SESSION['invalid'] = "false";
                                        }
                                        ?>
                                        <?php if (isset($_SESSION['msg']) and $_SESSION['msg'] !== "") {
                                        ?>
                                            <div class=" text-center Just-A-Link  ">
                                                <a class="text-decoration-none " style="color:red">The image exstension you choose does't work, please choose another!</a>
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



    </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
    <?php } else {
    if (checkExtension($_FILES["file_cv"]["name"]) === "valid") {


        $remail = $_POST['remail'];
        mysqli_real_escape_string($conn, $remail);
        $runame = $_POST['runame'];
        mysqli_real_escape_string($conn, $runame);
        $rpwd = md5($_POST['rpwd']);
        $accountImage = mysqli_real_escape_string($conn, file_get_contents($_FILES["file_cv"]["tmp_name"]));
        $sql = "insert into account values('$remail','$runame','$rpwd','$accountImage',0)";
        #doing a select quiry to check of the account already exist
        $check = "select * from account where account_username='$runame' or account_email='$remail'";
        $checked = mysqli_query($conn, $check);
        $row = mysqli_fetch_array($checked);
        #checking if the account already exist 
        if (!is_null($row)) {
            $_SESSION['invalid'] = "true";
            header('location:Register.php');
        }
        //    inserting the new user stuff (pass, uname,...) into db
        $result = mysqli_query($conn, $sql);
        //    adding the username to sesssion variable to be used somehwere else
        $_SESSION['name'] = "$runame";
        $_SESSION['admin'] = "0"; // Not admin by default
        $check = "select * from account where account_username='$runame' or account_email='$remail'";
        $checked = mysqli_query($conn, $check);
        $row = mysqli_fetch_array($checked);
        $_SESSION['time']=time();


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
        $_SESSION['msg'] = "The exstension you choose doesn't work!";
        header("location: Register.php");
    }
}


?>