<?php
include('connection.php');
session_start();
if (!isset($_SESSION['failed'])) {

    $_SESSION['failed'] = "false";
}
# when the user enter something we do a select query to check if the info entered was correct
###########################################display this when user have submitted, and enter the correct user and pass #########################
if (isset($_POST['submit'])) {
    $luname = $_POST['luname'];
    mysqli_real_escape_string($conn, $luname);
    $lpwd = md5($_POST['lpwd']);
    $sql = "select * from account where account_username='$luname' and account_password='$lpwd'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    # check if there is a recrod with the specifed select query, (user exist)
    if ($row['account_username'] != "") {
        $_SESSION['admin'] = $row['account_isAdmin']; // This will be used later to verify admin or no, so we change the view based on it
        $_SESSION['name'] = $luname; // This will be used later to get the image of the user in the main page
        $luname = $_POST['luname'];
        $lpwd = $_POST['lpwd'];
        $_SESSION['time']=time();
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
                        <h1 class="mt-3" style="text-align: center"><?php echo "Welcome" ?> <span style="color:rgb(216,172,124);"> <?php echo $GLOBALS['luname'] ?> </span> </h1>
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
        # pass/email is wrong, we set session failed to true and we refresh the page to show him error message instead. 
        $_SESSION['failed'] = 'true';
        header('location:Login.php');
    }
    #when the user haven't entered his crediantiales and pressed on submit, the normal page will be displayed
    ################################ display this when user haven't clicked submit OR has enter wrong uname/pass ################################
} else {
    ?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Login </title>
        <!--  Elena Favicon  -->
        <link rel="icon" type="image/x-icon" href="ELENA Cafe.jpg">
        <!-- CSS FILE -->
        <link rel="stylesheet" href="css/Register-style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            body {
                background: url(images/login.jpeg) no-repeat;
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>

    <body>



        <form action="" class="form" method="POST">
            <span></span>
            <span></span>
            <span></span>
            <span></span>

            <div class="form-inner">

                <h2>LOGIN</h2>
                <div class=" row">
                    <div class="col-sm-1  ">
                        <i class="fa fa-user pt-4 mr-5 pl-1" style="font-size: 40px; color: black;" aria-hidden="true"></i>
                    </div>
                    <div class="col-sm-10 ml-2 ">
                        <input type="text" class="input-elene" id="luname" name="luname" placeholder="User name">
                    </div>
                </div>
                <div class=" row">
                    <div class="col-sm-1 ">
                        <i class="fa fa-lock pt-4 pl-1" style="font-size: 40px; color: black;" aria-hidden="true"></i>
                    </div>
                    <div class="col-sm-10 ml-2">
                        <input type="password" class="input-elene" id="lpwd" name="lpwd" placeholder="password">
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-1"></div>
                    <input class="our-btn col-sm-11" type="submit" name="submit" value="Login" style="width: 250px; ;">
                </div>
                <div class="row">

                    <div class="col-sm-1"></div>
                    <a class="col-sm-11 p-0 m-0" href="index.php" style="width: 250px;text-decoration: none;">
                    <input class="our-btn" type ="button" name="Cancel" value="Cancel">
                    </a>
                </div>
                <!-- 
<div class=" text-center Just-A-Link ">
<a  class="text-decoration-none  " href="">Forgot Password?</a> 
</div> -->

                <div class=" text-center Just-A-Link  ">
                    <a class="text-decoration-none  " href="Register.php">Sign up now</a>
                </div>
                <!--                if the uer have enter the wrong credinatials this will be displayed to him-->
                <?php if ($_SESSION['failed'] == "true") {
                ?>
                    <div class=" text-center Just-A-Link  ">
                        <a class="text-decoration-none " style="color:red">Wrong Username / Password </a>
                    </div>
                <?php
                    $_SESSION['failed'] = "false";
                }
                ?>
            </div>
        </form>




    </body>

    </html>
<?php
}
?>