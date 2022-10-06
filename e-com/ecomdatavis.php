<?php
 
$dataPoints = array(
	array("y"=> 10, "label"=> "Japan"),
	array("y"=> 20, "label"=> "USA"),
	array("y"=> 30, "label"=> "Ukraine"),
	array("y"=> 40, "label"=> "Albay"),
	array("y"=> 50, "label"=> "lehgazpi"),
	array("y"=> 60, "label"=> "Ph"),
	array("y"=> 70, "label"=> "Aldog"),

);

	$test=array();
	$count=0;
	$res=mysqli_query($conn,"SELECT * from products");
	while($row=mysqli_fetch_array($res))
	{
		$test[$count]["label"]=$row["product_category"];
		$test[$count]["y"]=$row["quantity"];
		$count = $count+1;
	}
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Average Expense Per Day  in Thai Baht"
	},
	subtitles: [{
		text: "Currency Used: Thai Baht (฿)"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "฿#,##0",
		dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 200px; width: 30%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>            