<?php
require_once 'models/Model.php';

class Product extends Model
{

    public $id;
    public $city;
    public $home_number;
    public $street;
    public $district;
    public $max_people;
    public $parking;
    public $time;
    public $wc_type;
    public $heater;
    public $aircondition;
    public $description;
    public $state;
    public $price;
    public $type_room;
    public $area;
    public $date_start;
    public $expire;
    /*
     * Chuỗi search, sinh tự động dựa vào tham số GET trên Url
     */
    public $str_search = '';

    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['title']) && !empty($_GET['title'])) {
            $this->str_search .= " AND profile.first_name ILIKE '%{$_GET['title']}%'";
        }
        if (isset($_GET['max_people']) && !empty($_GET['max_people'])) {
            if ($_GET['max_people'] == 1) 
            $this->str_search .= " AND room.max_people BETWEEN 1 AND 5";
            elseif ($_GET['max_people'] == 2)
            $this->str_search .= " AND room.max_people BETWEEN 5 AND 10";
        }
        if (isset($_GET['city']) && !empty($_GET['city'])) {
            if ($_GET['city'] == 1) 
                $this->str_search .= " AND room.city = 'Ha noi'";
            elseif ($_GET['city'] == 2)
                $this->str_search .= " AND room.city = 'TP HCM'";
        }
        if (isset($_GET['parking']) && !empty($_GET['parking'])) {
            if ($_GET['parking'] == 1)
            $this->str_search .= " AND room.parking = 1";
            else 
            $this->str_search .= " AND room.parking = 0";

        }
        if (isset($_GET['heater']) && !empty($_GET['heater'])) {
            if ($_GET['heater'] == 1)
                $this->str_search .= " AND room.heater = 1";
            else 
                $this->str_search .= " AND room.heater = 0";
        }
        if (isset($_GET['aircondition']) && !empty($_GET['aircondition'])) {
            if ($_GET['aircondition'] == 1)
            $this->str_search .= " AND room.aircondition = 1";
            else 
            $this->str_search .= " AND room.aircondition = 0";

        }
        if (isset($_GET['type_room']) && !empty($_GET['type_room'])) {
            $this->str_search .= " AND room.type_room ILIKE '{$_GET['type_room']}'";
        }
        if (isset($_GET['price']) && !empty($_GET['price'])) {
            if ($_GET['price'] == 1)
                $this->str_search .= " AND room.price < 5000000";
            elseif ($_GET['price'] == 2)
                $this->str_search .= " AND room.price BETWEEN 5000000 AND 10000000";
            elseif ($_GET['price'] == 3)
                $this->str_search .= " AND room.price > 10000000";
        }
        if (isset($_GET['area']) && !empty($_GET['area'])) {
            if ($_GET['area'] == 1)
                $this->str_search .= " AND room.area < 40";
            elseif ($_GET['area'] == 2)
                $this->str_search .= " AND room.area BETWEEN 40 AND 70";
            elseif ($_GET['area'] == 3)
                $this->str_search .= " AND room.area BETWEEN 70 AND 100";
            else if ($_GET['area'] == 4)
                $this->str_search .= " AND room.area > 100";
        }
        if (isset($_GET['date_start']) && !empty($_GET['date_start'])) {
            $this->str_search .= " AND room.date_start >= '{$_GET['date_start']}'";
        }
        if (isset($_GET['expire']) && !empty($_GET['expire'])) {
            $this->str_search .= " AND room.expire <= '{$_GET['expire']}'";
        }
        
    }

    /**
     * Lấy thông tin của sản phẩm đang có trên hệ thống
     * @return array
     */
    public function getAll()
    {
        $obj_select = $this->connection
            ->prepare("SELECT room.*, profile.first_name, profile.last_name JOIN profile ON profile.id = room.tenantid
                        WHERE TRUE $this->str_search
                        ORDER BY room.date_start DESC
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    /**
     * Lấy thông tin của sản phẩm đang có trên hệ thống
     * @param array Mảng các tham số phân trang
     * @return array
     */
    public function getAllPagination($arr_params)
    {
        $limit = $arr_params['limit'];
        $page = $arr_params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT room.*, profile.first_name, profile.last_name FROM room JOIN profile ON profile.id = room.tenantid
                        WHERE TRUE $this->str_search
                        ORDER BY room.date_start DESC
                        LIMIT $limit OFFSET $start
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    /**
     * Tính tổng số bản ghi đang có trong bảng products
     * @return mixed
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(roomid) FROM room WHERE TRUE $this->str_search");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }

    /**
     * Insert dữ liệu vào bảng products
     * @return bool
     */
    public function insert()
    {
        $obj_insert = $this->connection
            ->prepare("INSERT INTO products(category_id, title, avatar, price, amount, summary, content, seo_title, seo_description, seo_keywords, status) 
                                VALUES (:category_id, :title, :avatar, :price, :amount, :summary, :content, :seo_title, :seo_description, :seo_keywords, :status)");
        $arr_insert = [
            ':category_id' => $this->category_id,
            ':title' => $this->title,
            ':avatar' => $this->avatar,
            ':price' => $this->price,
            ':amount' => $this->amount,
            ':summary' => $this->summary,
            ':content' => $this->content,
            ':seo_title' => $this->seo_title,
            ':seo_description' => $this->seo_description,
            ':seo_keywords' => $this->seo_keywords,
            ':status' => $this->status,
        ];
        return $obj_insert->execute($arr_insert);
    }

    /**
     * Lấy thông tin sản phẩm theo id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT room.*, profile.first_name, profile.last_name FROM room JOIN profile ON profile.id = room.tenantid
            WHERE room.roomid = $id");

        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }


    public function update($id)
    {
        $obj_update = $this->connection
            ->prepare("UPDATE room SET city=:city, home_number=:home_number, district=:district, street=:street,price=:price,max_people=:max_people,
               parking=:parking, time=:time, wc_type=:wc_type, heater=:heater, aircondition=:aircondition,description=:description,
            state=:state, type_room=:type_room, area=:area, date_start=:date_start, expire=:expire
            WHERE roomid = $id
");
        $arr_update = [
            ':city' => $this->city,
            ':home_number' => $this->home_number,
            ':street' => $this->street,
            ':district' => $this->district,
            ':price' => $this->price,
            ':max_people' => $this->max_people,
            ':parking' => $this->parking,
            ':time' => $this->time,
            ':wc_type' => $this->wc_type,
            ':heater' => $this->heater,
            ':aircondition' => $this->aircondition,
            ':description' => $this->description,
            ':state' => $this->state,
            ':type_room' => $this->type_room,
            ':area' => $this->area,
            ':date_start' => $this->date_start,
            ':expire' => $this->expire,
        ];
        return $obj_update->execute($arr_update);
    }

    public function delete($id)
    {
        $obj_delete = $this->connection
            ->prepare("DELETE FROM room WHERE roomid = $id");
        return $obj_delete->execute();
    }
    public function getMyRoom($id)
    {
        $obj_get = $this->connection
            ->prepare("SELECT * FROM room WHERE tenantid = $id");
        $obj_get->execute();
        $myrom = $obj_get->fetchAll(PDO::FETCH_ASSOC);
        return $myrom;
    }

    public function insertRoom()
    {
        $arr_insert = [
            ':city' => $this->city,
            ':home_number' => $this->home_number,
            ':street' => $this->street,
            ':district' => $this->district,
            ':max_people' => $this->max_people,
            ':parking' => $this->parking,
            ':time' => $this->time,
            ':wc_type' => $this->wc_type,
            ':heater' => $this->heater,
            ':aircondition' => $this->aircondition,
            ':description' => $this->description,
            ':price' => $this->price,
            ':type_room' => $this->type_room,
            ':area' => $this->area,
            ':tenantid' => $this->id
        ];
        return $is_insert = $this->connection->prepare("INSERT INTO room(city,home_number,street,district,max_people,parking,time,wc_type,heater,aircondition,description,price,type_room,area,tenantid) 
            VALUES (:city,:home_number,:street,:district,:max_people,:parking,:time,:wc_type,:heater,:aircondition,:description,:price,:type_room,:area,:tenantid)")->execute($arr_insert);
           
    }
}