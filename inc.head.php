<?php if(!HOMEPLANTS) die("You do not have access to this file."); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home Plants</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-title" content="Plants">
  <meta name="robots" content="noindex">
  <link rel="icon" sizes="128x128" href="icon.png">
  <link rel="apple-touch-icon" sizes="128x128" href="icon.png">
  <link rel="icon" href="icon.png" type="image/png" sizes="128x128"> 
  
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){ 

// $(".container").hide();
// $(".container").fadeIn(2000);

// Hide Status bar
function mystatus(a) {
 if(a == 1) { $("#status").parentsUntil("body").fadeIn(3000); } else if (a == 2) { $("#status").parentsUntil("body").hide();} else {  $("#status").parentsUntil("body").fadeToggle(); }
}
//mystatus(2);

// Ajax Error
$(document).ajaxError(function(e, xhr, opt){
	mystatus();
	$("#status").text("Error requesting " + opt.url + ": " + xhr.status + " " + xhr.statusText);
});


// Watering Schedule
$(".lastwatered").click( function(){
	var myid = $(this).attr("id");
	var me = $(this);
	mystatus(1);
	$("#status").text(+me);
	
	$.post("index.php?act=update", 
	{
		ID: myid
	},
	function(data, status){
		mystatus(1);
        $("#status").html("<b>Data:</b> " + data + "&nbsp;&nbsp;<b>Status:</b> " + status);
		$(me).text(data);
		$(me).parent().removeClass("danger warning");
		$(me).parent().addClass("success");
		setTimeout(function () {
			$(me).parent().removeClass("success");
		},
		6000
		);
    });
});
 
//Add a Plant
$("#formsubmit").click(function(){	
    $.post("index.php?act=add", 
	{
		plant: $("#plant").val(),
		location: $("#location").val(),
		more: $("#more").val()
	},
	function(data, status){
		mystatus(1);
        $("#status").html("<b>Data:</b> " + data + "&nbsp;&nbsp;<b>Status:</b> " + status);
    }
	);
});

//Delete a Plant
$(".jdelete").click( function() {
	var hid = $(this); 
	var myid = $(this).val();
	
	var c = confirm("Would you like to delete record #" + myid + "?");
	if (c == true) {
		$.post("index.php?act=remove",
		{
			ID: myid
		}, function(data,status) {
			mystatus(1);
			$("#status").html(data);
			$(hid).parent().parent().parent().fadeOut("slow");
		}
		);
	} else {
		mystatus(1);
		$("#status").html("Nothing was deleted.");
	}
});

// Open in Web view
$(document).on(
    "click",
    "a",
    function( event ){
        // Stop the default behavior of the browser, which
        // is to change the URL of the page.
        event.preventDefault();
        // Manually change the location of the page to stay in
        // "Standalone" mode and change the URL at the same time.
		var loc = $( event.target ).attr( "href");
		if (loc === undefined) {
			loc = "#";
		}
        location.href = loc;
    }
);

 
//End jQuery 
});
</script>
</head>
<body>

<!-- Nav -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <p class="navbar-brand" href="#"><span class="glyphicon glyphicon-grain"><span>HomePlants</p>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php"><span class="glyphicon glyphicon-grain"></span> Watering Schedule</a></li>
        <li><a href="index.php?act=new"><span class="glyphicon glyphicon-plus-sign"></span> Add Plants</a></li>
        <li><a href="index.php?act=manage"><span class="glyphicon glyphicon-list"></span> Manage Plants</a></li>
		<li><a href="index.php?act=lock"><span class="glyphicon glyphicon-lock"></span> Lock</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Status -->
<div class="container">
	<div class="panel panel-default">
		<div class="panel-body" id="status">
			Welcome to Home Plants!
			<br>
			This is a live demo that was refitted from an old passion project in order to meet the deadline to apply for COMPSA. It uses a bits of bootstrap, jquerry, html, css, javascript, mysql, and php.
			<br>
			It contains code from various sources, such as w3schools and various other sites. Most of the project has been programming by myself, but there is some code that had been alternated for my use or simply copy and pasted.
			<br>
			I had advanced in my programming since this project was made (eg. classes, better mysql & PDO queries, etc.)
			<br>
			I hope to be in your consideration.<br>
			Best,<br>
			<a href="https://www.instagram.com/vicmagnusca/" target="_blank">@vicmagnusca</a>
		</div>
	</div>
</div>