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
color:black;
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
    border-style:inset;
    border-width:10px; 
}
#cl
{
    border-style:outset;
    background-color:grey;
    color:#450b06;
        border-width:10px; 

}

</style>
<script>
        function post1(name) {
            
            var str = document.forms["myForm"]["posts"].value;
            
            

            if (window.XMLHttpRequest) {
    
              xmlhttp=new XMLHttpRequest();
              } 
              xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                  document.getElementById("txtHint").innerHTML=this.responseText;
                }
              }
              xmlhttp.open("GET","post.php?q="+name+"&x="+str,true);
              xmlhttp.send();
            }

              
        
    
    
</script>  

</head>
<body>
<div class="c">
<h1><center>Welcome <?php echo $_GET["name"]; ?></center></h1><br>
</div>
<div>
<div style="float:left" class="a">
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname="mydatabase1";
$name=$_GET["name"];
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

$sql = "select name from tuser where user_id in(select friend_id from tfriends where User_id=(SELECT User_id FROM tuser where name='$name'))";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo"<h4>FRIENDS</h4>";
    while($row = $result->fetch_assoc()) {
        echo "<br><a href='welcome.php?name=".$row["name"]."'method='get' id='anchor'> " . $row["name"]."<a><br>";
    }
} else {
    echo "no friends";
}


?>

</div>
<div class="b">
<form   method="post" name="myForm">
<textarea rows=10 cols=80 name="posts">post here</textarea>
<button type="button" class="btn" id="id"  name="submit" onclick="post1('<?php echo $GLOBALS['name']  ?>')">Post</button>
</form>
<div id="txtHint"> 


<?php 
$sql = "SELECT post,posting_date from twall where user_id=(SELECT user_id from tuser where name='$name') order by posting_date desc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br><div id='cl'><p style='font-size:20px;'>".$row["posting_date"]."<p><br/>".$row["post"]."</div><br>";
    }
} else {
    echo "no posts to display";
}

$conn->close();
?></div>
</div>
</div>
</body>
</html>
