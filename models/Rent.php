<?php
    require_once 'models/Model.php';

    class Rent extends Model
    {
        public $roomid;
        public $renterid;
        public $care;

        public function insertRent()
        {
            $arr_insert = [
                ':roomid' =>$this->roomid,
                ':renterid' => $this->renterid,
                ':care' =>$this->care
            ];

            $sql = "INSERT INTO rent(roomid,renterid,care) VALUES (:roomid,:renterid,:care)";
            $obj = $this->connection->prepare($sql);
            return $obj->execute($arr_insert);
        }

        public function updateCare()
        {
            $sql = 'UPDATE rent SET care=:care WHERE roomid = :roomid AND renterid = :renterid ';
            $arr_update = [
                ':roomid' => $this->roomid,
                ':renterid' => $this->renterid,
                ':care' => $this->care
            ];
            $obj = $this->connection->prepare($sql)->execute($arr_update);
            return $obj; 
        }

        public function findRoom_Renter($roomid,$renterid)
        {
            $sql = "SELECT * FROM rent WHERE roomid=$roomid AND renterid=$renterid";
            $obj_get = $this->connection->prepare($sql);
            $obj_get->execute();
            $has = $obj_get->fetchAll(PDO::FETCH_ASSOC);
            return $has;
        }

        public function getCare($id)
        {
            $sql = "SELECT * FROM rent JOIN  profile ON renterid = id WHERE care = 1 AND roomid IN (SELECT roomid FROM room WHERE tenantid = $id)";
            $obj_get = $this->connection->prepare($sql);
            $obj_get->execute();
            $has = $obj_get->fetchAll(PDO::FETCH_ASSOC);
            return $has;
        }   
    }
?>
