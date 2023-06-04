<?php

require('sql_api_config.php');

$conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
$sqlstr = "SELECT * FROM users";
$sqldata = mysqli_query($conn, $sqlstr) or die("Error in Selecting " . mysqli_error($conn));
$emparray = array();

while($row = mysqli_fetch_assoc($sqldata))
{
    $emparray[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>
        <form style="display: flex; flex-flow: column;" method="POST" action="sql_api_insert.php">
            <b>Full Name</b>
            <input name="name" type="text" style="width:200px" required>
            <br>
            <b>Email</b>
            <input name="email" type="text" style="width:200px" required>
            <br>
            <b>Gander</b>
            <div style="width:200px" >
                <label>Male</label>
                <input name="gander" type="radio" value="Male" required>
            </div>
            <div style="width:200px" >
                <label>Female</label>
                <input name="gander" type="radio" value="Female" required>
            </div>
            <br>
            <input name="submit" type="submit" style="width:200px">
        </form>
    </div>
    <div style="margin-top:20px">
        <div style="display: flex; flex-flow: row; font-weight:bold">
            <div style="width:40px;">ID</div>
            <div style="width:150px;">Full Name</div>
            <div style="width:250px;">Email</div>
            <div style="width:50px;">Gander</div>
        </div>
        <br>

        <?php for($i=0 ; $i<count($emparray); $i++){
            echo '<div style="display: flex; flex-flow: row;">';

            echo 
            '<div style="width:40px;">' . $emparray[$i]['id'] . '</div>' .
            '<div style="width:150px;">' . $emparray[$i]['full_name'] . '</div>' .
            '<div style="width:250px;">' . $emparray[$i]['email'] . '</div>' .
            '<div style="width:50px;">' . $emparray[$i]['gander'] . '</div>';
            
            echo '</div>';
        } ?>
    </div>
</body>
</html>