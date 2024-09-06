<?php
if(!HOMEPLANTS) die("You do not have access to this file.");

$in['plant'] = test_input($_POST["plant"]);
$in['location'] = test_input($_POST["location"]);
$in['more'] = test_input($_POST["more"]);
$in['ID'] = test_input($_POST["ID"]);
$in['watered'] = test_input($_POST["watered"]);

$sql = "SELECT * FROM $table WHERE ID='{$in['ID']}'";
$field =  $conn->query($sql);
if ($field == TRUE) { 
	$field = $field->fetch_assoc();
} 
else {
	die("Error: " . $sql . "<br>" . $conn->error);
}

$sql = "UPDATE $table SET Plant='{$in['plant']}',Location='{$in['location']}',More='{$in['more']}',Watered='{$in['watered']}' WHERE ID='{$in['ID']}'";

if ($conn->query($sql) === TRUE) {
	$etext =  "Updated successfully"; 
} else {
	$etext = "Error: " . $sql . "<br>" . $conn->error;
}
echo <<<TEXT
<div class="container">
<h1>Editing Record</h1>
$etext
<br><br>
Changed from: <br>
ID:{$field["ID"]} <br>
Plant: {$field["Plant"]}<br>
Location: {$field["Location"]}<br>
Watered: {$field["Watered"]}<br>
More: {$field["More"]}
<br><br>
Changed to:<br>
ID:{$in["ID"]} <br>
Plant: {$in["plant"]}<br>
Location: {$in["location"]}<br>
Watered: {$in["watered"]}<br>
More: {$in["more"]}

<br><br>
<a href="index.php?act=manage">Back to Manage Plants</a>
</div>
TEXT;

?>