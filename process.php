<?php

// With this precision (microsecond) ID will looks like '2di2adajgq6h'

//$id = base_convert(microtime(false), 10, 36);

// With less precision (second) ID will looks like 'niu7pj'

$id = base_convert(time(), 10, 36);

for($i = 0; $i < count($_POST['item']); $i++){
    echo $_POST['item'][$i]." ".$_POST['count'][$i]."</br>";
}

echo "Link: ".$id;

?>