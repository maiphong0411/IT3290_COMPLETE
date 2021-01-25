<?php
    require_once 'controllers/Controller.php';
    require_once 'models/Product.php';
    require_once 'models/Pagination.php';
    require_once 'models/User.php';
    require_once 'models/Rent.php';
    class ManageController extends Controller
    {
        public function index()
        {
        //    print_r($_SESSION);

            $product_model = new Product();
            $id = $_SESSION['user']['id'];
        //    echo $id;
            $products = $product_model->getMyRoom($id);
        //    var_dump($products);
            $this->content = $this->render('views/manage/index.php', [
                'products' => $products,
                'pages' => $pages,
            ]);
        //   require_once 'views/home/layout.php';
        
           require_once 'views/manage/manage_layout.php';
        }
        public function myuser()
        {
        //    print_r($_SESSION);
            $user_model = new User();
            $id = $_SESSION['user']['id'];
            $users = $user_model->getMyUser($id);
        //    print_r($users);
            $this->content = $this->render('views/manage/manage_user.php', [
                'users' => $users,
                'pages' => $pages,
            ]);
        //   require_once 'views/home/layout.php';
        
           require_once 'views/manage/manage_layout.php';
        }

        public function update()
        {  
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['error'] = 'ID không hợp lệ';
        header('Location: index.php?controller=manage');
        exit();
        }

        $id = $_GET['id'];
        $product_model = new Product();
        $product = $product_model->getById($id);
        if (isset($_POST['submit'])) {
        $city = $_POST['city'];
        $street = $_POST['street'];
        $home_number = $_POST['home_number'];
        $district = $_POST['district'];
        $max_people = $_POST['max_people'];
        $parking = $_POST['parking'];
        $time = $_POST['time'];
        $wc_type = $_POST['wc_type'];
        $heater = $_POST['heater'];
        $aircondition = $_POST['aircondition'];
        $description = $_POST['description'];
        $state = $_POST['state'];
        $price = $_POST['price'];
        $type_room = $_POST['type_room'];
        $area = $_POST['area'];
        $date_start = $_POST['date_start'];
        $expire = $_POST['expire'];

        if (empty($this->error)) {
            $product_model->city = $city;
            $product_model->street = $street;
            $product_model->home_number = $home_number;
            $product_model->district = $district;
            $product_model->max_people = $max_people;
            $product_model->parking = $parking;
            $product_model->time = $time;
            $product_model->wc_type = $wc_type;
            $product_model->heater = $heater;
            $product_model->aircondition = $aircondition;
            $product_model->description = $description;
            $product_model->state = $state;
            $product_model->price = $price;
            $product_model->type_room = $type_room;
            $product_model->area = $area;
            $product_model->date_start = $date_start;
            $product_model->expire = $expire;
            $is_update = $product_model->update($id);
            if ($is_update) {
            $_SESSION['success'] = 'Update dữ liệu thành công';
            } else {
            $_SESSION['error'] = 'Update dữ liệu thất bại';
            }
            header('Location: index.php?controller=manage');
            exit();
        }
        }

        $this->content = $this->render('views/manage/manage_update.php', [
            'product' => $product,
        ]);
        require_once 'views/manage/manage_layout.php';
        }

     
        public function detail()
        {
            //if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            //$_SESSION['error'] = 'ID không hợp lệ';
            //header('Location: index.php?controller=manage');
            //exit();
            //}

            $id = $_GET['id'];
            $product_model = new Product();
            $product = $product_model->getById($id);

            $this->content = $this->render('views/manage/manage_detail.php', [
                'product' => $product
            ]);
            require_once 'views/manage/manage_layout.php';
        }

    

        public function updateroom()
        {
            if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=manage');
            exit();
            }
            $id = $_GET['id'];
            $tenantid = $_SESSION['user']['id'];
            $product_model = new Product();
            $product = $product_model->getById($id);
            if (isset($_POST['submit'])) {
                $city = $_POST['city'];
                $street = $_POST['street'];
                $home_number = $_POST['home_number'];
                $district = $_POST['district'];
                $max_people = $_POST['max_people'];
                $parking = $_POST['parking'];
                $time = $_POST['time'];
                $wc_type = $_POST['wc_type'];
                $heater = $_POST['heater'];
                $aircondition = $_POST['aircondition'];
                $description = $_POST['description'];
                $state = $_POST['state'];
                $price = $_POST['price'];
                $type_room = $_POST['type_room'];
                $area = $_POST['area'];

            if (empty($this->error)) {
                $product_model->city = $city;
                $product_model->street = $street;
                $product_model->home_number = $home_number;
                $product_model->district = $district;
                $product_model->max_people = $max_people;
                $product_model->parking = $parking;
                $product_model->time = $time;
                $product_model->wc_type = $wc_type;
                $product_model->heater = $heater;
                $product_model->aircondition = $aircondition;
                $product_model->description = $description;
                $product_model->state = $state;
                $product_model->price = $price;
                $product_model->type_room = $type_room;
                $product_model->area = $area;
                $product_model->tenantid = $tenantid;
                $is_update = $product_model->insertRoom();
                if ($is_update) {
                $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: index.php?controller=manage');
                exit();
        }
        }

        $this->content = $this->render('views/manage/manage_updateroom.php',[
            'product' => $product
        ]);
        require_once 'views/manage/manage_layout.php';
    }

    public function create_room()
    {  
        $id = $_SESSION['user']['id'];
        $product_model = new Product();
        echo $id . ' id </br>';
        if (isset($_POST['submit'])) {
            $city = $_POST['city'];
            echo $city . ' city</br>';
            $street = $_POST['street'];
            echo $street . ' street</br>';
            $home_number = $_POST['home_number'];
            echo $home_number . ' home number</br>';
            $district = $_POST['district'];
            echo $district . ' district</br>';
            $max_people = $_POST['max_people'];
            echo $max_people . ' max</br>';
            $parking = $_POST['parking'];
            echo $parking . ' parking</br>';
            $time = $_POST['time'];
            echo $time . ' time</br>';
            $wc_type = $_POST['wc_type'];
            echo $wc_type . ' wc</br>';
            $heater = $_POST['heater'];
            echo $heater . ' heater</br>';
            $aircondition = $_POST['aircondition'];
            echo $aircondition . ' air</br>';
            $description = $_POST['description'];
            echo $description . ' des</br>';
            $state = $_POST['state'];
            echo $state . ' state</br>';
            $price = $_POST['price'];
            echo $price . ' price</br>';
            $type_room = $_POST['type_room'];
            echo $type_room . ' type</br>';
            $area = $_POST['area'];
            echo $area . ' area</br>';
            echo $expire . ' ex</br>';
            if (empty($this->error)) {
                $product_model->city = $city;
                $product_model->street = $street;
                $product_model->home_number = $home_number;
                $product_model->district = $district;
                $product_model->max_people = $max_people;
                $product_model->parking = $parking;
                $product_model->time = $time;
                $product_model->wc_type = $wc_type;
                $product_model->heater = $heater;
                $product_model->aircondition = $aircondition;
                $product_model->description = $description;
                $product_model->state = $state;
                $product_model->price = $price;
                $product_model->type_room = $type_room;
                $product_model->area = $area;
                $product_model->id = $id;
                $is_insert = $product_model->insertRoom();
                echo '30';
                if ($is_insert) {
                    $_SESSION['success'] = 'Insert dữ liệu thành công';
                    echo '</br>thanh cong'; 
                } else {
                    $_SESSION['error'] = 'Insert dữ liệu thất bại';
                    echo '</br>0';
                }
                header('Location: index.php?controller=manage');
                exit();
            }
            }

            $this->content = $this->render('views/manage/manage_create.php', [
                'product' => $product,
            ]);
            require_once 'views/manage/manage_layout.php';
        }    
    
        public function updatemanager() {
            //        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            //          header("Location: index.php?controller=home");
                //       exit();
                //  }
                    $user_model = new User();
                    $id = $_SESSION['user']['id'];
                    $user = $user_model->getById($id);
                    if (isset($_POST['submit'])) {
                        $first_name = $_POST['first_name'];
                        $last_name = $_POST['last_name'];
                        $street = $_POST['street'];
                        $district = $_POST['district'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $home_number = $_POST['home_number'];
                        $district = $_POST['district'];
                        $city = $_POST['city'];
                        $job = $_POST['job'];
                        $gender = $_POST['gender'];
                        $dob = $_POST['dob'];
                        $role = $_POST['role'];
                        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $this->error = 'Email không đúng định dạng';
                        } else if ($_FILES['avatar']['error'] == 0) {
                            $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                            $extension = strtolower($extension);
                            $allow_extensions = ['png', 'jpg', 'jpeg', 'gif'];
                            $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                            $file_size_mb = round($file_size_mb, 2);
                            if (!in_array($extension, $allow_extensions)) {
                                $this->error = 'Phải upload avatar dạng ảnh';
                            } else if ($file_size_mb > 2) {
                                $this->error = 'File upload không được lớn hơn 2Mb';
                            }
                        }
            
                        //xủ lý lưu dữ liệu khi biến error rỗng
                        if (empty($this->error)) {
                            $filename = $user['avatar'];
                            //xử lý upload ảnh nếu có
                            if ($_FILES['avatar']['error'] == 0) {
                                $dir_uploads = __DIR__ . '/../assets/uploads';
                                //xóa file ảnh đã update trc đó
                                @unlink($dir_uploads . '/' . $filename);
                                if (!file_exists($dir_uploads)) {
                                    mkdir($dir_uploads);
                                }
            
                                $filename = time() . '-user-' . $_FILES['avatar']['name'];
                                move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                            }
                            //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                            $user_model->first_name = $first_name;
                            $user_model->last_name = $last_name;
                            $user_model->phone = $phone;
                            $user_model->street = $street;
                            $user_model->home_number = $home_number;
                            $user_model->email = $email;
                            $user_model->avatar = $filename;
                            $user_model->job = $job;
                            $user_model->district = $district;
                            $user_model->city = $city;
                            $user_model->gender = $gender;
                            $user_model->dob = $dob;
                            $is_update_role = $user_model->updateRole($id, $role);
                            $is_update = $user_model->update($id);
                            if ($is_update) {
                                $_SESSION['success'] = 'Update dữ liệu thành công';
                            } else {
                                $_SESSION['error'] = 'Update dữ liệu thất bại';
                            }
                            header('Location: index.php?controller=manage');
                            exit();
                        }
                    }
            
                    $this->content = $this->render('views/manage/manage_update.php', [
                        'user' => $user
                    ]);
            
                    require_once 'views/manage/manage_layout.php';
                }
        
        public function render_care()
        {
            $rent_model = new Rent(); 
            $renters = $rent_model->getCare($_SESSION['user']['id']);
            $this->content = $this->render('views/manage/manage_care.php',[
                'renters' => $renters
            ]);

            require_once 'views/manage/manage_layout.php';
        }
    }
?>
