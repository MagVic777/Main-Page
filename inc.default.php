<?php if(!HOMEPLANTS) die("You do not have access to this file."); ?>
<!-- Watering Schedule -->
<div class="container">
	<h1>Watering Schedule</h1>
		<div class="alert alert-info">
		<strong>Info!</strong> Click on the date to update the date of watering. Row changes changes after <?php echo $numofday; ?> days. Row changes to red after <?php echo $maxnumofday; ?> days. Please refresh the page for the tables to be resorted. (In newer projects, I had added javascript and jquery table sorting after a click.)
		</div>
		<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
				 <th>ID</th>
				 <th>Plant</th>
				 <th>Location</th>
				 <th>Last Watered</th>
				 <th>Info</th>
				</tr>
			</thead>
			<tbody>
<?php
$sql = "SELECT * FROM $table ORDER BY Watered DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$date1 = date_create();
		$date2 = date_create($row['Watered']);
		$dated = date_diff($date1,$date2);
		$date3 = $dated->format("%a");
		if($date3 >= $maxnumofday) {
			$active = " class=\"danger\"";
		}
		elseif($date3 >= $numofday) {
			$active = " class=\"warning\"";
		}
		else {
			$active = "";
		}
		
		echo "
				<tr" . $active . ">
				 <td>" . $row['ID'] . "</td>
				 <td>" . $row['Plant'] . "</td>
				 <td>" . $row['Location'] . "</td>
				 <th class=\"lastwatered\" id=\"" . $row['ID'] . "\">" . $row['Watered'] . "</td>
				 <th>" . $row['More'] . "</td>
				</tr>";
    }
} else {
    echo "There is nothing to show. :(";
}			
?>
			</tbody>
		</table>
		</div>

</div>