<?php
$isbn = "ISBN-13:978-06A1746971";
$trimIsbn = trim($isbn);
if(stripos("ISBN-13:",$isbn) >= 0 || stripos("ISBN-10", $isbn) >= 0){
    $reducedIsbn = str_replace("ISBN-13:", "", $trimIsbn);
    $reducedIsbn = str_replace("ISBN-10:","", $reducedIsbn);
}

$reducedIsbn = str_replace("-","",$reducedIsbn);
if(strlen($reducedIsbn) ==13 || strlen($reducedIsbn) == 10){
    if(is_numeric($reducedIsbn) == true){
        echo $reducedIsbn;
    }
    else{
        echo "Not ISBN Value";
    }
}
else{
    echo "Not ISBN Value";
}



?>
