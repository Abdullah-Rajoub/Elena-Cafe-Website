<?php
function checkExtension($menuName)
{
    # an array of supported image extensions 
    $arrType = array("png", "jpeg", "svg", "webp", "jpg");
    #checks if the name of the file contains ., 
    # also returns the position of "." 
    #example image.png
    if (!is_null(($pos = strpos($menuName, ".")))) {
        # gets the extension--> thing after the "."
        $type =  substr($menuName, $pos + 1);
        $arrlength = count($arrType);
        $isValid = false;
        #looping throw extensions array,
        # and checking if the type extracted matchs one of the extensions in extensions array
        for ($x = 0; $x < $arrlength; $x++) {
            if (strtolower($arrType[$x]) === $type)
                $isValid = true;
        }
        #check if the extension was valid or not
        if ($isValid) {
            return "valid";
        } else {
            return "Please choose an image";
        }
    }
}
