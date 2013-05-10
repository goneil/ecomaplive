<?php
class Plot {
	private $id;
	private $name;
	private $project;
	private $isPrivate;
	private static $database;
	
	function __construct($name, $project, $isPrivate) {
		$this->construct($name, $project, $isPrivate);
	}


	function construct($name, $project, $isPrivate) {
        $this->database = new Database();
        if (($id = $this->plot_exists_proj_name($project, $name)) !== false){
            $this->id = $id;
        }
        $this->isPrivate = $isPrivate;
        $this->name = $name;
        $this->project = $project;
	}

    function plot_exists_proj_name($project, $name){
		$query = "SELECT * FROM `plots` WHERE `project` = $project and `name` = '$name'";
		$info = $this->database->query($query);
        if ($info && $tmp_id = $info->fetch_array()){ 
            return $tmp_id["id"];
        }
        else{ return false; }
    }


    function plot_exists($id){
		$query = "SELECT * FROM `plots` WHERE `id` = '$id'";
		$info = $this->database->query($query)->fetch_array();
        if ($info){
            return true;
        }else{
            return false;
        }
    }

    function id_from_name_project($name, $project){
		$query = "SELECT id FROM `plots` WHERE `name` = '$name' AND `project`" .
                 "= $project";
		$info = $this->database->query($query);
        if ($info){
            $row = $info->fetch_array();
        }
        return $row['id'];
    }

    //TODO make sure correct
    function exportToDB(){
		$query = "INSERT INTO `plots` VALUES(DEFAULT, '$this->name',
                 '$this->project', '$this->isPrivate')";
		$this->database->query($query);
        //TODO is this how to set id?
        if (!$this->id){
		    $this->id = $this->database->getConnection()->insert_id;
        }
    }


    /** TODO implement function
      * @returns new plot loaded from the database
      * @params id {int}
      * returns plot with all null values if id not in db
      */
	static function loadPlot($id) {
		$database = new Database();
		$query = "SELECT * FROM `plots` WHERE `id` = '$id'";
		$info = $database->query($query)->fetch_array();
		$isPrivate = $info['private'];
		$name = $info['name'];
		$project = $info['project'];
        $plot = (new Plot($name, $project, $isPrivate));
        $plot->setID($info['id']);
        return $plot;
	}

    function setID($id){
        $this->id = $id;
    }

	function getID() {
		return $this->id;
	}
	
	function isPrivate() {
		return $this->isPrivate;
	}

	function getPoints() {
        $plot_points = PlotPoints::loadPlotPoints($this->id);
        $point_list = array();
        foreach($plot_points->getPoints() as $point_id){
            array_push($point_list, Point::loadPoint($point_id, $this->database));
        }
        return $point_list;
    }
	
	function getProject() {
		return $this->project;
	}
	
	function getName() {
		return $this->name;
	}

    function remove(){
        echo "removing plot";
        $plot_points = PlotPoints::loadPlotPoints($this->id);
        $plot_points->remove();
        $query = "DELETE FROM `plots` WHERE id=".$this->id;
        echo $query;
        $results = $this->database->query($query);
    }
}
?>
