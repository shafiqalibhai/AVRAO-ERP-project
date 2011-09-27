<?php
/**
 * @copyright   Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license             GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />
<style>
td{font-family:Tahoma;font-size:11px;color:#000000}
a{color:#800000}
.date{font-family:Tahoma;font-size:10px;color:#787878;font-weight:bold;padding-left:10px;padding-top:10px;}
.cap{font-family:Tahoma;font-size:10px;color:#FFAA00;font-weight:bold;padding-left:10px;padding-top:2px;}
</style>

<link rel="stylesheet" href="jquery/jdMenuSharp.css" type="text/css">
<link rel="stylesheet" href="jquery/jdMenu.css" type="text/css">
<link rel="stylesheet" href="templates/avraoTemplate/style.css" type="text/css">
<link href="jquery/jdMenuCustom.css" rel="stylesheet" type="text/css">

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" background="images/bkg.png">
        <center><table cellpadding="0" cellspacing="0" border="0" height="100%">
<tr>
        <td colspan="2" valign="top">
        <table cellpadding="0" cellspacing="0" border="0">
               <tr>
                        <td><img src="images/name.jpg"></td>
                </tr>
                <tr>
                <td >


        <jdoc:include type="modules" name="user3" />
          </td></tr>
        </table>
        </td>
        </tr>
<tr>
        <td height="100%" align="center" colspan="3" valign="top" style="background-image:url('./images/menu_bottom_bg.jpg'); background-repeat:repeat-x; background-position:top; padding-top:7px;">

<table border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td width="171" valign="top">

    <table cellpadding="0" cellspacing="0" border="0" height="100%">
                <tr>
                        <td><img src="images/capform1.jpg"></td>
                </tr>
                <tr>
                        <td bgcolor="white" valign="top" >
                                 <jdoc:include type="modules" name="left" />
                        </td>
                </tr>
                <tr>
                        <td><img src="images/capform2.jpg"></td>
                </tr>

                <tr>
                        <td><img src="images/capnews.jpg"></td>
                </tr>
                <tr>
                        <td width="171"  height="100%" background="images/bgnews.jpg" style="background-repeat:no-repeat;background-position:bottom left" valign="top">
                        <div class="date">25 Nov 2008</div>
                        <div class="cap">News Header</div>
                        <div style="padding-left:10px;padding-right:10px;">update 1.</div>
                        <div class="date">25 Nov 2008</div>
                        <div class="cap">News Header</div>
                        <div style="padding-left:10px;padding-right:10px;">Update    123.</div>
                        <div class="date">25 Nov 2008</div>
                        <div class="cap">News Header</div>
                        <div style="padding-left:10px;padding-right:10px;">Update    123.</div>
                        <div class="date">25 Nov 2008</div>
                        <div class="cap">News Header</div>
                        <div style="padding-left:10px;padding-right:10px;">Update    123.</div>
                        <div class="date">25 Nov 2008</div>
                        <div class="cap">News Header</div>
                        <div style="padding-left:10px;padding-right:10px;">Update    123.</div>
                        </td>
                </tr>
        </table>




    </td>
    <td width="550" valign="top">


        <table cellpadding="0" cellspacing="0" border="0" height="100%">
                <tr>


            <td width="569" background="images/bgmid.gif" height="467" valign="top">
            			<jdoc:include type="modules" name="user4" />
                        <jdoc:include type="component" />
                        </td>
                </tr>
                <tr>
                        <td width="569" background="images/bgmid.gif" height="100%" valign="bottom">&nbsp;</td>

                </tr>
        </table>



    </td>
  </tr>
</table>




        </td>
</tr>
<tr>
        <td colspan="2">
        <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                        <td><img src="images/p01.jpg"></td>
                        <td rowspan="3" width="263" height="123" background="images/great02.jpg"></td>
                </tr>
                <tr>
                        <td><a href=""><img src="images/f01.jpg" border="0"></a><a href=""><img src="images/f02.jpg" border="0"></a><a href=""><img src="images/f03.jpg" border="0"></a><a href=""><img src="images/f04.jpg" border="0"></a><img src="images/p02.jpg" border="0"></td>
                </tr>
                <tr>

                        <td width="437" height="66" background="images/footer.jpg" style="padding-left:40px;padding-top:5px;">Avrao Consultancies &copy; 2008 • <a href="" style="color:#000000;text-decoration:none;">Privacy Policy</a> • <a href="" style="color:#000000;text-decoration:none;">Terms Of Use</a></td>
                </tr>
        </table>
        </td>
        </tr>
</table></center>

</body>
</html>
