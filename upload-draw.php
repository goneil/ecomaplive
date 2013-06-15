<h2>Upload data points</h2>
<p>
From this page, you can upload additional data points to any exisitng project. 
Each file can have a maximum of 1,000 lines.
Please use the following format for each line:<br/>
<br/>
TimeStamp,Latitude,Longitude,Value<br/>
<br/>
For more information on proper data formatting and using Eco-Map web site,
please view our <a href= "../ecomap-data-api">Map API.</a>

</p><br />
<?php
	if (!isset($_POST['upload'])) { ?>
		<form enctype="multipart/form-data" method="POST"> 
	<?php if (!loggedIn()) { ?>
		Username <input name="user" /><br />
		Password <input name="pass" /><br />
	<?php }
	if(isset($request[1])) {
		if($request[1] == 'error' && isset($request[2])) {
			$showWarning = true;
		} else {
			$project = new Project($request[1]);
			echo 'Upload datapoints to project: <b>'.$project->getName().'</b> <br />';
		}
	} else {
		echo '<b>No Project Selected</b>';
	}
	?>
	<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
	<input type="hidden" name="project" value="<?php echo $request[1];?>" />
	<?php
		if($showWarning) {
			echo '<b>You have attempted to upload beyond the 150 data points limit.</b><br>';
			echo 'Your data file currently has <i>'.$request[2].'</i> data points. Please consider revising.<br><br>';
		}
	?>
	Choose a file to upload: <input name="file" type="file" /><br />
	<br />
	<input class="btn" type="submit" id="upload" value="Upload" name="upload" />
	</form>
<?php } ?>
