<?php
include_once('connection.php');
function exist($menuName)
{
    $sql = "select * from menu where menu_name ='$menuName'";
    $query = $GLOBALS['conn']->query($sql) or die(mysqli_error($GLOBALS['conn']));
    if (mysqli_num_rows($query) > 0) {
        return true;
    } else {
        return false;
    }
}
