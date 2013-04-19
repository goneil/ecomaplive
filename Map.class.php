<?php
class Map {
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
        if (($id = $this->map_exists_proj_name($project, $name)) !== false){
            $this->id = $id;
        }
        $this->isPrivate = $isPrivate;
        $this->name = $name;
        $this->project = $project;
	}

    function map_exists_proj_name($project, $name){
		$query = "SELECT * FROM `maps` WHERE `project` = $project and `name` = '$name'";
		$info = $this->database->query($query);
        if ($info && $tmp_id = $info->fetch_array()){ 
            return $tmp_id["id"];
        }
        else{ return false; }
    }


    function map_exists($id){
		$query = "SELECT * FROM `maps` WHERE `id` = '$id'";
		$info = $this->database->query($query)->fetch_array();
        if ($info){
            return true;
        }else{
            return false;
        }
    }

    function id_from_name_project($name, $project){
		$query = "SELECT id FROM `maps` WHERE `name` = '$name' AND `project`" .
                 "= $project";
		$info = $this->database->query($query);
        if ($info){
            $row = $info->fetch_array();
        }
        return $row['id'];
    }

    //TODO make sure correct
    function exportToDB(){
		$query = "INSERT INTO `maps` VALUES(DEFAULT, '$this->name',
                 '$this->project', '$this->isPrivate')";
		$this->database->query($query);
        //TODO is this how to set id?
        if (!$this->id){
		    $this->id = $this->database->getConnection()->insert_id;
        }
    }


    /** TODO implement function
      * @returns new Map loaded from the database
      * @params id {int}
      * returns map with all null values if id not in db
      */
	static function loadMap($id) {
		$database = new Database();
		$query = "SELECT * FROM `maps` WHERE `id` = '$id'";
		$info = $database->query($query)->fetch_array();
		$isPrivate = $info['private'];
		$name = $info['name'];
		$project = $info['project'];
        $map = (new Map($name, $project, $isPrivate));
        $map->setID($info['id']);
        return $map;
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
        $map_points = MapPoints::loadMapPoints($this->id);
        $point_list = array();
        foreach($map_points->getPoints() as $point_id){
            array_push($point_list, Point::loadPoint($point_id, $this->database));
        }
        echo "loaded all points";
        return $point_list;
    }
	
	function getProject() {
		return $this->project;
	}
	
	function getName() {
		return $this->name;
	}

    function remove(){
        echo "removeing map";
        $map_points = MapPoints::loadMapPoints($this->id);
        $map_points->remove();
        $query = "DELETE FROM `maps` WHERE id=".$this->id;
        echo $query;
        $results = $this->database->query($query);
    }
}
?>
