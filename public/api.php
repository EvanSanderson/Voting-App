<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "root";
$password = "root";
$db = "votingapp";
$votes = array();
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT votes, name FROM Fruits";
$results = $conn->query($sql);
if ($results->num_rows > 0) {
    while($row = $results->fetch_assoc()){
        $votes[$row['name']] = array(
            'name' => $row['name'],
            'votes'=> (int)$row['votes']
        );
    }
} else {
    "No results found.";
}

if( $_SERVER['REQUEST_METHOD'] === 'POST'){
    updateVote($request);
} elseif( $_SERVER['REQUEST_METHOD'] === 'GET'){
    $json = json_encode($votes);
    echo $json;
};


?>