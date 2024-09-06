<?php if(!HOMEPLANTS) die("You do not have access to this file."); ?>

<div class="container">
<h1>Manage Plants</h1>
</div>

<?php

$sql = "SELECT * FROM $table ORDER BY Watered DESC";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()){
		
	echo <<<OUTTEXT

<div class="container">

 <form action="index.php?act=edit" method="post">
	<div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
	  <input type="text" class="form-control" value="{$row["ID"]}" readonly>
	</div>
	<div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
	  <input id="plant" type="text" class="form-control" name="plant" value="{$row["Plant"]}" placeholder="Plant">
	</div>
	<div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
	  <input id="location" type="text" class="form-control" name="location" value="{$row["Location"]}" placeholder="Location">
	</div>
	<div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
	  <input id="more" type="text" class="form-control" name="more" value="{$row["More"]}" placeholder="Additional Info">
	</div>
	<div class="input-group">
	  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	  <input id="more" type="text" class="form-control" name="watered" value="{$row["Watered"]}" placeholder="Watered">
	</div>
	<div class="input-group">
	  <input type="hidden"  name="ID" value="{$row["ID"]}">
	  <button type="submit" class="btn btn-default">Submit</button>
	  <button type="button" class="btn btn-warning jdelete" name="delete" value="{$row["ID"]}">Delete</button>
	</div>
 </form>
<br>
</div>

OUTTEXT;
		
	}
}
else {
	echo "There is nothing to show. :(";
}

?>