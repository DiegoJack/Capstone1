<?php

function insertUserSQL($fn, $ln, $DOB, $city, $PN, $username, $password, $USA, $email, $UTID) {
  $connection = mysqli_connect("162.246.156.84","ubuntu","#6/eA5dj)%s6T#HU","CMPTCAP");
  $insertQuery = "INSERT INTO Users (first_name, last_name, DOB, city, PN, username, password, USA, email, UTID) VALUES ('$fn', '$ln', '$DOB', '$city', '$PN', '$username', '$password', '$USA', '$email', '$UTID')";
  $query_run = mysqli_query($connection, $insertQuery);

  $connection -> close();
}

function insertReportsSQL($R_Date, $R_Des, $URL, $P_Des, $P_Type, $Verified) {
  $connection = mysqli_connect("162.246.156.84","ubuntu","#6/eA5dj)%s6T#HU","CMPTCAP");
  $insertQuery = "INSERT INTO Reports (R_Date, R_Des, URL, P_Des, P_Type, Verified) VALUES ('$R_Date', '$R_Des', '$URL', '$P_Des','$P_Type', '$Verified')";
  $query_run = mysqli_query($connection, $insertQuery);

  $connection -> close();
}

function insertIncidentSQL($DateI, $RID, $ITID) {
  $connection = mysqli_connect("162.246.156.84","ubuntu","#6/eA5dj)%s6T#HU","CMPTCAP");
  $insertQuery = "INSERT INTO Incidents (DateI, RID, ITID) VALUES ('$DateI', '$RID', '$ITID')";
  $query_run = mysqli_query($connection, $insertQuery);

  $connection -> close();
}

function insertPeopleSQL($height, $age, $des, $gender) {
  $connection = mysqli_connect("162.246.156.84","ubuntu","#6/eA5dj)%s6T#HU","CMPTCAP");
  $insertQuery = "INSERT INTO People (Height, Age, Des, Gender) VALUES ('$height', '$age', '$des', '$gender')";
  $query_run = mysqli_query($connection, $insertQuery);

  $connection -> close();
}

function selectEPS_DataLocationSQL() {
  $connection = mysqli_connect("162.246.156.84","ubuntu","#6/eA5dj)%s6T#HU","CMPTCAP");
  $selectQuery = "SELECT DISTINCT `Neighbourhood Description (Occurrence)` from EPS_Data";
  $query_run = mysqli_query($connection, $selectQuery);

  $connection -> close();
}

function selectLocationSQL() {
  $connection = mysqli_connect("162.246.156.84","ubuntu","#6/eA5dj)%s6T#HU","CMPTCAP");
  $selectQuery = "SELECT * FROM Location";
  $query_run = mysqli_query($connection, $selectQuery);

  $connection -> close();
}

function selectEPS_DataIncidentSQL() {
  $connection = mysqli_connect("162.246.156.84","ubuntu","#6/eA5dj)%s6T#HU","CMPTCAP");
  $selectQuery = "SELECT DISTINCT `Occurence Violation Type Group` from EPS_Data";
  $query_run = mysqli_query($connection, $selectQuery);

  $connection -> close();
}

function selectIncidentSQL() {
  $connection = mysqli_connect("162.246.156.84","ubuntu","#6/eA5dj)%s6T#HU","CMPTCAP");
  $selectQuery = "SELECT * FROM Incidents";
  $query_run = mysqli_query($connection, $selectQuery);

  $connection -> close();
}

function selectAllEPS_DataSQL() {
  $connection = mysqli_connect("162.246.156.84","ubuntu","#6/eA5dj)%s6T#HU","CMPTCAP");
  $selectQuery = "SELECT DISTINCT `Neighbourhood Description (Occurrence)`, `Dates`, `Occurrences`, `Occurrence Violation Type Group`  FROM EPS_Data";
  $query_run = mysqli_query($connection, $selectQuery);

  $connection -> close();
}

function selectAllSQL() {
  $connection = mysqli_connect("162.246.156.84","ubuntu","#6/eA5dj)%s6T#HU","CMPTCAP");
  $selectQuery = "SELECT DISTINCT * FROM Incidents";
  $query_run = mysqli_query($connection, $selectQuery);

  $connection -> close();
}

switch($_POST['functioname']){

  case 'insertUserSQL':/* fn, ln, DOB, city, PN, username, pasword, usa, email, UTID              */
    $row = insertUserSQL($_POST['arguments'][0], $_POST['arguments'][1], $_POST['arguments'][2], $_POST['arguments'][3], $_POST['arguments'][4], $_POST['arguments'][5], $_POST['arguments'][6], $_POST['arguments'][7], $_POST['arguments'][8], $_POST['arguments'][9]);
    break;

  case 'insertReportsSQL':/* $R_Date, $R_Des, $URL, $P_Des, $P_Type, $Verified              */
    $row = insertReportsSQL($_POST['arguments'][0], $_POST['arguments'][1], $_POST['arguments'][2], $_POST['arguments'][3], $_POST['arguments'][4], $_POST['arguments'][5], $_POST['arguments'][6]);
    break;

  case 'insertIncidentSQL':/*$DateI, $RID, $ITID             */
    $row = insertIncidentSQL($_POST['arguments'][0], $_POST['arguments'][1], $_POST['arguments'][2]);
    break;

  case 'insertPeopleSQL':/* $height, $age, $des, $gender            */
    $row = insertPeopleSQL($_POST['arguments'][0], $_POST['arguments'][1], $_POST['arguments'][2], $_POST['arguments'][3]);
    break;

  case 'selectEPS_DataLocationSQL':
    $row = selectEPS_DataLocationSQL();
    break;

  case 'selectLocationSQL':
    $row = selectLocationSQL();
    break;

  case 'selectEPS_DataIncidentSQL':
    $row = selectEPS_DataIncidentSQL();
    break;

  case 'selectIncidentSQL':
    $row = selectIncidentSQL();
    break;

  case 'selectAllEPS_DataSQL':
    $row = selectAllEPS_DataSQL();
    break;

  case 'selectAllSQL':
    $row = selectAllSQL();
    break;

  echo  json_encode($row)
}


?>
