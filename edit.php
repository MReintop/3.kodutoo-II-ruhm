<?php 
//edit.php
	require("functions.php");
	require("editFunctions.php");
	
	
	if (isset($_GET["deleted"])){
		
		deletePlant($_GET["id"]);
			header("Location: data.php");
			exit();
		
	}
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		updatePlant(cleanInput($_POST["id"]), cleanInput($_POST["plant"]), cleanInput($_POST["interval"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//saadan kaasa id
	
	//Kui pole id-d aadressireal, siis suunan
	if (!isset($_GET["id"])){
		header("Location:data.php");
		exit();
	}
	
	$p = getSinglePlantData($_GET["id"]);
	var_dump($p);
	
	


	
?>
<br><br>
<a href="data.php"> Tagasi </a>

<h2>Muuda kirjet</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="plant_name" >Taime nimi</label><br>
	<input id="plant_name" name="plant" type="text" value="<?php echo $p->plant;?>" ><br><br>
  	<label for="watering_interval" >Kastmisintervall</label><br>
	<input id="watering_interval" name="interval" type="text" value="<?php echo $p->interval;?>"><br><br>
  	
	<input type="submit" name="update" value="Salvesta">
	<br><br>
	
	
	
  </form>
  <br>
  <br>
  <a href="?id=<?=$_GET["id"];?>&deleted=true">Kustuta</a>
