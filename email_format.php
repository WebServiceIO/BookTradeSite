<?php
email_format("test@cpp.edu");
function email_format($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        if(strstr($email,"@cpp.edu")){
            echo "valid email";
            return true;
        }
        else{
            echo "Not a valid email format";
            return false;
        }
    }
    else{
        echo "Not a valid email format";
        return false;
    }
}
?>
