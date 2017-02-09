<!DOCTYPE html>
<html>
<head>
	<title>Any Co. | Login </title>
	<link rel = "stylesheet" type = "text/css" href = "style.css">

</head>
<body>
	<h1 align="center">LOGIN</h1>

<?php
	


	function ui_print_header($title)
	{
		$title = htmlentities($title);
		echo <<<END
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01/EN" "http://www.w3.org/TR/html4/strict.dtd">
		<html>
		<head>
			<meta http-equiv = "Content-Type" content = "text/html; charset=ISO-8859-1">
			<link rel = "stylesheet" type = "text/css" href = "style.css">
			<title>Any Co.: $title</title>
		</head>
		<body>
		<h1>$title</h1>
		</body>
		</html>
END;
	}

	function ui_print_footer($date){
		$date = htmlentities($date);
		echo <<<END
		<div class = "footer">
			<div class = "date"> $date </div>
			<div class = "company"> Any Co. </div>
		</div>
END;
}



	

?>

		<form method="post" action="#">
    			<center>
    		<input type="text" name="username" placeholder="Enter Username" /><br /><br>
    		<input type="password" name="password" placeholder="Enter Password"/><br /><br>
  		    <input type="submit" name="submit" value="Login" /><br /><br>
   				 <center>
  		</form><br>

		<?php
  $c = oci_connect("hr", "hr", "localhost/XE");

  if (!$c){
    $e = oci_error();
    trigger_error('Could not connect to database: ' . $e['message'], E_USER_ERROR);
  }

  
    if(isset($_POST['submit'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];

  $s = oci_parse($c, "Select * From Employees Where EMPLOYEE_ID ='" . $username . "' and EMAIL ='" . $password ."'");
  if(!$s){
    $e = oci_error($c);
    trigger_error('Could not parse statement: ' . $e['message'], E_USER_ERROR);
  }

  $r = oci_execute($s);
  if(!$r){
    $e = oci_error($c);
    trigger_error('Could not execute statement: ' . $e['message'], E_USER_ERROR);
  }

  $row = oci_fetch_array($s);

  $a = oci_num_rows($s);
  if($a > 0){
    header('Location:anyco.php');
  } else {
  	echo "Incorrect Username/ Password";
  }
}
ui_print_footer(date('Y-m-d H:is:'));
?>


</body>
</html>