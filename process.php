<?php

// With this precision (microsecond) ID will looks like '2di2adajgq6h'

//$id = base_convert(microtime(false), 10, 36);

// With less precision (second) ID will looks like 'niu7pj'

$id = base_convert(time(), 10, 36);

$servername = "localhost";
$username = "buy";
$password = "Enkata@2";
$dbname = "buy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("CALL buy_AddNewLine(?,?,?)");

$stmt->bind_param("ssi", $id, $item, $cnt);

for($i = 0; $i < count($_POST['item']); $i++){

    //run the store proc
    $item = $_POST['item'][$i];
    $cnt = $_POST['count'][$i];
    $stmt->execute();

}

$stmt->close();
$conn->close();

echo "<input type=\"text\" class=\"link\" value=\"http://192.168.56.132/buy/view.php?v=".$id."\" onclick=\"select()\" readonly/><p id=\"copyLink\">Копировать</p>";

?>