<?php 

$html = "<table bgcolor='#fff' style='padding:0; margin:0 auto;padding: 10px;width:100%;
-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;width: 100%!important;height: 100%;'>";
$html .= "<tr>";    
$html .= "<td bgcolor='#fff' style='display: block!important;max-width: 700px!important;
margin: 0 auto!important;clear: both!important;style='padding:0''>";

$html .= "<div style='max-width: 700px;margin: 0 auto;display: block;'>";
$html .= "<table style='width: 100%;margin: 0;padding: 0; font-family: Arial, sans-serif;font-size: 100%;line-height: 1.6;'>";
$html .= "<tr style='background:#fff;;''><td style='padding:7px 20px;font-size:12px'>";
$html .= "<span style='color:#646464;font-weight:bold'></span> &nbsp;&nbsp;";
$html .= "</td></tr>";

$html .= "<tr><td style='padding:0'>";
$html .= "<table style='width: 100%;padding:0; margin-bottom:20px'><tr style='padding:0'><td style='width:75%; vertical-align:top; padding:0'><img src='".RACINE.WEBROOT."img/logo.png' width='130'></td> <td style='width:25%; text-align:right!important; vertical-align:top; padding:0'><div style='font-weight:bold;color:#279c2b; font-size:2.2em'>Newsletter</div><div style='font-weight:_bold;color:#000;font-size:2em'>".formatDate(date('Y-m-d'), '%B %Y')."</div></td></tr></table>";
$html .= "</td></tr>";
