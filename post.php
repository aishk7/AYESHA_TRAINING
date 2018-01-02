<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ajax Assignment</title>
    <link href="bt.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <!--UI-->
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<style>
.a
{
float:left;
color:#450b06;
padding:37px;
height: 500px;
width:10%;

}
.b
{
float:right;
background-color:white;
color:#808000;
font-size: 25px;
font-weight:bold;
padding:10px;
width:80%;
}

body{
background-color:#A3A3A3;
}
.c
{
background-color:#5889bd;
}
h1
{
    margin-top:10px;
    border-radius:0px 25px 0px;
    background-color:#dddddd;
    color:#8B008B;
}
#anchor
{
   
    color:#450b06;
    font-weight: bold;
    font-size:20px;
}
textarea
{
    background-color:grey;
    color:pink;
    border-style:solid;
    border-color:;
}
#cl
{
    background-color:grey;
}

</style>
</head>
<body>

<?php


$name = $_GET['q'];
$post = $_GET['x'];
$date = date('Y-m-d H:i:s');



$servername = "localhost";
$username = "root";
$password = "root";
$dbname="mydatabase1";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

$sql = "INSERT INTO twall VALUES((SELECT user_id from tuser where Name='$name'), '". $GLOBALS['date'] ."', '". $GLOBALS['post'] ."');";
        $result = $conn->query($sql);
$sql = "SELECT posting_date, post FROM twall WHERE user_id=(SELECT User_id from tuser WHERE Name='". $GLOBALS['name'] ."')ORDER BY posting_date DESC";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br><div id='cl'>".$row["posting_date"]."<br/>".$row["post"]."</div><br>";
    }
} else {
    echo "no posts to display";
}
?>
</body>
</html>