<?php
$user = 'root';
$password = '';
$database = 'test';
$servername = 'localhost:3306';
$mysqli = new mysqli(
    $servername,
    $user,
    $password,
    $database
);

if ($mysqli->connect_error) {
    die('Connect Error (' .
        $mysqli->connect_errno . ') ' .
        $mysqli->connect_error);
}
?>
<?php
// $col = "";
$table = $_GET["table"];
$db = "test";
$primary_col = [];
$q = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";
$res = $mysqli->query($q);
if(!$res){
    die("query failed" . $mysqli->error);
}else{
    $x = $res->fetch_assoc();
    $col = $x["Column_name"];
    $q = "Select $col FROM $table" ;
    $res = $mysqli->query($q);
    if(!$res){
        die("query failed" . $mysqli->error);
    }else{
        while ($x = $res->fetch_assoc()) {
            array_push($primary_col,$x[$col]);
        }
    }
    // print_r($foreign_col);
}
$jsonData = json_encode($primary_col);
header('Content-Type: application/json');
echo $jsonData;

