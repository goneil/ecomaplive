<script type="text/javascript" src="/images/js/create_map.js"></script>
<h2>Create New Map</h2>
<form class="create-form" method="post" action="/create_map">
    <div id="select_project">
        Project: 
        <select name="project_id">
            <?php 
            print_r($_GET);
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
                                if ($proj_id === $current_proj){
                                    echo "<option selected value='$proj_id'>$proj_name</option>";
                                } else{
                                    echo "<option value='$proj_id'>$proj_name</option>";
                                }
                            }
                        }
                    }
                }
            ?>
        </select>
    </div>
    <div>
        <div style="margin-left: 50px;">
            <input type="text" placeholder="Map Title" name="map_name" />
        </div>
    </div>
    <div id="dates">
        <div class="input_title">Filter Data by Time (optional):</div>
        <div id="date_input">
            <input placeholder="Start Date" type="text" class="datepicker" id='start_date' name='start_date'/>
            <input placeholder="End Date" type="text" class="datepicker" id='end_date' name='end_date'/>
        </div>
    </div>
    <div id="location">
        <div class="input_title">Filter Data by GPS Location (optional):</div>
        <div id="location_input">
            <div>
                <input placeholder="Min Latitude" type="text" name="min_lat"/>
                <input placeholder="Max Latitude" type="text" name="max_lat"/>
            </div>
            <div>
                <input placeholder="Min Longitude"  type="text" name="min_lng"/>
                <input placeholder="Max Longitude"  type="text" name="max_lng"/>
            </div>
        </div>
    </div>
    <div id="isPrivate_div">
        <input type="radio" name="isPrivate" value="1" checked/>Private
        </br>
        <input type="radio" name="isPrivate" value="0"/>Public
    </div>
    <br/>

    <div>
        <input class="btn" name="create_map" value="Submit" type="submit" />
    </div>

</form>
