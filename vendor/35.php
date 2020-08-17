<html>
<head>
	<title>WORD</title>
</head>

<?php
	require_once 'autoload.php';
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
	$section = $phpWord->addSection();
	$section->addText(
    '"Learn from yesterday, live for today, hope for tomorrow. '
        . 'The important thing is not to stop questioning." '
        . '(Albert Einstein)'
	);
	$section->addText(
    '"Great achievement is usually born of great sacrifice, '
        . 'and is never the result of selfishness." '
        . '(Napoleon Hill)',
    array('name' => 'Sofia', 'size' => 20)
	);
	$fontStyleName = 'oneUserDefinedStyle';
	$phpWord->addFontStyle(
		$fontStyleName,
		array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
	);
	$section->addText(
		'"The greatest accomplishment is not in never falling, '
			. 'but in rising again after you fall." '
			. '(Vince Lombardi)',
		$fontStyleName
	);
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
	$objWriter->save('helloWorld.docx');
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
	$objWriter->save('helloWorld.html');
	
?>
</html>