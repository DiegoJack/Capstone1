var map;
var markers = [];
//var crimeList = [];

function initMap(){
	var location = {lat: 53.544, lng: -113.491};
	map = new google.maps.Map(document.getElementById("map"), {
		zoom: 11,
		center: location
	});
}
//On Page refresh
$(document).ready(function(){

  //Setting filters for location Pins
  var row = [];
  $.ajax({
      type: "POST",
      url: 'sql.php',
      data: {functionname: 'selectEPS_DataLocationSQL'},//, arguments: []},

      success: function (result) {
	var response = JSON.parse(result);
        for(key in response){
		var comboBox = document.getElementById("location");
		var option = document.createElement("option");
		option.text = response[key];
		comboBox.add(option);
        }
      }
  });

  function addingOptions(item, index) {
    var x = document.getElementById("location");
    var option = document.createElement("option");
    option.text = row[index];
    x.add(option);
  }


    //initializes the map
    initMap();
    var gps = [];
	$.ajax({
	type: "POST",
	url: 'sql.php',
	//data: {functionname: 'selectEPS_DataLongLatSQL'},//, arguments: []},
	data: {functionname: 'selectInfoSQL'},// arguments: [NB]},
	success: function (result2) {
		//JSON.stringify(result2);
		var response2 = JSON.parse(result2);
		for (key2 in response2){
			//console.log(response2[key2]);
			gps.push(response2[key2]);		
			//console.log(response2[key2]);
		}

		//var txt = "<h1>hello world</h1>";
		for (x in gps){
			//console.log(gps[x]);
			var lat1 = parseFloat(gps[x][0]);
			var lng1 = parseFloat(gps[x][1]);
			//console.log(lng);
			//makeInfo(lng1, lat1, x);

			//creating a string for the content
			var windowCont2 = "<h1>"+gps[x][3]+"</h1>"+
				"<div>Neighborhood: " + gps[x][2] + "</div>"+
				"<div>Incident happened on: "+gps[x][4]+"</div>";

			//var windowCont = ("Incident happened on: " + gps[x][4] + "\n"+
			//	"Neighborhood: " + gps[x][2] + "\n"+
			//	"Type of Crime: "+gps[x][3]+"\n");

			var loc = {lat: lng1, lng: lat1};
			var marker = new google.maps.Marker({
				position: loc,  
				map: map
			});

			markers.push(marker);


			var infoWindow = new google.maps.InfoWindow({});

		
			google.maps.event.addListener(marker, 'click', function(content){
				return function(){
					infoWindow.setContent(content);
					infoWindow.open(map, this);
				}
			} (windowCont2)  );

		

		}
	}
  });
});


function setMapOnAll(map){
	for (let i = 0; i < markers.length; i++){
		markers[i].setMap(map);
	}
}

function deleteMarker(){
	setMapOnAll(null);
	markers = [];
}

function isChecked(){

	var assaultCheck = document.getElementById("assault");
        var BreakEnterCheck = document.getElementById("breakAndEnter");
        var homicideCheck = document.getElementById("homicide");
        var robberyCheck = document.getElementById("robbery");
        var stalking = document.getElementById("Stalking/Harassment");
        var theftofVehicleCheck = document.getElementById("theftOfVehicle");
        var theftfromVehicleCheck = document.getElementById("theftFromVehicle");
	var hate = document.getElementById("hateCrime");
	var arson = document.getElementById("arson");
	var fraud = document.getElementById("fraud");
        var susActivity = document.getElementById("suspiciousActivity");	
	
	var crimeList = [];
	

	//change this deoending on what is clicked
	if (assaultCheck.checked == true) {
		crimeList.push("4"); //incident type 4 Assault
	}
	if (BreakEnterCheck.checked == true) {
		crimeList.push("5"); //incident Type 5 Break and Enter
	}
	if (homicideCheck.checked == true) {
		crimeList.push("0"); // incident type 0 homicide
        }
	if (robberyCheck.checked == true) {
                crimeList.push("2");// incident type 2 robbery
        }
	if (stalking.checked == true) {
                crimeList.push("7");// incident type 7 stalking
	}
	if (theftofVehicleCheck.checked == true) {
                crimeList.push("1");// incident type 1 theft of vehicle
        }
        if (theftfromVehicleCheck.checked == true) {
                crimeList.push("3");// incident type 3 theft from vehicle
	}
	if (susActivity.checked == true) {
                crimeList.push("6");// incident type 6 suspicious activity
	}
	if (arson.checked == true) {
                crimeList.push("8");// incident type 8 arson
	}
        if (fraud.checked == true) {
                crimeList.push("9");// incident type 9 fraud
        }
        if (hate.checked == true) {
                crimeList.push("10");// incident type 10 hate crime
	}
	else{
                //console.log("if this runs ait's after many things were turned off");
        }
	//console.log(crimeList);
	
	return crimeList;
}

function datesClicked(){
	var dates = [];

	var startDateFilter = document.getElementById("startDate");
	var start = startDateFilter.value.replace("/","-");
	var startDate = start.replace("/","-");
	dates.push(startDate);

	var endDateFilter = document.getElementById("endDate");
	var end = endDateFilter.value.replace("/","-");
	var endDate = end.replace("/","-");
	dates.push(endDate);

	return dates;
}

function locationPicked(){
	
	var value = document.getElementById("location");
	var NB = value.options[value.selectedIndex].value;
	if (NB == "ALL"){
		return;
	}
	else{
		return NB;
	}
	//return NB;
}


function neighborhoodAjax(){
	//deals with one ajax call
}

function dateAjax(){
	//deals with one ajax call
}

function incidentAjax(){
	//deals with one ajax call
}


function twoAjax(){

}

function threeAjax(){

}

function buttonClicked(){
	//take pins out
	deleteMarker(); // should delete all the markers on the map....hopfully	



	/*Important:
	 *Im stuck on how to get all the ajax to return what we need beacuse this screws alot of the conditions for mySQl
	 *
	 *As of right now in this function I am only returning the filter for location 
	 *where Nb is the neighborhood passed and it is returning the lat and long as above
	 *
	 *
	 *
	 *
	 * Psedocode:
	 *
	 * 	if dates and crimeList == Null:
	 * 		call neighborhood ajax
	 * 	else if dates !== null and other two are null
	 * 		call date ajax
	 * 		inside date ajax have more ifs thn check if null or not
	 * 	else if crime list is not null but other two are
	 * 		call crime list ajax
	 * 		inside said function
	 * 			more if statements that check which crime is called and so on
	 * 	
	 * 	then repeat but with two not null
	 * 	
	 * 	ad then one more time with 3 of them not null
	 *
	 * 	TOO MANY IFS  HELPPP!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!    :(
	 * 			
	*/
	var crimeList = [];
	var NB;
	var dates = [];
	var allGPS = [];

	idList = isChecked();
	NB = locationPicked();
	dates = datesClicked();

	//This is where itgets messy
	////every if statement is checking is the list above are null or not
	
	$.ajax({
		type: "POST",	
		url: 'sql.php',
		data: {functionname: 'selectLocationFilterSQL', arguments: [NB]},
		success: function (result3) {		                
			var response3 = JSON.parse(result3);                               
			for (key3 in response3){
				allGPS.push(response3[key3]);
				console.log(response3[key3]);
			}
		}
	});
}



