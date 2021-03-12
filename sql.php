<?php
$servername = "localhost";
$username = "user";
$password = 'G3%DrhG?3tR"gJM5';
$dbname = 'CMPTCAP';

$array=[];


//Not useed 
function ischeckedSQL($crimeList) {
	$connection = mysqli_connect('localhost','user','G3%DrhG?3tR"gJM5','CMPTCAP');

  	$selectQuery = "SELECT DISTINCT `Neighbourhood Description (Occurrence)` from EPS_Data";
  	$query_run = mysqli_query($connection, $selectQuery);

  	if($query_run->num_rows > 0){
		while($row = $query_run->fetch_assoc()){
			  $array[] = $row["Neighbourhood Description (Occurrence)"];
	  	}
  	} else {
  		echo "0";
 	 }
  	$connection -> close();
  	echo json_encode($array);
}



//For the location combobox
function selectEPS_DataLocationSQL() {
  	$connection = mysqli_connect('localhost','user','G3%DrhG?3tR"gJM5','CMPTCAP');
  	$selectQuery = "SELECT DISTINCT `Neighbourhood Description (Occurrence)` from EPS_Data";
  	$query_run = mysqli_query($connection, $selectQuery);

  	if($query_run->num_rows > 0){
		while($row = $query_run->fetch_assoc()){
			  $array[] = $row["Neighbourhood Description (Occurrence)"];
	  	}
  	} else {
  		echo "0";
 	 }
  	$connection -> close();
  	echo json_encode($array);
}

//New additions for filters
//filter by location
function selectLocationFilterSQL($NB) {
	$connection = mysqli_connect('localhost','user','G3%DrhG?3tR"gJM5','CMPTCAP');
	$selectQuery = "select `latitude`, `longitude`, `Neighbourhood Description (Occurrence)`, `Name`, `Dates`, `Occurrences` from EPS_Data, Incident_Type where `Dates` > '2019-10-01' and `Neighbourhood Description (Occurrence)` = '$NB' and EPS_Data.`ITID` = Incident_Type.`ITID`";
	$query_run = mysqli_query($connection, $selectQuery);

	if($query_run->num_rows > 0){
		while($row = $query_run->fetch_assoc()){
			$array[] = array($row["longitude"],$row["latitude"],$row["Neighbourhood Description (Occurrence)"],$row["Name"],$row["Dates"],$row["Occurrence"]);
		}
	} else {
		echo "0";									     }
	$connection -> close();
	echo json_encode($array);
}

//filter for dates
function selectDateFilterSQL($date1, $date2) {
	$connection = mysqli_connect('localhost','user','G3%DrhG?3tR"gJM5','CMPTCAP');
	$selectQuery = "SELECT `latitude`,`longitude`, `Dates` from EPS_Data where `Dates` > '$date1' and `Dates` < '$date2'";
	$query_run = mysqli_query($connection, $selectQuery);

	if($query_run->num_rows > 0){
		while($row = $query_run->fetch_assoc()){
			$array[] = array($row["longitude"],$row["latitude"]);
		}
	} else {
		echo "0";									     }
	$connection -> close();
	echo json_encode($array);
}

//filter for crimes
//
//display information on pins

function selectInfoSQL() {
	$connection = mysqli_connect('localhost','user','G3%DrhG?3tR"gJM5','CMPTCAP');
	$selectQuery = "select `latitude`, `longitude`, `Neighbourhood Description (Occurrence)`, `Name`, `Dates`, `Occurrences` from EPS_Data, Incident_Type where `Dates` > '2019-10-01' and EPS_Data.`ITID` = Incident_Type.`ITID`";

	$query_run = mysqli_query($connection, $selectQuery);

	if($query_run->num_rows > 0){
		while($row = $query_run->fetch_assoc()){
			$array[] = array($row["longitude"],$row["latitude"],$row["Neighbourhood Description (Occurrence)"],$row["Name"],$row["Dates"],$row["Occurrences"]);
		}
	} else {
		echo "0";									     }
	$connection -> close();
	echo json_encode($array);
}





switch($_POST['functionname']){

  	case 'selectEPS_DataLocationSQL':
    		selectEPS_DataLocationSQL();
    	break;

  	case 'selectEPS_DataLongLatSQL':
    		selectEPS_DataLongLatSQL();
    	break;

  	case 'selectLocationSQL':
    		selectLocationSQL();
    	break;

  	case 'selectEPS_DataIncidentSQL':
    		selectEPS_DataIncidentSQL();
    	break;

  	case 'selectIncidentSQL':
    		selectIncidentSQL();
    	break;

  	case 'selectAllEPS_DataSQL':
    		selectAllEPS_DataSQL();
   	 break;

  	case 'selectAllSQL':
    		selectAllSQL();
    	break;

	case 'selectLocationFilterSQL':
		selectLocationFilterSQL($_POST['arguments'][0]);
	break;

	case 'selectInfoSQL':
		selectInfoSQL();
	break;

  	default:
    		echo json_encode("Problem");
    	break;

}

?>
