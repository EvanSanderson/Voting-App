<?php 
require('env.php');
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}

$servername = "localhost";
// these need to be set for whatever local DB you are using
$username = $_ENV['db_user'];
$password = $_ENV['db_password'];

$db = "votingapp";
$votes = array();
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $new_votes = htmlspecialchars($_POST['votes']);
    $fruit = htmlspecialchars($_POST['fruit']);
    $sql = "UPDATE Fruits SET votes=".(int)$new_votes." WHERE name='".$fruit . "'";
    if($conn->query($sql) === TRUE){
        echo 'success';
    } else {
        echo $conn->error;
    };
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
    }
    $json = json_encode($votes);
    echo $json;
};

$conn->close();
?>