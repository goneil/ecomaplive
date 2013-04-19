<?php	
        echo '<div class="projectContainer">';
        echo "<div class='projectInfo'>";
            echo '<div class="project-header">';
                echo "<div id='project-title'>" . $project->getName() . "</div>";
		        if (loggedIn() && $project->isAdmin($userInfo['uid'])) {
                    echo '<a class="btn pull-right" href="http://' . $_SERVER['HTTP_HOST'] .
                            '/upload/' . $project->getid() . '">Upload Points</a>';
                }
                $database = new Database();
                $query = "SELECT id from point where project =" .  $project->getId();
                $totalPoints = $database->query($query)->num_rows;
            echo '</div>';

        echo "<br/><br/><br/>";
		echo 'Description: ',$project->getDescription(),'<br />';
		echo 'Blurb: ',$project->getBlurb(),'<br />';
		echo 'This project is ',$project->getPrivate(),'<br />';
        echo "<div>
                Total Data Points: <input class='input-small' disabled
                value='$totalPoints'>
              </div>";
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
					echo '<h3>Project Properties</h3>';

                    $baseurl = "http://$_SERVER[HTTP_HOST]/project/" .
                               $project->getId() . "/admin";
					echo '> <a href="', $baseurl, '/delete">Delete Project</a><br />';
					if ($project->getPrivate() == 'Private'){
						echo '> <a href="', $baseurl, '/setPublic">Set as Public</a><br />';
                    }
					else{
						echo '> <a href="', $baseurl, '/setPrivate">Set as Private</a><br />';
                    }
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
				echo '<a
                href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin">Edit Project Properties</a><br /><br />';
			}
		}
        
        echo '</div>';

?>
            
<?php
		echo '</p>';
		echo '</div>';

?>
