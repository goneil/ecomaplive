<script src="/images/js/project.js" type="text/javascript"></script>
<?php
//echo "<br>request[0] is: " . $request[0] . "</br>";
//echo "<br>request[1] is: " . $request[1] . "</br>";
//echo "<br>request[2] is: " . $request[2] . "</br>";
$basepath = "http://" . $_SERVER['HTTP_HOST'];
if (isset($request[1])) {
	$project = new Project($request[1]);
	if ($request[1] == 'add') {
		echo '<h2>Add a project</h2>';
		echo '<form method="post">';
		echo '<div><input placeholder="Name" name="name" /></div>';
		echo '<div><input placeholder="Description" name="desc" /></div>';
		echo '<div><input placeholder="Blurb" name="blurb" /></div>';
		echo '<div><input type="radio" name="group1" value="private" CHECKED>Private ';
		echo '<input type="radio" name="group1" value="public">Public</div>';
		echo '<div><input name="add" value="Submit" type="submit" /></div>';
	} else {
        include("project-header.php"); 
        echo '<div id="map-header">';
		echo '<div id="map-title">',$project->getName(),' Maps:</div>';

		if (loggedIn() && $project->isAdmin($userInfo['uid'])) {
            echo '<a class="btn pull-right"  href="' . $basepath .
            '/create_map/' . $project->getID() . '">Add Map</a>';
        }
        echo '</div>';
		$maps = $project->getMaps();
        show_map_list($maps);
	}
} else {
	echo '<div class="pull-left"><h2 >My Existing Projects:</h2></div>';
	if (loggedIn()){
        ?>
        <div class="pull-right" id="new-button-div">
            <a class="btn" href="http://<?php echo
            $_SERVER['HTTP_HOST'];?>/project/add/">New Project</a>
        </div>
        
        <?php

		$projs = getUserProjects($userInfo['uid']);
        show_project_list($projs);
	} else {
		echo 'Register an account and create your own projects now!';
	}
	echo '</div>';
}
?>
