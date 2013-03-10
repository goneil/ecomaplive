<?php
class MapPoints {
	private $map_id;
	private $point_id_list;
	private static $database;
	
	function __construct($map_id, $point_id_list) {
		$this->construct($map_id, $point_id_list);
	}


	function construct($map_id, $point_id_list) {
		$this->database = new Database();
        $this->map_id = $map_id;
		$this->point_id_list = $point_id_list;
	}

    //TODO make sure correct
    function exportToDB(){
        foreach($this->point_id_list){
		    $query = "INSERT INTO `mappoints` VALUES($this->map_id,
                     $point_id)";
            $this->database->query($query);
        }
    }


	public static function loadMapPoints($map_id) {
        $database = new Database();
        $query = "SELECT * FROM `mappoints` WHERE `map` = '$map_id'";
        $info = $database->query($query);
        if ($info){
            while($row = $info->fetch_array()){
                array_push($this->point_id_list, $row['point_id']);
            }
        } else{
            echo "no mappoints with id: " . $map_id;
        }
	}
}
?>
