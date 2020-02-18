<?php
for($i=1; $i<=50; $i++){
    if($i == 2) {
        echo $i;
    }
    else if($i == 3){
        echo $i;
    }
    else if($i == 5){
        echo $i;
    }
    else if($i == 7){
        echo $i;
    }
    else if($i % 2 == 1 && $i % 3 != 0 && $i % 5 != 0 && $i % 7 != 0 && $i != 1){
        echo $i;
    }
}

?>