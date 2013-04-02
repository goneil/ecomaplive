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
		echo 'Name: <input name="name" /><br />';
		echo 'Description: <input name="desc" /><br />';
		echo 'Blurb: <input name="blurb" /><br />';
		echo '<input type="radio" name="group1" value="private" CHECKED>Private ';
		echo '<input type="radio" name="group1" value="public">Public<br /><br />';
		echo '<input name="add" value="Submit" type="submit" />';
	} else {
        include("project-header.php"); 
        echo '<div id="map-header">';
		echo '<div id="map-title">',$project->getName(),' Maps</div>';

		if (loggedIn() && $project->isAdmin($userInfo['uid'])) {
            echo '<div id="add-map"><button class="button"><a  href="' . $basepath .
            '/create_map/' . $project->getID() . '">Add Map</a></button></div>';
        }
        echo '</div>';
		$maps = $project->getMaps();
        show_map_list($maps);
	}
} else {
	echo '<div>';
	echo '<h2>Your EcoMap Projects</h2>';
	if (loggedIn()){
        ?>
        <div class="projectContainer button">
            <a class="projectLink" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/project/add/">
                New Project
            </a>
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
