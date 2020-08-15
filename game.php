<!DOCTYPE html>
<html>

<head>
	<title> Tic-Tac-Toe </title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="game.css">
</head>

<body>
    <a href="profile.php">Back to home</a>
   
	<table id='board'>

		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
<script type="text/javascript">
	$(document).ready(function () {

	var move = 1;
	var play = true;

	$("#board tr td").click(function () {
		if ($(this).text() == "" && play) {
			if ((move % 2) == 1) {
				$(this).append("X");
				$(this).css('color', "#ffe2e1");
				
			} else {
				$(this).append("O");
				$(this).css('color', "#ff8ba7");
			}
			move++;
			if (checkForWinner() != -1 && checkForWinner() != "") {
				if (checkForWinner() == "X") {
					$('body').append('<div class="winner"><span>Winner</span>X</div><button onclick="location.reload();" id="reload">Play Again</button>');
					$('.winner').css('background-color', '#ff8ba7');
					$('#reload').css('color','black');
				} else {
					$('body').append('<div class="winner"><span>Winner</span>O</div><button onclick="location.reload();" id="reload">Play Again</button>');
					$('.winner').css('background-color', '#ff8ba7');
					$('#reload').css('color','black');
				}
				play = false;
			}
		}
	});

	function checkForWinner() {
		var space1 = $("#board tr:nth-child(1) td:nth-child(1)").text();
		var space2 = $("#board tr:nth-child(1) td:nth-child(2)").text();
		var space3 = $("#board tr:nth-child(1) td:nth-child(3)").text();
		var space4 = $("#board tr:nth-child(2) td:nth-child(1)").text();
		var space5 = $("#board tr:nth-child(2) td:nth-child(2)").text();
		var space6 = $("#board tr:nth-child(2) td:nth-child(3)").text();
		var space7 = $("#board tr:nth-child(3) td:nth-child(1)").text();
		var space8 = $("#board tr:nth-child(3) td:nth-child(2)").text();
		var space9 = $("#board tr:nth-child(3) td:nth-child(3)").text();
		// check rows
		if ((space1 == space2) && (space2 == space3)) {
			return space3;
		} else if ((space4 == space5) && (space5 == space6)) {
			return space6;
		} else if ((space7 == space8) && (space8 == space9)) {
			return space9;
		}
		// check columns
		else if ((space1 == space4) && (space4 == space7)) {
			return space7;
		} else if ((space2 == space5) && (space5 == space8)) {
			return space8;
		} else if ((space3 == space6) && (space6 == space9)) {
			return space9;
		}
		// check diagonals
		else if ((space1 == space5) && (space5 == space9)) {
			return space9;
		} else if ((space3 == space5) && (space5 == space7)) {
			return space7;
		}
		// no winner
		return -1;
	}

});</script>
</body>

</html>