<html>
<head>
<title>Marriage Form</title>
<style>
	*{
		box-sizing:border-box;
	}
	body{
		margin:0;
		padding:0;
		font-family:arial;
	}
	form{
		padding:8px;
	}
	fieldset{
		background-color:#f2f2f2;
		
	}
	legend{
		font-weight:bold;
		font-size:30px;
	}
	label{
		display:inline-block;
		font-size:24px;
		margin:0px 5px;
		width:20%;
	}
	input,textarea{
		display:inline-block;
		font-size:20px;
		margin:10px 5px;
		padding:8px;
		width:40%;
	}
	span{
		color:red;
	}
	textarea{
		vertical-align:middle;
	}
	input[type='submit']{
		background-color:green;
		color:white;
		font-size:30px;
		cursor:pointer;
		outline:none;
	}
	input[type='submit']:hover{
		background-color:darkgreen;
	}
	div{
		font-size:24px;
		font-family:arial;
	}
</style>
</head>
<?php
	$err= $check ="";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	function casse($a){
		$a = strtolower($a);
		$b = ucwords($a);
		return $b;
	}
	echo "Please See Your Response Below";
	$Fname = $_POST['Fname'];
	$Fname = casse($Fname);
	$Lname = $_POST['Lname'];
	$Lname = casse($Lname);
	$Dob = $_POST['dob'];
	$Caste = $_POST['caste'];
	$Caste = casse($Caste);
	$Hobby = $_POST['hbby'];
	$hbby = str_replace(',',' ',$Hobby);
	$hbby = casse($hbby);
	$Hobby = str_replace(" ",",",$hbby);
	$Education = $_POST['edu'];
	$Education = casse($Education);
	$Ocupation = $_POST['ocupation'];
	$Ocupation = casse($Ocupation);
	$Contact = $_POST['contact'];
	if(preg_match_all("/^[0-9]{10}$/",$Contact)==0){
		$error = "Unexpected INPUT";
	}
	$Email = $_POST['email'];
	$Address = $_POST['Address'];
	$Address = casse($Address);
	$Faname = $_POST['Faname'];
	$Faname = casse($Faname);
	$Moname = $_POST['Moname'];
	$Moname = casse($Moname);
	
	$nm = "Forms/".$Fname."(".$Dob.")".".txt";
	$check = file_exists($nm);
	if($check == 1){
		$err = "NAME Already TAKEN!!";
	}
	}
?>
<body>

	<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
		<fieldset>
			<legend>Personal Information</legend>
			<label for="fn">First Name : </label>
			<input type="text" id="fn" name="Fname" required><span><?php echo $err; ?></span><br/>
			<br/>
			<label for="ln">Last Name : </label>
			<input type="text" id="ln" name="Lname" required><br/><br/>
			<label for="dob">Date Of Birth : </label>
			<input type="date" name="dob" id="dob" max="2001-12-31" required><br/><br/>
			<label for="caste">Caste : </label>
			<input type="text" name="caste" id="caste" required><br/><br/>
			<label for="hbby">Hobbies : </label>
			<input type="text" name="hbby" id="hbby" required><br/><br/>
			<label for="edu">Education Qualification : </label>
			<input type="text" name="edu" id="edu" required><br/><br/>
			<label for="ocu">Ocupation : </label>
			<textarea  name="ocupation" id="ocu" required></textarea><br/><br/>
			<label for="cnt">Contact : </label>
			<input type="text" name="contact" id="cnt" required><br/><br/>
			<label for="email">Email : </label>
			<input type="email" name="email" id="email" required><br/><br/>
			<label for="add">Address : </label>
			<textarea  name="Address" id="add"></textarea required><br/><br/>
			<label for="faname">Father's Name : </label>
			<input type="text" id="faname" name="Faname" required><br/><br/>
			<label for="Moname">Mother's Name : </label>
			<input type="text" id="Moname" name="Moname" required><br/><br/>
			<input type="submit"  value="SUBMIT">
		</fieldset>
	</form>

</body>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$nm = "Forms/".$Fname."(".$Dob.")".".txt";
	
	$check = file_exists($nm);
	if($check == 1){
		$err = "NAME Already TAKEN!!";
	}
	else{
	$NewFile = fopen($nm,'w');
	$heading = "\t\t\t\tBIO DATA.".PHP_EOL .PHP_EOL .PHP_EOL;
	fwrite($NewFile,$heading);
	fwrite($NewFile,"PERSONAL INFORMATION : ".PHP_EOL .PHP_EOL);
	fwrite($NewFile,"Full Name : \t\t".$Fname." ".$Faname." ".$Lname.PHP_EOL .PHP_EOL);
	fwrite($NewFile,"Date Of Birth : \t\t".$Dob.PHP_EOL .PHP_EOL);
	fwrite($NewFile,"Caste : \t\t\t".$Caste.PHP_EOL .PHP_EOL);
	fwrite($NewFile,"Hobbies : \t\t\t".$Hobby.PHP_EOL .PHP_EOL);
	fwrite($NewFile,"Contact Number : \t\t".$Contact.PHP_EOL .PHP_EOL);
	fwrite($NewFile,"Email Address : \t\t".$Email.PHP_EOL .PHP_EOL .PHP_EOL);
	fwrite($NewFile,"EDUCATIONAL INFORMATION : ".PHP_EOL .PHP_EOL);
	fwrite($NewFile,"Education Qualification : \t".$Education.PHP_EOL .PHP_EOL);
	fwrite($NewFile,"Ocupation : \t\t".$Ocupation.PHP_EOL .PHP_EOL .PHP_EOL);
	fwrite($NewFile,"FAMILY INFORMATION : ".PHP_EOL .PHP_EOL);
	fwrite($NewFile,"Father's Name : \t\t".$Faname.PHP_EOL .PHP_EOL);
	fwrite($NewFile,"Mother's Name : \t\t".$Moname.PHP_EOL .PHP_EOL);
	fwrite($NewFile,"Address : \t\t\t".$Address.PHP_EOL .PHP_EOL);
	fclose($NewFile);
	echo "<h2>YOUR RESPONSE</h2><br/><br/>";
	$response=fopen($nm,'r') or die("UNABLE TO FIND");
	while(!feof($response)){
		echo "<div>".fgets($response)."</div><br/>";
	}
	fclose($response);
	}	
	
}
?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$html='
<html>
<style>
	*{
		box-sizing:border-box;
	}
	body{
		margin:0;
		padding:0;
		font-family:arial;
	}
	form{
		padding:8px;
	}
	fieldset{
		background-color:#f2f2f2;
		
	}
	legend{
		font-weight:bold;
		font-size:30px;
	}
	label{
		display:inline-block;
		font-size:24px;
		margin:0px 5px;
		width:20%;
	}
	input,textarea{
		display:inline-block;
		font-size:20px;
		margin:10px 5px;
		padding:8px;
		width:40%;
	}
	span{
		color:red;
	}
	textarea{
		vertical-align:middle;
	}
	input[type="submit"]{
		background-color:green;
		color:white;
		font-size:30px;
		cursor:pointer;
		outline:none;
	}
	input[type="submit"]:hover{
		background-color:darkgreen;
	}
	div{
		font-size:24px;
		font-family:arial;
	}
</style>
</head>
<body>
	<form >
		<fieldset>
			<legend>Personal Information</legend>
			<label for="fn">First Name : </label>
			<input type="text" id="fn" name="Fname" value="'.$Fname.'" disabled ><br/><br/>
			<label for="ln">Last Name : </label>
			<input type="text" id="ln" name="Lname" disabled value="'.$Lname.'"><br/><br/>
			<label for="dob">Date Of Birth : </label>
			<input type="date" name="dob" id="dob" max="2001-12-31" disabled value="'.$Dob.'"><br/><br/>
			<label for="caste">Caste : </label>
			<input type="text" name="caste" id="caste" disabled value="'.$Caste.'"><br/><br/>
			<label for="hbby">Hobbies : </label>
			<input type="text" name="hbby" id="hbby" disabled value="'.$Hobby.'"><br/><br/>
			<label for="edu">Education Qualification : </label>
			<input type="text" name="edu" id="edu" disabled value="'. $Education.'"><br/><br/>
			<label for="ocu">Ocupation : </label>
			<textarea  name="ocupation" id="ocu" disabled >'.$Ocupation.'</textarea><br/><br/>
			<label for="cnt">Contact : </label>
			<input type="text" name="contact" id="cnt" disabled value="'.$Contact.'"><br/><br/>
			<label for="email">Email : </label>
			<input type="email" name="email" id="email" disabled value=" '.$Email.'"><br/><br/>
			<label for="add">Address : </label>
			<textarea  name="Address" id="add" disabled  >'.$Address.'</textarea ><br/><br/>
			<label for="faname">Fathers Name : </label>
			<input type="text" id="faname" name="Faname" disabled value=" '.$Faname.'"><br/><br/>
			<label for="Moname">Mothers Name : </label>
			<input type="text" id="Moname" name="Moname" disabled value=" '.$Moname.'"><br/><br/>
		</fieldset>
	</form>
</body>
</html>';
	$file = fopen('file.html','w');
	fwrite($file,$html);
	fclose($file);
	}
?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
			include("../vendor/php/lib/GrabzItClient.php");
			include("../vendor/php/config.php");
			function useCallbackHandler($grabzItHandlerUrl)
			{
				$serverAddr = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '';
				$localAddr = isset($_SERVER['LOCAL_ADDR']) ? $_SERVER['LOCAL_ADDR'] : '';
				return $serverAddr != '::1' && $localAddr != '::1' && $serverAddr != '127.0.0.1' && $localAddr != '127.0.0.1' && filter_var($grabzItHandlerUrl, FILTER_VALIDATE_URL) !== FALSE;
			}
			$grabzIt = new \GrabzIt\GrabzItClient($grabzItApplicationKey, $grabzItApplicationSecret);
			$fullname ="pdfs/".$Fname."(".$Dob.")".".pdf";
			$onlyname =$Fname."(".$Dob.")".".pdf";
			$grabzIt->HTMLToPDF($html);
			$grabzIt->SaveTo($fullname);
			$dir=opendir('pdfs');
			$v="";
			if($dir){
				while(($entry=readdir($dir)) !== false){
					if($entry!=="." && $entry !==".."){
						$v.="<a href='".$fullname."'>".$onlyname."</a> <br/>";
						break;
					}
				}
			}
			echo "<h2>PDF File : </h2>".$v;
}
?>
</html>