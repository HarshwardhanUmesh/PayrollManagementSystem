<?php
// $user = 'root';
// $password = '';
// $database = 'test';
// $servername = 'localhost:3306';
// $mysqli = new mysqli(
//     $servername,
//     $user,
//     $password,
//     $database
// );

// if ($mysqli->connect_error) {
//     die('Connect Error (' .
//         $mysqli->connect_errno . ') ' .
//         $mysqli->connect_error);
// }
$mysqli = mysqli_init();
mysqli_ssl_set($mysqli,NULL,NULL, "DigiCertGlobalRootCA.crt.pem", NULL, NULL);
mysqli_real_connect($mysqli, 'dbms.mysql.database.azure.com', 'subodh', 'Lomdu@502', 'payrollmanagement', 3306, MYSQLI_CLIENT_SSL);
if (mysqli_connect_error()) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}
?>
<?php
// $col = "";
$table = $_GET["table"];
$db = "payrollmanagement";
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

