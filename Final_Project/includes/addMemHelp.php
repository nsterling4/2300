<?php 
	$sports = ["Baseball", "MBasketball", "MXC", "Football", "Golf", "MHockey", "MLacrosse", "MPolo", "HWRowing", "LWRowing", "MSoccer", "SprintFootball", "MSquash", "MSwim&Dive", "MTennis", "MTrack&Field", "Wrestling", "WBasketball", "WXC", "Equestrian", "Fencing", "FieldHockey", "Gymnastics", "WHockey", "WLacrosse", "WPolo", "WRowing", "Sailing", "WSoccer", "Softball", "WSquash", "WSwim&Dive", "WTennis", "WTrack&Field", "Volleyball"];
	foreach ($sports as $sport) {
		print ("<option name=$sport>$sport</option>");
	}
?>