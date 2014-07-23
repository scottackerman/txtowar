<?php
	
	$option = $_REQUEST['Body'];
	$handle = $_REQUEST['From'];
	
	$leftSideCount = 0;
	$rightSideCount = 0;
	$sideDifferential = 0;
	$i = 0;
	$win = false;
	
	$mysql_host = "YOUR HOST";
	$mysql_database = "YOUR DB";
	$mysql_user = "YOUR UN";
	$mysql_password = "YOUR PW";

	mysql_connect($mysql_host,$mysql_user,$mysql_password);
	@mysql_select_db($mysql_database) or die( "Unable to select database");
	
	$query = "INSERT INTO punk_v_metal VALUES ('','$handle','$option')";
	mysql_query($query);
	
	$query2 = "SELECT * FROM punk_v_metal";
	$result = mysql_query($query2);
	$totalVotes = mysql_numrows($result);
	
	mysql_close();
	
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
	
	if($sideDifferential == $win || $sideDifferential == -$win){
		$win = true;
	}

	$punkCount = 0;
	$metalCount = 0;
	$responding = "Hello warrior at " . $handle . ", thanks for your vote of '" . $option . "'! Current score is Punk: " . $leftSideCount . " vs Metal: " . $rightSideCount;

    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

?>
<Response>
    <Sms><?php echo $responding ?></Sms>
</Response>