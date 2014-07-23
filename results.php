<?
	$mysql_host = "YOUR HOST";
	$mysql_database = "YOUR DB";
	$mysql_user = "YOUR UN";
	$mysql_password = "YOUR PW";

	mysql_pconnect($mysql_host, $mysql_user, $mysql_password);
	@mysql_select_db($mysql_database) or die( "Unable to select database");
	
	$query = "SELECT * FROM punk_v_metal";
	$result = mysql_query($query);
	$totalVotes = mysql_numrows($result);

	$leftSideCount = 0;
	$rightSideCount = 0;
	$sideDifferential = 0;
	$i = 0;
	while ($i < $totalVotes) {
		$handle = mysql_result($result,$i,"handle");
		$option = mysql_result($result,$i,"option");
		if(strtoupper($option) == "PUNK") {
			$leftSideCount++;
		}else if(strtoupper($option) == "METAL") {
			$rightSideCount++;
		}
		$i++;
	}
	
	// SUBTRACT LEFT SIDE FROM RIGHT SIDE
	// TO GIVE NEGATIVE NUMBERS WHEN GOING LEFT
	$sideDifferential = $rightSideCount-$leftSideCount;
	echo $sideDifferential . ':' . $leftSideCount . ':' . $rightSideCount;
?>
