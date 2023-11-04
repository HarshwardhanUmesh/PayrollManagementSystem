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
$table = $_POST["table"];
$attribute = $_POST["attribute"];
$value = $_POST["value"];
$q = "USE payrollmanagement;";
$res = $mysqli->query($q);
$query = "DELETE FROM " . $table . " WHERE ";
for ($i = 0; $i < sizeof($attribute); $i++) {
    $query .= ($attribute[$i] . "=" . "'$value[$i]'" . " AND ");
    if ($i == sizeof($attribute) - 1) {
        $query .= ($attribute[$i] . "=" . "'$value[$i]'" . ";");
    }
}
$res = $mysqli->query($query);
if (!$res) {
    die("query failed" . $mysqli->error);
} else {
    $delete_log = "";
    $currentDateTime = date('Y-m-d H:i:s');
    $delete_log .= '[Timestamp: ' . $currentDateTime . "]\n" . "User <b>'admin'<\b> initiated an DELETE operation.Deleted a record from the <b>'$table'<\b> table.\n" . "<b>Data<\b>: { ";
    for ($i = 0; $i < sizeof($attribute); $i++) {
        $update_log .= $attribute[$i] . ':' . $value[$i] . ", ";
    }
    $delete_log .= "}\n\n";
    $filePath = 'logs.txt';
    if (file_put_contents($filePath, $delete_log, FILE_APPEND) !== false) {
        // echo 'Data appended to file successfully.';
    } else {
        echo 'Error appending to file.';
    }
    echo $res;
}

?>