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
$table = $_GET["table"];
$db = "test";
$foreign_col = [];
$q = "select table_name,column_name,referenced_table_name,referenced_column_name from information_schema.key_column_usage where referenced_table_name is not null and table_schema = 'test' and table_name = "."'$table'";
$res = $mysqli->query($q);
if(!$res){
    die("query failed" . $mysqli->error);
}else{
    while ($x = $res->fetch_assoc()) {
        $column_name = $x['column_name'];
        $data = array(
            // 'column_name' => $x['column_name'],
            'referenced_table_name' =>$x["referenced_table_name"],
            'referenced_column_name' => $x["referenced_column_name"]
        );        
        $q = "SELECT ".$data['referenced_column_name'] ." FROM ".$data['referenced_table_name'];
        $result = $mysqli->query($q);
        if(!$res){
            die("query failed" . $mysqli->error);
        }else{
            $foreign = [];
            while ($x = $result->fetch_row()) {
                array_push($foreign,$x[0]);
            }
            $data += ['values' => $foreign];
        }
        $foreign_col += [$column_name => $data];
    }
    // print_r($foreign_col);
}
$jsonData = json_encode($foreign_col);
header('Content-Type: application/json');
echo $jsonData;

