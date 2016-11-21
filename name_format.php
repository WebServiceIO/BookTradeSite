<?php
name_format("test");
function name_format($name){
    if(strlen($name) > 2){
        $only_alphabet = ctype_alpha($name);
        if($only_alphabet){
            echo "Valid";
            return true;
        }
        else{
            echo "Invalid Characters";
            return false;
        }
    }
    else{
        echo "Must be longer than 2 characters.";
        return false;
    }
}
?>
