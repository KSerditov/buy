<?php
include('config/config.php');

function mylog($msg){
    error_log(date("Y-m-d H:i:s")." | ".__FILE__." | ".$msg."\n", 3, LOG_PATH);
}

$id = base_convert(time(), 10, 36);

mylog("Processing for link: ".$id);
mylog($id.": Request content:\n".print_r($_REQUEST, true));

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("CALL buy_AddNewLine(?,?,?)");

$stmt->bind_param("ssi", $id, $item, $cnt);
$arrItems = array_values($_POST['item']);
$arrCounts = array_values($_POST['count']);

for($i = 0; $i < count($arrItems); $i++){

    mylog($id.": item=".$arrItems[$i]." count=".$arrCounts[$i]);

    $item = $arrItems[$i];
    $cnt = $arrCounts[$i];
    $stmt->execute();
}

$stmt->close();
$conn->close();

mylog($id.": All lines processed.");

echo "<input type=\"text\" class=\"link\" value=\"".HOST."view.php?v=".$id."\" onclick=\"select()\" readonly/><p id=\"copyLink\">Копировать</p>";

?>