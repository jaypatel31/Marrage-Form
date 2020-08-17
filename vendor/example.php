<?php 
/* include("php/lib/GrabzItClient.php");
include("php/config.php");
function useCallbackHandler($grabzItHandlerUrl)
{
	$serverAddr = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '';
	$localAddr = isset($_SERVER['LOCAL_ADDR']) ? $_SERVER['LOCAL_ADDR'] : '';
	return $serverAddr != '::1' && $localAddr != '::1' && $serverAddr != '127.0.0.1' && $localAddr != '127.0.0.1' && filter_var($grabzItHandlerUrl, FILTER_VALIDATE_URL) !== FALSE;
}
$html= "<html><body><h1>Hello World!</h1></body></html>";
$grabzIt = new \GrabzIt\GrabzItClient($grabzItApplicationKey, $grabzItApplicationSecret);
$grabzIt->HTMLToDOCX($html);
$filepath = "result.docx";
$grabzIt->SaveTo($filepath); */
include("php/lib/GrabzItClient.php");
include("php/config.php");
function useCallbackHandler($grabzItHandlerUrl)
{
	$serverAddr = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '';
	$localAddr = isset($_SERVER['LOCAL_ADDR']) ? $_SERVER['LOCAL_ADDR'] : '';
	return $serverAddr != '::1' && $localAddr != '::1' && $serverAddr != '127.0.0.1' && $localAddr != '127.0.0.1' && filter_var($grabzItHandlerUrl, FILTER_VALIDATE_URL) !== FALSE;
}
$grabzIt = new \GrabzIt\GrabzItClient($grabzItApplicationKey, $grabzItApplicationSecret);
$grabzIt->HTMLToRenderedHTML('file.html');
$filepath = "result.html";
$grabzIt->SaveTo($filepath);

 
?>
