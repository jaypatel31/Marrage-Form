<html>
<head>
	<title>WORD</title>
	<style>
		h1{
			color:green;
		}
		.false{
			color:red;
		}
		label{
			font-size:20px;
			font-weight:bold;
		}
		div{
			font-size:18px;
		}
	</style>
</head>

<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
	/* $file= $_FILES['filename'];
	$a=1;
	$type = $file['type'];
	$tmp_location =$file['tmp_name'];
	$upload='uploads';
	$final_destination = $upload .'/' .$file['name'];
	echo $type;
	if($type=="application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $type=="application/msword"){
		if(move_uploaded_file($tmp_location,$final_destination)){
			echo "<h1>Uploaded sucessfully</h1>";
			$a=0;
		}
		else if($a==1){
			die('<h1 class="false">INVALID FORMAT</h2>');
		}
	}
		 */
}
?>
<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
	/* $location ='uploads/';
	$target_file = $_FILES['filename']['name'];
	$desty = $location.$target_file; */
	$content = ;
	/* require_once 'autoload.php';
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
	$section = $phpWord->addSection();
	$section->addText($content);
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
	$objWriter->save('hello2.docx'); */

}

?>

<body>
	<h2>Welcome to docx to pdf converter </h2>
	<div>Setps:<p>First Select The docx File From Your Device And Click On Submit</p>
	<p>Then Click Show Pdf To display Your Word File In Pdf And Download</p></div>
	<form action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" method="post">
		<label id="file">Select Only docx File : </label>
		<input type="file" name="filename" id="file"><br/><br/>
		<input type="submit" value="SUBMIT">
	</form>
	<a href="37.php">Show Pdf</a> 
</body>

</html>