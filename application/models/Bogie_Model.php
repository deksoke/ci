<?php
class Bogie_Model extends My_CI_Model {
    public function __construct()
    {
        parent::__construct("dt_bogie", "ID");
    }

    public function GetBogiesUsage_By_RailTypeId($id){
        $sql = "select * from dt_bogie where ID in (select BOGIE_ID from dt_railtype_bogies where RAILTYPE_ID = ".$id.")";
        $query = $this->db->query($sql)->result();
        return $query;
    }
}