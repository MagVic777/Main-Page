<?php if(!HOMEPLANTS) die("You do not have access to this file."); ?>

<!-- Add a Plant -->
<div class="container">
	<h1>Add a Plant</h1>
	
	<form>
		<div class="input-group">
		  <span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
		  <input id="plant" type="text" class="form-control" name="plant" placeholder="Plant">
		</div>
		<div class="input-group">
		  <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
		  <input id="location" type="text" class="form-control" name="location" placeholder="Location">
		</div>
		<div class="input-group">
		  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
		  <input id="more" type="text" class="form-control" name="more" placeholder="Additional Info">
		</div>
		<div class="input-group">
		  <button type="button" class="btn btn-default" id="formsubmit">Submit</button>
		</div>
	</form>
	
</div>