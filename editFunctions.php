<?php

require_once("../../config.php");
	
	function getSinglePlantData($edit_id){
    
        $database = "if16_mreintop";

	
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("SELECT plant, wateringInterval FROM flowers WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($plant, $wateringInterval);
		$stmt->execute();
		
		//tekitan objekti
		$plantFromDb = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$plantFromDb->plant = $plant;
			$plantFromDb->interval = $wateringInterval;
			
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $plantFromDb;
		
	}
	function deletePlant($id){
		
		$database = "if16_mreintop";

		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("UPDATE flowers SET deleted='yes' WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("s",$id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "kustutamine õnnestus!";
		}
		
		$stmt->close();
		$mysqli->close();
		
		
	}


	function updatePlant($id, $plant, $wateringInterval){
    	
        $database = "if16_mreintop";

		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("UPDATE flowers SET plant=?, wateringInterval=? WHERE id=?");
		$stmt->bind_param("ssi",$plant, $wateringInterval, $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	
?>
