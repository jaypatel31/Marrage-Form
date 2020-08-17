<?php
/*
==============================================================================
Filename: const.php

Description: file defines Print2Flash enumerations constants

This file is part of the Print2Flash OLE Automation SDK samples

Copyright (C) Print2Flash Software. All rights reserved

This source code is intended only as a supplement to Print2Flash OLE
Automation SDK and/or documentation. See Print2Flash documentation
and online help at http://print2flash.com for more information

THIS CODE AND INFORMATION IS PROVIDED "AS IS" WITHOUT WARRANTY OF ANY
KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A
PARTICULAR PURPOSE.
*/

// *********************************************************************//
// Declaration of Enumerations defined in Type Library
// *********************************************************************//

// Constants for enum APPLICATIONTYPE
define("MSEXCEL", 0x00000001);
define("MSWORD", 0x00000002);
define("MSPOWERPOINT", 0x00000004);
define("ACROBAT", 0x00000008);

// Constants for enum IMAGEFORMAT
define("JPEG", 1);
define("PNG", 2);

// Constants for enum IMGBEHAVIOR
define("STRETCH", 1);
define("TILE", 2);

// Constants for enum ThreeStateFlag
define("TSF_NO",0x00000000);
define("TSF_YES",0x00000001);
define("TSF_AUTO",0x00000002);

// Constants for enum INTERFACE_OPTION
define("INTLOGO", 0x00000001);
define("INTDRAG", 0x00000002);
define("INTSELTEXT", 0x00000004);
define("INTZOOMSLIDER", 0x00000008);
define("INTZOOMBOX", 0x00000010);
define("INTFITWIDTH", 0x00000020);
define("INTFITPAGE", 0x00000040);
define("INTPREVPAGE", 0x00000080);
define("INTGOTOPAGE", 0x00000100);
define("INTNEXTPAGE", 0x00000200);
define("INTSEARCHBOX", 0x00000400);
define("INTSEARCHBUT", 0x00000800);
define("INTROTATE", 0x00001000);
define("INTPRINT", 0x00002000);
define("INTNEWWIND", 0x00004000);
define("INTHELP", 0x00008000);
define("INTBACKBUTTON", 0x00030000);
define("INTBACKBUTTONAUTO", 0x00010000);
define("INTFORWARDBUTTON", 0x000C0000);
define("INTFORWARDBUTTONAUTO", 0x00040000);
define("INTFULLSCREEN", 0x00300000);
define("INTFULLSCREENAUTO", 0x00100000);

// Constants for enum METADATAPORMAT
define("XML", 1);
define("TEXT", 2);

// Constants for enum OUTPUTFORMAT
define("SINGLEFILE", 1);
define("SINGLEFILEPERPAGE", 2);
define("EXTVIEWER", 4);

// Constants for enum PAPER_ORIENTATION
define("ORIENT_PORTRAIT", 0x00000001);
define("ORIENT_LANDSCAPE", 0x00000002);

// Constants for enum PROTECTION_OPTION
define("PROTDISPRINT", 0x00000001);
define("PROTDISTEXTCOPY", 0x00000002);
define("PROTENAPI", 0x00000004);

// Constants for enum TOOLBARIMAGE
define("IMGLOGO", 1);
define("IMGDRAG", 2);
define("IMGSELTEXT", 3);
define("IMGZOOMRULER", 4);
define("IMGZOOMFOCUSNADLE", 5);
define("IMGZOOMNADLE", 6);
define("IMGFITWIDTH", 7);
define("IMGFITPAGE", 8);
define("IMGPREVPAGE", 9);
define("IMGNEXTPAGE", 10);
define("IMGSEARCHBUT", 11);
define("IMGROTATE", 12);
define("IMGPRINT", 13);
define("IMGNEWWIND", 14);
define("IMGHELP", 15);
define("IMGMORE", 16);
define("IMGTOOLBARBGR", 17);
define("IMGBACK", 18);
define("IMGFORWARD", 19);
define("IMGFULLSCREEN", 20);
define("IMGEXITFULLSCREEN", 21);

// Constants for enum TEMPLATETYPE
define("TEMPLATE_CUSTOM", 1);
define("TEMPLATE_ACTIONSCRIPT2", 2);
define("TEMPLATE_ACTIONSCRIPT3", 3);

// Constants for enum WATERMARKANCHOR
define("CENTER", 0);
define("LEFTCENTER", 1);
define("RIGHTCENTER", 2);
define("TOPCENTER", 16);
define("BOTTOMCENTER", 32);
define("LEFTTOP", 17);
define("RIGHTTOP", 18);
define("LEFTBOTTOM", 33);
define("RIGHTBOTTOM", 34);

// Constants for enum COMPRESSION_METHOD
define("COMPRESSION_METHOD_ZLIB", 0);
define("COMPRESSION_METHOD_LZMA", 1);

// Constants for enum DOCUMENT_TYPE
define("FLASH", 1);
define("HTML5", 2);

// Constants for enum BROWSER_TYPE
define("INTERNET_EXPLORER", 1);
define("FIREFOX", 2);
define("CHROME", 4);
define("OPERA", 8);
define("SAFARI", 16);

// Constants for enum POWERPOINT_PRINTOUTPUT
define("POWERPOINT_PRINTOUTPUT_AUTO", 0);
define("POWERPOINT_PRINTOUTPUT_Slides", 1);
define("POWERPOINT_PRINTOUTPUT_TwoSlideHandouts", 2);
define("POWERPOINT_PRINTOUTPUT_ThreeSlideHandouts", 3);
define("POWERPOINT_PRINTOUTPUT_SixSlideHandouts", 4);
define("POWERPOINT_PRINTOUTPUT_NotesPages", 5);
define("POWERPOINT_PRINTOUTPUT_Outline", 6);
define("POWERPOINT_PRINTOUTPUT_BuildSlides", 7);
define("POWERPOINT_PRINTOUTPUT_FourSlideHandouts", 8);
define("POWERPOINT_PRINTOUTPUT_NineSlideHandouts", 9);
define("POWERPOINT_PRINTOUTPUT_OneSlideHandouts", 10);
?>