<?php

class Bogie_Model extends My_CI_Model
{
    public function __construct()
    {
        parent::__construct("dt_bogie", "ID");
    }

    public function GetBogies_By_RailTypeId($id, $allbogie, $withselect)
    {
        $sql = "select 0 isSelected,";
        if ($withselect && $allbogie)
            $sql = "select CASE WHEN ifnull(b.BOGIE_ID,0) > 0 THEN 1 ELSE 0 END AS isSelected,";
        $sql .= " a.ID BOGIE_ID, a.BOGIE_NAME_TH, a.BOGIE_NAME_EN, a.BOGIE_SHORT_NAME_TH, a.BOGIE_SHORT_NAME_EN";

        if ($allbogie == true) {
            $sql .= " from dt_bogie a left join dt_railtype_bogies b on b.BOGIE_ID = a.ID and b.RAILTYPE_ID = " . $id;
        } else {
            $sql .= " from dt_bogie a where a.ID in (select BOGIE_ID from dt_railtype_bogies where RAILTYPE_ID = " . $id . ")";
        }

        $query = $this->db->query($sql)->result();
        return $query;
    }
}