<?php
class PlotPoints {
	private $plot_id;
	private $point_id_list;
	private static $database;
	
	function __construct($plot_id, $point_id_list) {
		$this->construct($plot_id, $point_id_list);
	}


	function construct($plot_id, $point_id_list) {
		$this->database = new Database();
        $this->plot_id = $plot_id;
		$this->point_id_list = $point_id_list;
	}

    //TODO make sure correct
    function exportToDB(){
        foreach($this->point_id_list as $point_id){
		    $query = "INSERT INTO `plotpoints` VALUES($this->plot_id,
                     $point_id)";
            $this->database->query($query);
        }
    }
    
    function getPoints(){
        return $this->point_id_list;
    }


	public static function loadPlotPoints($plot_id) {
        $database = new Database();
        $query = "SELECT * FROM `plotpoints` WHERE `plot_id` = '$plot_id'";
        $info = $database->query($query);
        $point_id_list = array();
        if ($info){
            while($row = $info->fetch_array()){
                array_push($point_id_list, $row['point_id']);
            }
            return new PlotPoints($plot_id, $point_id_list);
        } else{
            echo "no plotpoints with id: " . $plot_id;
        }
	}
    function remove(){
        $query = "DELETE FROM `plotpoints` WHERE plot_id=".$this->plot_id;
        $results = $this->database->query($query);

    }
}
?>
