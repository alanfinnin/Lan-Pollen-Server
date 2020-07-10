<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/agency.css">
</head>
<body>
<div class="center">
	<h1>Pollen Count</h1>

	<?php
	function getAmount($fileDate, $type) {
		$fileData = file_get_contents( "data.txt" );
		$treePollenFull = substr($fileData,strpos($fileData, $type));
		$treePollen = substr($treePollenFull, 0, strpos($treePollenFull,"}"));
		echo "<h2>" . $type . "</h3><br>";

		$treePollenTodayFull = substr($treePollen,strpos($treePollen,"{")+1);
		$treePollenToday = substr($treePollenTodayFull, 0, strpos($treePollenTodayFull,","));

		echo "<p class=\"today\">" . $treePollenToday . "<p>&nbsp;<p class=\"todayCircle\">o</p><br>";

		$treePollenTomorrowFull = substr($treePollen,strpos($treePollen,"Tomorrow"));
		$treePollenTomorrow = substr($treePollenTomorrowFull, 0, strpos($treePollenTomorrowFull,","));

		echo "<p class=\"tomorrow\">" . $treePollenTomorrow . "<p>&nbsp;<p class=\"tomorrowCircle\">o</p>";
	}

	$fileData = file_get_contents( "data.txt" );
	getAmount($fileData, "Tree Pollen");

	getAmount($fileData, "Grass Pollen");

	getAmount($fileData, "Ragweed Pollen");
	?>
	<script>
	var today = document.getElementsByClassName("today");
	var todayCircle = document.getElementsByClassName("todayCircle");
	var i;
	for (i = 0; i < today.length; i++) {
		if(today[i].innerHTML.toString().includes("High"))
			todayCircle[i].classList.add("high")
			
		else if(today[i].innerHTML.toString().includes("Moderate"))
			todayCircle[i].classList.add("moderate")
		
		else if(today[i].innerHTML.toString().includes("Low"))
			todayCircle[i].classList.add("low")
		else
			todayCircle[i].classList.add("none")	
	}

	var tomorrow = document.getElementsByClassName("tomorrow");
	var tomorrowCircle = document.getElementsByClassName("tomorrowCircle");
	for (i = 0; i < tomorrow.length; i++) {
		if(tomorrow[i].innerHTML.toString().includes("High"))
			tomorrowCircle[i].classList.add("high")
			
		else if(tomorrow[i].innerHTML.toString().includes("Moderate"))
			tomorrowCircle[i].classList.add("moderate")
		
		else if(tomorrow[i].innerHTML.toString().includes("Low"))
			tomorrowCircle[i].classList.add("low")
		else
			tomorrowCircle[i].classList.add("none")	
	}

	</script>
</div>
</body>
</html>