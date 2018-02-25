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

if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fruit']) && isset($_POST['votes'])){
    $sql = "UPDATE Fruits SET votes=".(int)$votes." WHERE name='".$fruit . "'";
    $conn->query($sql);
} elseif( $_SERVER['REQUEST_METHOD'] === 'GET'){
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
    $json = json_encode($votes);
    echo $json;
};

$conn->close();
?>