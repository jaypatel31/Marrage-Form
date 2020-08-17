<!--
==============================================================================
Filename: index.php

Description: Sample web page that accepts an uploaded document, converts it to
Flash and HTML5 format and shows the converted documents. The sample uses
Print2Flash OLE Automation SDK

For installation and usage instructions see ReadMe.htm file

This file is part of the Print2Flash OLE Automation SDK samples

Copyright (C) Print2Flash Software. All rights reserved

This source code is intended only as a supplement to Print2Flash OLE
Automation SDK and/or documentation. See Print2Flash documentation
and online help at http://print2flash.com for more information

THIS CODE AND INFORMATION IS PROVIDED "AS IS" WITHOUT WARRANTY OF ANY
KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A
PARTICULAR PURPOSE.
-->
<!doctype html>
<html>
<head>
<TITLE>Convert Document to Flash and HTML5 formats</TITLE>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
</head>
<body>
<H1>Convert Document to Flash and HTML5 formats</H1>
<?php
include("const.php");
// set the error reporting level for this script
error_reporting(E_USER_ERROR | E_USER_WARNING | E_USER_NOTICE);

$error = false;
$error_string = "";
$sourcefile = "";
$swffile = "";
$swffile_fs = "";
$showdoc=false;

$a_opt = array(
"Print2Flash Logo"=>INTLOGO,
"Navigation controls"=>INTPREVPAGE | INTGOTOPAGE | INTNEXTPAGE,
"Zooming controls"=>INTFITWIDTH | INTFITPAGE | INTZOOMSLIDER | INTZOOMBOX,
"Search controls"=>INTSEARCHBOX | INTSEARCHBUT,
"Print button"=>INTPRINT,
"Other controls"=>INTDRAG | INTSELTEXT | INTROTATE | INTNEWWIND | INTHELP | INTBACKBUTTON | INTFORWARDBUTTON | INTFULLSCREEN
);

// upload
if (array_key_exists("IsPostBack",$_POST) && $_POST["IsPostBack"])
{
    if (array_key_exists('sourcefile',$_FILES))
    {
		if ($_FILES['sourcefile']['error'] == UPLOAD_ERR_OK)
		{
        	$sourcefile = realpath('uploadedfiles/').'\\'.$_FILES['sourcefile']['name'];
        	if (move_uploaded_file($_FILES['sourcefile']['tmp_name'],$sourcefile))
    		{
    			PrintMsg("File uploaded","green");
    		}
    		else
        	{
        		PrintMsg("Error writing file $sourcefile");
        		$sourcefile = "";
        	}
		} else {
			PrintUploadError($_FILES['sourcefile']['error']);
		}
    }
	else
		PrintMsg("Please select a file to convert");
}
// convert
if (strlen($sourcefile))
{
    $p2f = new COM("Print2Flash5.Server2");
	if ($p2f) {
		// set to the user defined error handler
		set_error_handler("myErrorHandler");
		// options
		$interface_options = 0;
		foreach($a_opt as $opt)
			$interface_options |= (isChecked("opt_$opt"))?$opt:0;
		$p2f->DefaultProfile->InterfaceOptions = $interface_options;
   		$p2f->DefaultProfile->ProtectionOptions = PROTENAPI;
		$p2f->DefaultProfile->DocumentType=FLASH | HTML5;
		$p2f->DefaultProfile->OutputFormat=SINGLEFILE;
		$p2f->DefaultBatchProcessingOptions->GenerateExternalViewer=true;
		// convert file
		$dirname_fs=realpath('convertedfiles/').'/'.basename($sourcefile);
		if (!is_dir($dirname_fs) && !mkdir($dirname_fs)) PrintMsg("Could not create document folder");
		else {
			$dirname='convertedfiles/'.basename($sourcefile);
			$fsname=$dirname_fs."/doc";
			$swffile_fs = "$fsname.swf";
			$htmlfile_fs = "$fsname.xml";
			$htmlviewer_fs=$dirname_fs."/docviewer.html";
			PrintMsg("Converting ".basename($sourcefile),"green");
			$p2f->ConvertFile($sourcefile,$fsname);
			// check errors
			if ($error)
			{
			    PrintMsg("Error converting file");
				echo $error_string;
			}
			else $showdoc=true;

		}
	} else PrintMsg("Cannot create Print2Flash Server object");
}
?>
<form method="POST" action=<?php echo$_SERVER["PHP_SELF"];?> enctype="multipart/form-data">
<input type="hidden" name="IsPostBack" value="1"/>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
Select a file to convert: <INPUT TYPE="file" name="sourcefile"/><br>
Specify which buttons and controls you want to appear in the converted document:<br />
<table>
<tr>
<?php
$i = 0;
foreach($a_opt as $text=>$opt)
{
	$cb_name = "opt_$opt";
	$checked = (isChecked($cb_name))?" checked":"";
	echo "<td><input type=\"checkbox\" name=\"$cb_name\"$checked/>$text</td>";
	if (++$i % 3 == 0)
		echo "</tr><tr>";
}
?>
</tr>
</table>
<INPUT type="submit" VALUE="Convert File"/>
</form>
<?php
// Show the document
if ($showdoc) {
?>
<table width="100%" height="500px"><tr>
<td width="50%" height="100%" style="padding-right:5px">Flash Document:
<?php
if (file_exists($swffile_fs)) {
?>
<!-- Start of document code -->
<script type="text/javascript" language="javascript">
 <!--
var requiredMajorVersion = 9;
var requiredMinorVersion = 0;
var requiredRevision = 28;

var br=detectBrowser();
var browser=br[0];
var brversion=br[1];

var appVersion = navigator.appVersion.toLowerCase()
var isIE  = browser=="MSIE";
var isWin = (appVersion.indexOf("win") != -1) ? true : false;
var isMac = /mac/.test(appVersion);
var isSafari = browser=="Safari";
var isOpera = browser=="Opera";

function ControlVersion()
{
    var version = "";

	try {
		var axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");
		version = axo.GetVariable("$version");
	} catch (e) {
	}

	return version;
}

function GetSwfVer(){
	var flashVer = -1;

	if (navigator.plugins != null && navigator.plugins.length > 0) {
		if (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]) {
			var swVer2 = navigator.plugins["Shockwave Flash 2.0"] ? " 2.0" : "";
			var flashDescription = navigator.plugins["Shockwave Flash" + swVer2].description;
			var descArray = flashDescription.split(" ");
			var tempArrayMajor = descArray[2].split(".");
			var versionMajor = tempArrayMajor[0];
			var versionMinor = tempArrayMajor[1];
			var versionRevision = descArray[3];
			if (versionRevision == "") {
				versionRevision = descArray[4];
			}
			if (versionRevision.substring(0, 1) == "d") {
				versionRevision = versionRevision.substring(1);
			} else if (versionRevision.substring(0, 1) == "r") {
			    versionRevision = versionRevision.substring(1);
				if (versionRevision.indexOf("d") > 0) {
					versionRevision = versionRevision.substring(0, versionRevision.indexOf("d"));
				}
			}
			var flashVer = versionMajor + "." + versionMinor + "." + versionRevision;
		}
	}
	else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.6") != -1) flashVer = 4;
	else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.5") != -1) flashVer = 3;
	else if (navigator.userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 2;
	else if ( isIE && isWin && !isOpera ) {
		flashVer = ControlVersion();
	}
	return flashVer;
}

function DetectFlashVer(reqMajorVer, reqMinorVer, reqRevision)
{
	versionStr = GetSwfVer();
	if (versionStr == -1) {
	    return false;
	} else if (versionStr != 0) {
	    if (isIE && isWin && !isOpera) {
	        // Given "WIN 2,0,0,11"
	        tempArray = versionStr.split(" ");
	        if (tempArray.length > 1) tempString = tempArray[1]; else tempString = tempArray[0];
	        if (tempString.indexOf(",") != -1) versionArray = tempString.split(","); else versionArray = tempString.split(".");
	    } else {
	        versionArray = versionStr.split(".");
	    }
	    var versionMajor = versionArray[0];
	    var versionMinor = versionArray[1];
	    var versionRevision = versionArray[2];

	    if (versionMajor > parseFloat(reqMajorVer)) {
	        return true;
	    } else if (versionMajor == parseFloat(reqMajorVer)) {
	        if (versionMinor > parseFloat(reqMinorVer))
	            return true;
	        else if (versionMinor == parseFloat(reqMinorVer)) {
	            if (versionRevision >= parseFloat(reqRevision))
	                return true;
	        }
	    }
	    return false;
	} else
	    return false;
}

function detectBrowser() {
    var ua=navigator.userAgent, tem,
    M=ua.match(/(opera|chrome|safari|firefox|msie|trident\/)\/?\s*([\d\.]+)/i) || [];
    if (/trident/i.test(M[1])) {
        tem=  /\brv[ :]+(\d+(\.\d+)?)/g.exec(ua) || [];
        return 'IE '+(tem[1] || '');
    }
    M= M[2]? [M[1], M[2]]:[navigator.appName, navigator.appVersion];
    if((tem= ua.match(/version\/([\.\d]+)/i))!= null) M[1]= tem[1];
    return M;
};

 function GetDoc(movieName) {
    var isIE = navigator.appName.indexOf("Microsoft") != -1;
    return (isIE) ? window[movieName] : document[movieName];
}

var FlashDocs=new Array()
function AddFlashDoc(FlashDoc) {
    FlashDocs.push(FlashDoc);
}

var oldonmousewheel=document.onmousewheel
function mousewheel(event) {
    for (var i=0;i<FlashDocs.length;i++) {
	    if(event.target==FlashDocs[i]) {
		    var delta = 0;
		    if (event.wheelDelta) delta = event.wheelDelta / (isOpera ? 12 : 120);
		        else if (event.detail) delta = -event.detail;
		    if (event.preventDefault) event.preventDefault();
		    try {
		        FlashDocs[i].scrollLine(delta);
		    }
		    catch(e) {
		    }
		    return true;
	    }
	}
	return oldonmousewheel(event)
}

if(isMac || isWin && isSafari && CompVersions(brVersion,"4")<0) {
	if (typeof window.addEventListener != "undefined") window.addEventListener("DOMMouseScroll", mousewheel, false);
	window.onmousewheel = document.onmousewheel = mousewheel;
}

 // -->
</script>
<!-- Start of document placement code -->
<script type="text/javascript" language="javascript">
<!--
var width="100%"
var height="100%"
var name="Print2FlashDoc"
var flashdocurl="<?php echo rawurlencode($dirname."/doc.swf");?>"
var flashvars = ""
var FlashUpdatePage="http://get.adobe.com/flashplayer";

 var oeTags;
 var alternateFlashContent = 'This content requires the Adobe Flash Player. It either has not been installed yet or is prohibited by your browser security settings. Either'
    + ' <a href="' + FlashUpdatePage + '">click here to get Flash</a> or loosen your browser security restrictions';
 if (isIE && isWin) alternateFlashContent += ' and then <a href="javascript:document.location.reload()">Refresh</a> this page'
 alternateFlashContent += '.'

 if (DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision))
 {
      oeTags = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" '
     + 'width="'+width+'" height="'+height+'" id="'+name+'"'
     + 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=' + requiredMajorVersion + ',' + requiredMinorVersion + ',' + requiredRevision + ',0"'
     + 'type="application/x-shockwave-flash" data="' + flashdocurl + '" >'
     + '<param name="movie" value="' + flashdocurl + '" />'
     + '<param name="quality" value="best" />'
     + '<param name="allowFullScreen" value="true" />'
     + '<param name="allowFullScreenInteractive" value="true" />'
     + '<param name="allowScriptAccess" value="sameDomain" />'
     + '<param name="FlashVars" value="extName='+name+flashvars+'" />'
     + '<embed src="' + flashdocurl + '" quality="best" '
     + 'width="' + width + '" height="' + height + '" name="' + name + '" '
     + 'play="true" '
     + 'loop="false" '
     + 'quality="best" '
     + 'allowScriptAccess="sameDomain" allowFullScreen="true" allowFullScreenInteractive="true"'
     + 'type="application/x-shockwave-flash" '
     + 'pluginspage="'+FlashUpdatePage+'" '
     + 'FlashVars="extName=' + name + flashvars + '"> '
     + '</embed>'
     + '</object>';
   document.write(oeTags);
   AddFlashDoc(GetDoc(name));
}
else document.write(alternateFlashContent);
  //-->
 </script>
 <noscript>
     This content requires scripts to be enabled in your browser. Please enable scripts in your browser settings.
 </noscript>
<!-- End of document placement code -->
<!-- End of document code -->
  <?php
	} else PrintMsg("File not found ($swffile_fs)");
?>
</td><td width="50%" height="100%" style="padding-left:5px">HTML5 Document:
<?php
if (file_exists($htmlfile_fs) && file_exists($htmlviewer_fs)) {
?><!-- Start of document code -->
<script type="text/javascript" language="JavaScript1.1">
 <!--

 var requiredIEVersion="10";
 var requiredFirefoxVersion="11";
 var requiredOperaVersion="9";
 var requiredSafariVersion="5.1.7"; // 6
 var requiredChromeVersion="18";

 var br=detectBrowser();
 var browser=br[0];
 var brversion = br[1];

 var appVersion=navigator.appVersion.toLowerCase()
 var isIE  = browser=="MSIE";
 var isWin = (appVersion.indexOf("win") != -1) ? true : false;
 var isMac = /mac/.test(appVersion);
 var isSafari = browser=="Safari";
 var isOpera = browser=="Opera";

function CheckBrowserVer() {
	var reqVersion;
	if (isIE) reqVersion=requiredIEVersion;
		else if (isSafari) reqVersion=requiredSafariVersion;
			else if (isOpera) reqVersion=requiredOperaVersion;
				else if (browser=="Firefox") reqVersion=requiredFirefoxVersion;
					else if (browser=="Chrome") reqVersion=requiredChromeVersion;
						else return true;
	return CompVersions(brversion,reqVersion)>=0;
}

function CompVersions(ver1,ver2){
	ver1=ver1.split(".");
	ver2=ver2.split(".");
	for (var i=0;i<Math.max(ver1.length,ver2.length);i++) {
		var v1 = i<ver1.length ? parseInt(ver1[i]) : 0;
		var v2 = i<ver2.length ? parseInt(ver2[i]) : 0;
		if (v1<v2) return -1;
			else if (v1>v2) return 1;
	}
	return 0;
}

function GetBrowserUpgradePage(){
	if (isIE) return "http://windows.microsoft.com/en-US/internet-explorer/downloads/ie";
		else if (isSafari) return "https://www.apple.com/safari/";
			else if (isOpera) return "http://www.opera.com/browser/";
				else if (browser=="Firefox") return "http://www.mozilla.com/firefox/";
					else if (browser=="Chrome") return "http://www.google.com/chrome";
						else return "";
}

function GetHTMLDoc(movieName) {
    return document.getElementById(movieName).contentDocument;
}
// -->
</script>

<!-- Start of document placement code -->
<script language="JavaScript" type="text/javascript">
 <!--
 var width = "100%"
 var height = "100%"
 var name = "Print2FlashDoc"
 var htmldocurl ="<?php echo 'doc.xml';?>"
 var htmlviewerurl = "<?php echo rawurlencode($dirname)."//".rawurlencode("docviewer.html");?>"

 if (CheckBrowserVer()) {
     document.write("<iframe border='1' src='" + htmlviewerurl + "#" + htmldocurl + "' border='1' allowfullscreen webkitAllowFullScreen='yes' width='" + width + "' height='" + height + "' id='" + name + "'></iframe>");
 } else {
     var BrowserUpgradePage = GetBrowserUpgradePage();
     document.write("This content is not supported by your browser. Please upgrade your browser" + (BrowserUpgradePage ? " by <a target='_parent' href='" + BrowserUpgradePage + "'>clicking here</a>" : ""));
 }
  //-->
 </script>
 <noscript>
     This content requires scripts to be enabled in your browser. Please enable scripts in your browser settings.
 </noscript>
<!-- End of document placement code -->

<!-- End of document code -->
<?php
	} else PrintMsg("File not found ($htmlfile_fs)");
?></td></tr></table><?php
}


function PrintMsg($s,$color="red")
{
	echo "<span style=\"color:$color\">".htmlspecialchars($s)."</span><br>";
}

// error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
	global $error, $error_string;
	$error = true;
	$error_string = $errstr;
}

function isChecked($cb_name)
{
	$result = true;
	if (array_key_exists("IsPostBack",$_POST) && $_POST["IsPostBack"])
	{
		$result = array_key_exists($cb_name,$_POST) && strcasecmp($_POST[$cb_name],'on')==0;
	}
	return $result;
}

function PrintUploadError($err)
{
	$a_upload_errors = array(
		UPLOAD_ERR_INI_SIZE=>'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
		UPLOAD_ERR_FORM_SIZE=>'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
		UPLOAD_ERR_PARTIAL=>'The uploaded file was only partially uploaded.',
		UPLOAD_ERR_NO_FILE => 'No file was uploaded.'
	);

	if (array_key_exists($err,$a_upload_errors))
		PrintMsg($a_upload_errors[$err]);
	else
		PrintMsg('File upload error');

}
?>
</body>
</html>
