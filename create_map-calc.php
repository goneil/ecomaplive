<?php
date_default_timezone_set('America/New_York');
    if ($_POST['create_map']){
        $project_id = $_POST['project_id'];
        $map_name = $_POST['map_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $min_lat = $_POST['min_lat'];
        $max_lat = $_POST['max_lat'];
        $min_lng = $_POST['min_lng'];
        $max_lng = $_POST['max_lng'];
        $isPrivate = $_POST['isPrivate'];
        $query = "SELECT id FROM point WHERE project = $project_id";
        if ($start_date != ""){
            $start_time = strtotime($start_date) * 1000;
            $query = $query . " and time >= $start_time";
        }
        if ($end_date != ""){
            $end_time = strtotime($end_date) * 1000;
            $query = $query . " and time <= $end_time";
        }
        if ($min_lat){
            $query = $query . " and lat >= $min_lat";
        }
        if ($max_lat){
            $query = $query . " and lat <= $max_lat";
        }
        if ($min_lng){
            $query = $query . " and lng >= $min_lng";
        }
        if ($max_lng){
            $query = $query . " and lng <= $max_lng";
        }

        $database = new Database();
        $info = $database->query($query);
        $point_list = array();
        if ($info){
            while ($row = $info->fetch_array()){
                $point_list[] = $row['id'];
            }
            // must happen in this order
            $map = new Map($map_name, $project_id, $isPrivate);
            //if ($map->map_exists()){
                //$database = new Database();
                //$query = "SELECT name FROM project WHERE id=$project_id";
                //$info = $database->query($query);
                //$row = $info->fetch_array();
                //$project_name = $row['name'];
                //$error_message = "Error: Cannot Create Visualization" . 
                                 //": A map by the name " .
                                 //$map->getName() . " in project, " . $project_name . 
                                 //", already exists";
            //}
            //else{
                $map->exportToDB();
                $map_point = new MapPoints($map->getID(), $point_list);
                $map_point->exportToDB();
                header("Location: /map/" . $map->getID());
            //}

        }
        

    } else if ($request[1]){
        $current_proj = $request[1];
    }

?>
