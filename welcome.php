<!doctype html>
<html>
<head>
<link rel="stylesheet" href="form.css">
</head>
<body>
<?php
    //Initialize a session 
    session_start(); 

    $_SESSION["username"]= "";
?>

<div class="body content">
    <div class="welcome">
        <div class="alert alert-success"><?php echo $_SESSION['message'];?></div>
        <img src="<?php echo $_SESSION['avatar'];?>"><br />

        Welcome <span class="user"><?php echo $_SESSION['username'];?></span>

        <?php
            $mysqli = new mysqli("localhost", "root", "", "accounts");
            //Select queries return a resultset
            $sql = "SELECT username, avatar FROM users";
            $result = $mysqli->query($sql); //$result = mysqli_result object
            //var_dump($result);
        ?>

        <div id='registered'>
            <span>All registered users:</span>
            <?php
            while($row = $result->fetch_assoc()){ //returns associative array of fetched row
                //echo '<pre>';
                //print_r($row);
                //echo '</pre>';
                echo "<div class='userlist'><span>$row[username]</span><br />";
                echo "<img src='$row[avatar]'></div>";
            }
            ?>  
        </div>
    </div>
</div>
</body>
</html>