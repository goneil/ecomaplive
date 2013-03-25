
<script type="text/javascript" src="/images/js/create_map.js"></script>

<div class="title">
    <h2>Create Visualization</h2>
</div>
<!--<div class="error">
    <p>
        <?php 
            //if (isset($error_message)){
                //echo $error_message; 
            //}
        ?>
    </p>
    <br/>
</div>
-->

<form method="post" action="/create_map">
    <div id="select_project">
        Select Project: 
        <select name="project_id">
            <?php 
                if (loggedIn()){
                    //print_r($userInfo);
                    $uid = $userInfo['uid'];
                    $database = new Database();
                    $query = "SELECT project, isAdmin FROM projusers WHERE
                    user=$uid";
                    $info = $database->query($query);
                    if ($info){
                        while ($row = $info->fetch_array()){
                            if ($row['isAdmin']){
                                $proj_id = $row['project'];
                                $query = "SELECT name FROM project WHERE id=$proj_id";
                                $proj_name = $database->query($query);
                                $proj_name = $proj_name->fetch_array();
                                $proj_name = $proj_name['name'];
                                echo "<option value='$proj_id'>$proj_name</option>";
                            }
                        }
                    }
                }
            ?>
        </select>
    </div>
    <div>
        <div class="input_title">
            Map Title: <input name="map_name" />
        </div>
    </div>
    <div id="dates">
        <div class="input_title">Select Data by Time:</div>
        <div id="date_input">
            <p>Start: <input type="text" class="datepicker" id='start_date' name='start_date'/></p>
            <p>End: <input type="text" class="datepicker" id='end_date' name='end_date'/></p>
        </div>
    </div>
    <div id="location">
        <div class="input_title">Select Data by GPS Location:</div>
        <div id="location_input">
            <p>Latitude: <input type="text" name="lat"/></p>
            <p>Longitude: <input type="text" name="lng"/></p>
            <p>Radius (km): <input type="text" name="radius"/></p>
        </div>
    </div>
    <div id="isPrivate_div">
        <input type="radio" name="isPrivate" value="1" checked/>Private
        <input type="radio" name="isPrivate" value="0"/>Public
    </div>
    <div>
        <input name="create_map" value="Submit" type="submit" />
    </div>

<div id="wizard" class="swMain">
  <ul>
    <li><a href="#step-1">
          <label class="stepNumber">1</label>
          <span class="stepDesc">
             Step 1<br />
             <small>Step 1 description</small>
          </span>
      </a></li>
  </ul>
  <div id="step-1">   
      <h2 class="StepTitle">Step 1 Content</h2>
       <!-- step content -->
  </div>
</div>

</form>
