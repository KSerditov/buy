<html>
	<head>
		<title>
			Список покупок
		</title>
	</head>
	<body>
<?php

if(isset($_GET['v'])){

	$id = $_GET['v'];

	echo "<p>Id to display: ".$id."</p>";
} else {
	Header("Location: http://localhost/buy/index.php");
	exit();
}

?>
	</body>
</html>