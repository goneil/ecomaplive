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
        if ($this->map_exists($name, $project)){
            // load map
            $this->id = $this->id_from_name_project($name, $project)->id;
        }
        $this->isPrivate = $isPrivate;
        $this->name = $name;
        $this->project = $project;
	}

    function map_exists($name, $project){
        return (false !== $this->id_from_name_project($name, $project));
        
    }

    function id_from_name_project($name, $project){
		$query = "SELECT id FROM `maps` WHERE `name` = '$name' AND `project`" .
                 "= $project";
		$info = $this->database->query($query);
        if ($info){
            $row = $info->fetch_array();
            return $row['id'];
        }
        return false;
        
    }

    //TODO make sure correct
    function exportToDB(){
		$query = "INSERT INTO `maps` VALUES(DEFAULT, '$this->name',
                 '$this->project', '$this->isPrivate')";
		$this->database->query($query);
        //TODO is this how to set id?
		$this->id = $this->database->getConnection()->insert_id;
    }


    /** TODO implement function
      * @returns new Map loaded from the database
      * @params id {int}
      */
	static function loadMap($id) {
		$database = new Database();
		$query = "SELECT * FROM `maps` WHERE `id` = '$id'";
		$info = $database->query($query)->fetch_array();
		$isPrivate = $info['private'];
		$name = $info['name'];
		$project = $info['project'];
        $map = (new Map($name, $project, $isPrivate, $points));
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
	
	function getProject() {
		return $this->project;
	}
	
	function getName() {
		return $this->name;
	}
}
?>
