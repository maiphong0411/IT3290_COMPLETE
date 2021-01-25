<?php
require_once 'models/Model.php';
class District extends Model {
    public function getCities() {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM tinh");
        $obj_select->execute();
        $cities = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $cities;
    }

    public function getDistricts() {
        $obj_select = $this->connection
            ->prepare("SELECT huyen.*, tinh.id FROM huyen JOIN tinh ON huyen.tinh_id = tinh.id");
        $obj_select->execute();
        $districts = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $districts;
    }

}