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
<?php
include('config/config.php');

if(isset($_GET['v'])){
	$id = $_GET['v'];
} else {
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
		$items++;
		echo "<li><div id=\"line".$items."\"><div class=\"item\">".$name."</div><div class=\"count\">".$count."</div></div></li>";
}

echo "</ol>";

$stmt->close();
$conn->close();

if( $items == 0 )
{
	Header("Location: ".HOST."index.php");
	exit();
}

?>

	</body>
</html>