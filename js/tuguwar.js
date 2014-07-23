//360 pixels to each side from center. for a 10 vote win, 36px per increment.
var voteIncrement = 36;
var diffPosition = 0;
var positionMin = 20;
var positionMax = 740;
var centerPosition = 378;
var currentPosition = 0;
var newPos;
var flag;
var gameOver = false;
var pistols = $('#pistols')[0];
var metallica = $('#metallica')[0];

$(document).ready(function() {
	spawnFlag();
	currentPosition = newPos;
	getResults();
});

function checkForMaxPosition() {
  if(newPos <= positionMin){
		newPos = positionMin;
		gameOver = true;
		pistols.play();
	}else if(newPos >= positionMax){
		newPos = positionMax;
		gameOver = true;
		metallica.play();
	}
}

function spawnFlag() {
	flag = document.createElement('div');
	flag.className = 'flag';
	$('.battle').append(flag);
}

function getResults() {
	$.get('http://ackermaninteractive.com/txtowar/results.php', function(data) {
	  var arr = data.split(':');
		diffPosition = parseInt(arr[0]) * voteIncrement;
		$('.leftCount').html(arr[1]);
  	$('.rightCount').html(arr[2]);
	});
	newPos = centerPosition + diffPosition;
	checkForMaxPosition();
	//echo "<p><strong>Score:</strong></p><p>Punk Rock = $leftSideCount, Heavy Metal = $rightSideCount</p>";
	var tween = new Tween(flag.style, 'left', Tween.elasticEaseOut, currentPosition, newPos, .5, 'px');
	tween.start();
	currentPosition = newPos;
	if(!gameOver){
	  var results = setTimeout("getResults()", 1000);
	}
}