<?php
require_once 'models/Model.php';
class User extends Model {
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $dob;
    public $avatar;
    public $city;
    public $home_number;
    public $street;
    public $district;
    public $job;
    public $gender;
    public $role;
    public $str_search;
    public function __construct() {
        parent::__construct();
        if (isset($_GET['username']) && !empty($_GET['username'])) {
            $username = addslashes($_GET['username']);
            $this->str_search .= " AND account.username LIKE '%$username%'";
        }
        if (isset($_GET['role']) && !empty($_GET['role'])) {
            $this->str_search .= " AND account.role = {$_GET['role']}";
        }
        if (isset($_GET['job']) && !empty($_GET['job'])) {
            $job = addslashes($_GET['job']);
            $this->str_search .= " AND profile.job ILIKE '%$job%'";
        }
        if (isset($_GET['city']) && !empty($_GET['city'])) {
            if ($_GET['city'] == 1) 
                $this->str_search .= " AND profile.city = 'Ha noi'";
            elseif ($_GET['city'] == 2)
                $this->str_search .= " AND profile.city = 'TP HCM'";
        }
        if (isset($_GET['gender']) && !empty($_GET['gender'])) {
            $this->str_search .= " AND profile.gender = '{$_GET['gender']}'";
        }
        if (isset($_GET['start']) && !empty($_GET['start'])) {
            $this->str_search .= " AND to_char(profile.dob, 'yyyy') >= '{$_GET['start']}'";
        }
        if (isset($_GET['end']) && !empty($_GET['end'])) {
            $this->str_search .= " AND to_char(profile.dob, 'yyyy') <= '{$_GET['end']}'";
        }
    }

    public function getAll() {
        $obj_select = $this->connection
            ->prepare("SELECT profile.*, account.username FROM profile JOIN account ON account.id = profile.id WHERE account.role <> 0");
        $arr_select = [];
        $obj_select->execute($arr_select);
        $users = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function getAllPagination($params = []) {
        $limit = $params['limit'];
        $page = $params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT profile.*, account.username, account.account_start, account.role FROM profile JOIN account ON account.id = profile.id WHERE account.role <> 0 $this->str_search
                ORDER BY account.account_start DESC LIMIT $limit OFFSET $start");

        $obj_select->execute();
        $users = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function getTotal() {
        $obj_select = $this->connection
            ->prepare("SELECT COUNT(profile.id) FROM profile JOIN account ON profile.id = account.id WHERE account.role <> 0 $this->str_search");
        $obj_select->execute();
        return $obj_select->fetchColumn();
    }

    public function getId($username, $password, $role) {
       $obj_select = $this->connection
            ->prepare("SELECT id FROM account WHERE username=:username AND password=:password AND role=:role LIMIT 1");
        $arr_select = [
            ':username' => $username,
            ':password' => $password,
            ':role' => $role
        ];
        $obj_select->execute($arr_select);

        $id = $obj_select->fetch(PDO::FETCH_ASSOC);

        return $id;
    }


    public function getById($id) {
        $obj_select = $this->connection
            ->prepare("SELECT profile.*, account.username, account.role,account.account_start FROM profile JOIN account ON account.id = profile.id WHERE account.id = $id");
        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByUsername($username) {
        $obj_select = $this->connection
            ->prepare("SELECT COUNT(id) FROM account WHERE username='$username'");
        $obj_select->execute();
        return $obj_select->fetchColumn();
    }

    public function updateRole($id, $role) {
        $obj_update = $this->connection
            ->prepare("UPDATE account SET role='$role' WHERE id = $id");
        $obj_update->execute($arr_update);
        return $obj_update->execute($arr_update);
    }

    public function insert() {
        $obj_insert = $this->connection
            ->prepare("INSERT INTO profile(id, first_name, last_name, phone, home_number, dob, street, district, job, city, email, avatar, gender)
VALUES(:id, :first_name, :last_name, :phone, :home_number, :dob, :street, :district, :job, :city, :email, :avatar, :gender)");
        $arr_insert = [
            ':id' => $this->id,
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':phone' => $this->phone,
            ':home_number' => $this->home_number,
            ':street' => $this->street,
            ':district' => $this->district,
            ':dob' => $this->dob,
            ':email' => $this->email,
            ':avatar' => $this->avatar,
            ':city' => $this->city,
            ':job' => $this->job,
            ':gender' => $this->gender,
        ];
        return $obj_insert->execute($arr_insert);
    }

    public function update($id) {
        $obj_update = $this->connection
            ->prepare("UPDATE profile SET first_name=:first_name, last_name=:last_name, phone=:phone, 
            home_number=:home_number, district=:district,street=:street,dob=:dob, city=:city, email=:email, avatar=:avatar, job=:job, gender=:gender WHERE id = $id");
        $arr_update = [
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':phone' => $this->phone,
            ':home_number' => $this->home_number,
            ':district' => $this->district,
            ':street' => $this->street,
            ':dob' => $this->dob,
            ':city' => $this->city,
            ':email' => $this->email,
            ':avatar' => $this->avatar,
            ':job' => $this->job,
            ':gender' => $this->gender,
        ];
        $obj_update->execute($arr_update);

        return $obj_update->execute($arr_update);
    }
    public function delete($id)
    {
        $obj_delete = $this->connection
            ->prepare("DELETE FROM account WHERE id = $id");
        return $obj_delete->execute();
    }

    public function getUserByUsernameAndPassword($username, $password, $role) {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM account WHERE username=:username AND password=:password AND role=:role LIMIT 1");
        $arr_select = [
            ':username' => $username,
            ':password' => $password,
            ':role' => $role
        ];
        $obj_select->execute($arr_select);

        $user = $obj_select->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function getUserInUsername($username)
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM account WHERE username=:username LIMIT 1");
        $arr_select = [
            ':username' => $username,
        ];
        $obj_select->execute($arr_select);

        $user = $obj_select->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function insertRegister() {
        $obj_insert = $this->connection
            ->prepare("INSERT INTO account(username, password, role)
VALUES(:username, :password, :role)");
        $arr_insert = [
            ':username' => $this->username,
            ':password' => $this->password,
            ':role' => $this->role
        ];
        return $obj_insert->execute($arr_insert);
        
    }
    public function checkCredential($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM profile WHERE id=:id LIMIT 1");
        $arr_select = [
            ':id' => $id,
        ];
        $obj_select->execute($arr_select);

        $user = $obj_select->fetch(PDO::FETCH_ASSOC);

        return $user;
    }
    public function insertProfile()
    {
        $obj_insert = $this->connection
            ->prepare("INSERT INTO profile(id,first_name,last_name,email,phone,dob,job,city,home_number,street,district,gender) VALUES (:id,:first_name,:last_name,:email,:phone,:dob,:job,:city,:home_number,:street,:district,:gender)");
        $arr_insert = [
            ':id' => $this->id,
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':email' => $this->email,
            ':phone' => $this->phone,
            ':dob' => $this->dob,
            ':job' => $this->job,
            ':city' => $this->city,
            ':home_number' => $this->home_number,
            ':street' => $this->street,
            ':district' => $this->district,
            ':gender' => $this->gender
        ];
        $obj_insert->execute($arr_insert);
        return $obj_insert->execute($arr_insert);    
    }
    public function getMyUser($id)
    {
        $obj_get = $this->connection
            ->prepare("SELECT * FROM profile 
                WHERE id IN (
                SELECT renterid
                FROM rent
                WHERE roomid IN (SELECT roomid FROM room WHERE tenantid = $id))");
        $obj_get->execute();
        $myuser = $obj_get->fetchAll(PDO::FETCH_ASSOC);
        return $myuser;
    }

}
?>
