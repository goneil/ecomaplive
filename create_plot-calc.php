<?php
date_default_timezone_set('America/New_York');
    if ($_POST['create_plot']){
        $project_id = $_POST['project_id'];
        $plot_name = $_POST['plot_name'];
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
            $plot = new Plot($plot_name, $project_id, $isPrivate);
            //if ($plot->plot_exists()){
                //$database = new Database();
                //$query = "SELECT name FROM project WHERE id=$project_id";
                //$info = $database->query($query);
                //$row = $info->fetch_array();
                //$project_name = $row['name'];
                //$error_message = "Error: Cannot Create Visualization" . 
                                 //": A plot by the name " .
                                 //$plot->getName() . " in project, " . $project_name . 
                                 //", already exists";
            //}
            //else{
                $plot->exportToDB();
                $plot_point = new PlotPoints($plot->getID(), $point_list);
                $plot_point->exportToDB();
                header("Location: /plot/" . $plot->getID());
            //}

        }
        

    } else if ($request[1]){
        $current_proj = $request[1];
    }

?>
