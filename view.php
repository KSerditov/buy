<html>
	<head>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script type="text/javascript" src="./libs/jquery-3.2.0.js"></script>
	<script type="text/javascript">

		function strike(){		
			$(this).parent().find('.count').css({"color": "#e1dece", "border-bottom": "1px dashed #e1dece"});
			$(this).parent().find('.item').css({"color": "#e1dece", "border-bottom": "1px dashed #e1dece"});
		};

        $(document).ready(function(){
        	$('.item').on("click",strike);
        });

        $(document).ready(function(){
        	$('.count').on("click",strike);
        });

	</script>
		<title>
			Список покупок
		</title>
	</head>
	<body>
		<div class="section1">
<?php
include('config/config.php');

function mylog($msg){
    error_log(date("Y-m-d H:i:s")." | ".__FILE__." | ".$msg."\n", 3, LOG_PATH);
}

mylog(" Request content:\n".print_r($_REQUEST, true));

if(isset($_GET['v'])){
	$id = mysql_real_escape_string(trim($_GET['v']));
	mylog("Link is set: ".$id);
} else {
	mylog("Link is NOT set. Rerouting.");
	Header("Location: ".HOST."index.php");
	exit();
}

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("CALL buy_GetList(?)");
$stmt->bind_param("s", $id);

$stmt->execute();
$stmt->bind_result($name, $count);

$items = 0;

echo "<ol>";
echo "<div class=\"head_item\">Наименование</div><div class=\"head_count\">#</div>";

while($stmt->fetch()){
		mylog($id."#=".$items." item=".$name." count=".$count);
		$items++;
		echo "<li><div id=\"line".$items."\"><div class=\"item\">".$name."</div><div class=\"count\">".$count."</div></div></li>";
}

echo "</ol>";

$stmt->close();
$conn->close();

if( $items == 0 )
{
	mylog($id." No items returned from DB. Rerouting.");
	Header("Location: ".HOST."index.php");
	exit();
}

	mylog($id." Success.");

?>
		</div>
	</body>
</html>