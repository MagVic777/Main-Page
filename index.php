<?php
// Hi! Welcome to my live demo. This demo was refitted from one of my passion projects. @vicmagnusca
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
DEFINE("HOMEPLANTS",true);
require_once("inc.configserver.php");
require_once("inc.config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Clean input
function test_input($data) {
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Lock message
function lockmsg($lockmsg,$msgopt) {
	if(!isset($msgopt)) {
		echo "Function is locked";
		echo $lockmsg . "<br>";
		echo key($lockmsg) . "<br>";
		print_r(array_keys($lockmsg) . "<br>");
	}
	else {
		echo "<div class='container'>Function is locked</div>";
	}
}

// Get Act
(isset($_GET["act"])) ? $act = test_input($_GET["act"]) : $act = false;

switch ($act) {
	case "add":
		
		if ($islocked["add"] === false) { //Is locked?
				
			$in['plant'] = test_input($_POST["plant"]);
			$in['location'] = test_input($_POST["location"]);
			$in['more'] = test_input($_POST["more"]);
		
			$sql = "INSERT INTO $table (Plant, Location, More) VALUES (\"{$in['plant']}\", \"{$in['location']}\", \"{$in['more']}\")";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully"; 
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		} else { // Else Lock
			lockmsg($islocked["add"]);
		}
		
		break;
	case "new":
		include_once("inc.head.php");
		
		if ($islocked["add"] === false) { //Is locked?
			include_once("inc.new.php");
		} else { // Else Lock
			lockmsg($islocked["add"],1);
		}
		
		include_once("inc.footer.php");
		break;
	case "update":
		if ($islocked["update"] === false) { //Is locked?
			$in = test_input($_POST["ID"]); 
			$sql = "UPDATE $table SET Watered=NOW() WHERE id=$in";
			if ($conn->query($sql) === TRUE) { 
				$result = $conn->query("SELECT Watered FROM $table WHERE ID=$in");
				$row = $result->fetch_assoc();
				echo $row['Watered'];
			} else {
				echo "Error updating record: " . $conn->error;
			}
		} else { // Else Lock
			lockmsg($islocked["update"]);
		}
		break; 
	case "manage":
		include_once("inc.head.php");
		
		if ($islocked["edit"] === false) { //Is locked?
			include_once("inc.manage.php");
		} else {  lockmsg($islocked["edit"],1);  } // Else Lock
		
		include_once("inc.footer.php");
		break;
	case "edit":
		include_once("inc.head.php");
		
		if ($islocked["edit"] === false) { //Is locked?
			include_once("inc.edit.php");
		} else {  lockmsg($islocked["edit"],1);  } // Else Lock
		
		include_once("inc.footer.php");
		break;
	case "remove":
		if ($islocked["remove"] === false) { //Is locked?
			$in = test_input($_POST["ID"]); // clean input
			echo "Deleting record: " . $in;
			$sql = "DELETE FROM $table WHERE ID='$in'"; 
			if($conn->query($sql) === TRUE) {
				echo "<br>Deleted.";
			} else {
				echo "Error updating record: " . $conn->error;
			}
		} else {
			lockmsg($islocked["remove"]); // Else Lock
		}
		break;
		
	case "lock":
		include_once("inc.head.php");
		include_once("inc.lock.php");
		include_once("inc.footer.php");
		break;
	default:
		include_once("inc.head.php");
		include_once("inc.default.php");
		include_once("inc.footer.php");
	break;
}

$conn->close();
?>