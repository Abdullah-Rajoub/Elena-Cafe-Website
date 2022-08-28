<?php
include('checkExstension.php');
include('connection.php');
function getExtension($menuPath)
{
    # an array of supported image extensions 
    $arrType = array("png", "jpeg", "svg", "webp", "jpg");
    #checks if the name of the file contains ., 
    # also returns the position of "." 
    if (!is_null(($pos = strpos($menuPath, ".")))) {
        # gets the extension--> thing after the "."
        $type =  substr($menuPath, $pos + 1);
        $arrlength = count($arrType);
        $isValid = false;
        #looping throw extensions array,
        # and checking if the type extracted matchs one of the extensions in extensions array
        for ($x = 0; $x < $arrlength; $x++) {
            if (strtolower($arrType[$x]) === $type)
                return strtolower($arrType[$x]);
        }
        return "";
    }
    #no extension added ??? 
    return "";
}
if (isset($_GET['menu_name'])) {
    echo "1212fwfefwewfeq";
    $menuName = mysqli_real_escape_string($conn, $_GET['menu_name']);
    #selecting the image with the specified name, coz name is primary key
    $sql = "SELECT * FROM menu where menu_name = '$menuName'";
    #running query and checking that there is no problems 
    $query = $conn->query($sql) or die(mysqli_error($conn));
    while ($row = mysqli_fetch_array($query)) {   #getting the image data from db
        $imageData = $row['menu_image'];
        $imagePath = $row['menu_path'];
    }
    #this just works, dont ask how please. 
    #if you delete the header, it prints gibrish (binary code ??) 

    $exstension = getExtension($imagePath);
    echo "1212";
    if ($exstension !== "") {
        header("content-type: image/" . $exstension);
        echo $imageData;
    } else {
        echo " invalid extension:";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <img src="showimage.php?menu_name=Lemond Cake" alt="">
</body>

</html>