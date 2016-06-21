<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90" style="margin: 20px">
		  <tr bgcolor="#520101">
			<td align="left"><img src="<?php echo $message->embed($logopath); ?>"></td>			
		  </tr>
		</table>

		<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="margin: 20px"> 
		  <tr>
			<td align="left" valign="top" style="padding:10px;"><?php echo $content; ?></td>
		  </tr>
		</table>   
		 
		<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90" style="border-top:2px solid #4F81BD; margin: 20px">
		  <?php echo $footer ?> <a href="<?php echo $sitepath ?>" target="_blank"><?php echo $sitename ?></a>
		</table>
			
		</div>
	</body>
</html>
