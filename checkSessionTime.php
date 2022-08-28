<?php 
session_start();
if(isset($_SESSION['time']))
{
    if(time()-$_SESSION['time']>600){ //This will distory the session after 10 min of login
    session_destroy();
    header('location:index.php');
}


}

?>