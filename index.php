<?php

session_start();
$_SESSION["message"]= "";

//Connection to mysqli database and creates an object using new and stores in a variable called $mysqli
$mysqli= new mysqli("localhost","root","","accounts");
	
	//Returns true if the form has been submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		//two passwords are equal to each other and of the same type
		if($_POST["password"]=== $_POST["confirmpassword"]){
			
			//Escapes special characters so as to insert them into database
			$uName= $mysqli->real_escape_string($_POST["username"]);
			$email= $mysqli->real_escape_string($_POST["email"]);
			
			//Hashes our password for security purposes
			$pswad= md5($_POST["password"]);
			
			//$_FILES is a global variable for accessing files uploaded
			//avatar is the name of the file name from the input field
			//Create a folder called images for storing uploaded files
			$avatar= $mysqli->real_escape_string("images/" .$_FILES["avatar"]["name"]);
			
			//make sure file is an image
			//returns true if the file type is an image
			if(preg_match("!image!", $_FILES["avatar"]["type"])){
				
				//Returns true if the escaped string has been copied
				if(copy($_FILES["avatar"]["tmp_name"], $avatar)){
					
					//Perform the code below if all the ABOVE IF CONDITIONS ARE TRUE
					$_SESSION["username"]= $uName;
					$_SESSION["avatar"]= $avatar;
					
					$sql="INSERT INTO users(username, email, password, avatar)"
						. "VALUES('$uName','$email','$pswad','$avatar')";
						
					//if the query is suucessful, redirect to welome.php page
					if($mysqli->query($sql) == true){
						$_SESSION["message"]= "Registration successful! Added $uName to our database";
						header("location:welcome.php");
					}
					else{
						//Displays error messages
						$_SESSION["message"]= "Sorry, Failed to add a User to the database";
					}
					
				}
				else{
					$_SESSION["message"]= "User Could not be added to our database";
				}
			}
			else{
				$_SESSION["message"]= "Please Upload only JPEG, PNG, GIF or JPG images";
			}
		}
		else{
			$_SESSION["message"]= "Sorry, Passwords don't  match";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="form.css" type="text/css">
</head>
<div class="body-content">
  <div class="module">
	<!--Autocomplete(Specifies whether or not an input field should have autocomplete enabled,allows browser to predict the value),the default value is on-->
	<form action="index.php" method="post" enctype="multipart/form-data" autocomplete="off">
	
		<div class="alert alert-error"><?php echo $_SESSION['message'];?></div>
		<input type="text" placeholder="User Name" name="username" required />
		<input type="email" placeholder="Email" name="email" required />
		<input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
		<input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />
	
		
		<!--The accept attribute specifies the type of files that the server aceepts. It can only be used with <input type="file">
		DONT use this attribute as a validation tool.File uploads should be validated on the server
		To separate more than one value, separate the values witha comma eg <input accept="audio/*, video/*, image/*">-->
	
		<div class="avatar"><label>Select your avatar: </label><input type="file" name="avatar" accept="image/*" required /></div>
		<input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
	
	</form>

</div>
</div>
</html>
