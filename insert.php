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
$table = $_POST["table"];
$values = $_POST["values"];
$q = "USE test;";
$res = $mysqli->query($q);
$query = "INSERT INTO " . $table . " VALUE (" ;
for($i = 0;$i < sizeof($values);$i++){
    if($i != sizeof($values) - 1){
        $query .= "'$values[$i]'"." , " ;
    }else{
        $query .= "'$values[$i]'".") ";
    }
} 
echo $query."</br>";
$res = $mysqli->query($query);
if(!$res){
    die("query failed" . $mysqli->error);
}else{
    $insert_log = "";
    $currentDateTime = date('Y-m-d H:i:s');
    $insert_log .= '[Timestamp: ' . $currentDateTime . "]\n" . "User <b>'admin'<\b> initiated an INSERT operation.Inserted the record in the <b>'$table'<\b> table.\n"."<b>Data<\b>: { ";
    for ($i = 0; $i < sizeof($values); $i++) {
            $insert_log .= "'$values[$i]', ";
    }
    $insert_log .= "}\n\n";
    $filePath = 'logs.txt';
    if (file_put_contents($filePath, $insert_log, FILE_APPEND) !== false) {
        // echo 'Data appended to file successfully.';
    } else {
        echo 'Error appending to file.';
    }
    echo $res;
}

?>