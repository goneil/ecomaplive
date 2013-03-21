<script src="/images/project-js.js" type="text/javascript"></script>
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
		echo '<div class="projectContainer">';
		echo '<a class="projectLink" href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getID(),'">'.$project->getName().'</a><br>';
		echo '<p style="margin: 0px 10px 0px 20px;">';
		echo 'Description: ',$project->getDescription(),'<br />';
		echo 'Blurb: ',$project->getBlurb(),'<br />';
		echo 'This project is ',$project->getPrivate(),'<br />';
		if (loggedIn() && $project->isAdmin($userInfo['uid'])) {
			if (isset($request[2]) && $request[2] == 'admin') {
				if (isset($request[3]) && $request[3] == 'add') { ?>
					<form method="post">
					Name <input name='name' />
					<input type="radio" name="group1" value="private" CHECKED>Private 
					<input type="radio" name="group1" value="public">Public<br /> <br />
					<input type='submit' value="Submit" name='newMap' />
					</form><br />
					<?php	
				} else {
					echo '<h3>Administrative Functions</h3>';

                    $baseurl = "http://$_SERVER[HTTP_HOST]/project/" .
                               $project->getId() . "/admin";
					echo '> <a href="', $baseurl, '/delete">Delete Project</a><br />';
					if ($project->getPrivate() == 'Private'){
						echo '> <a href="', $baseurl, '/setPublic">Set as Public</a><br />';
                    }
					else{
						echo '> <a href="', $baseurl, '/setPrivate">Set as Private</a><br />';
                    }
					echo '> <a href="http://',$_SERVER['HTTP_HOST'],'/upload/',$project->getid(),'">Upload Points</a><br />';
				}
				if (isset($request[3]) && $request[3] == 'users') {
					if (!isset($request[4])) {
						echo 'Users: <br />';
						$users = $project->getUsers();
						foreach ($users as $user) {
							$u = new User($user);
							$info = $u->getInfo();
							echo '<a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/users/',$u->getID(),'">',$info['name'],'</a><br />';
						}
					} else {
						$u = new User($request[4]);
						echo 'ID: ' . $u->getID() . '<br />';
						echo 'Name: ' . $u->getName() . '<br />';
						echo 'Email: ' . $u->getEmail() . '<br />';
						echo '<form method="post">';
						echo 'Is a member: <input type="checkbox" ';
						if ($project->isUser($u)) echo 'checked ';
						echo ' name="member" /><br />';
						echo 'Is an admin: <input type="checkbox" ';
						if ($project->isAdmin($u)) echo 'checked ';
						echo ' name="admin" /><br />';
						echo '<input type="submit" value="Submit" name="user" /></form>';
					}
				} else {
					echo '> <a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/users">Users</a><br />';
				}
				if (isset($request[3]) && $request[3] == 'edit') {
					echo '<form method="post">';
					echo 'Name <input name="name" value="',$project->getName(),'" /><br />';
					echo 'Description <input name="description" value="',$project->getDescription(),'" /><br />';
					echo 'Blurb <input name="blurb" value="',$project->getBlurb(),'" /><br />';
					echo '<input type="submit" value="Submit" name="edit" /></form>';
				} else {
					echo '> <a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/edit">Edit</a><br />';
				}

			} else {
				echo '<a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin">Admin Section</a><br /><br />';
			}
		}
		echo '</p>';
		echo '</div>';
		
		echo '<h4>',$project->getName(),' Visualization</h4>';
		echo '<p style="margin: 0px 20px 20px 20px;">';

        echo '<div class="button mapContainer"><a  href="' . $basepath .
        '/create_map">Add Visualization</a></div>';
		$maps = $project->getMaps();
        show_map_list($maps);
		echo '</p>';
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
