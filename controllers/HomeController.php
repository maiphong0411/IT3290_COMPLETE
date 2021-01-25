<?php
    require_once 'controllers/Controller.php';
    require_once 'models/Product.php';
    require_once 'models/Category.php';
    require_once 'models/Pagination.php';
    require_once 'models/User.php';
    require_once 'models/Rent.php';
    class HomeController extends Controller
    {
        public function index()
        {
            
            $product_model = new Product();
        //    var_dump($product_model);
            $count_total = $product_model->countTotal();
            $query_additional = '';
            $params = [
                'total' => $count_total,
                'limit' => 15,
                'query_string' => 'page',
                'controller' => 'home',
                'action' => 'index',
                'full_mode' => false,
                'query_additional' => $query_additional,
                'page' => isset($_GET['page']) ? $_GET['page'] : 1
            ];
            $pagination = new Pagination($params);
            $pages = $pagination->getPagination();
            $products = $product_model->getAllPagination($params);

            $this->content = $this->render('views/home/index.php', [
                'products' => $products,
                'pages' => $pages,
            ]);
        //   require_once 'views/home/layout.php';
        
           require_once 'views/home/home_layout.php';
        }

        public function search()
    	{
		$product_model = new Product();
		$count_total = $product_model->countTotal();
		$query_additional = '';
		if (isset($_GET['title'])) {
		$query_additional .= '&title=' . $_GET['title'];
		}
		if (isset($_GET['max_people'])) {
		    $query_additional .= '&max_people=' . $_GET['max_people'];
		}
		if (isset($_GET['city'])) {
		    $query_additional .= '&city=' . $_GET['city'];
		}
		if (isset($_GET['parking'])) {
		    $query_additional .= '&parking=' . $_GET['parking'];
		}
		if (isset($_GET['heater'])) {
		    $query_additional .= '&heater=' . $_GET['heater'];
		}
		if (isset($_GET['aircondition'])) {
		    $query_additional .= '&aircondition=' . $_GET['aircondition'];
		}
		if (isset($_GET['type_room'])) {
		    $query_additional .= '&type_room=' . str_replace('+',' ', $_GET['type_room']);
		}
		if (isset($_GET['price'])) {
		    $query_additional .= '&price=' . $_GET['price'];
		}
		if (isset($_GET['area'])) {
		    $query_additional .= '&area=' . $_GET['area'];
		}
		$params = [
		    'total' => $count_total,
		    'limit' => 15,
		    'query_string' => 'page',
		    'controller' => 'home',
		    'action' => 'index',
		    'full_mode' => false,
		    'query_additional' => $query_additional,
		    'page' => isset($_GET['page']) ? $_GET['page'] : 1
		];
		$pagination = new Pagination($params);
		$pages = $pagination->getPagination();
		$products = $product_model->getAllPagination($params);
		$this->content = $this->render('views/home/index.php', [
		    'products' => $products,
		    'pages' => $pages,
		]);
        require_once 'views/home/home_layout.php';
    }

        public function detail()
        {
            if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                $_SESSION['error'] = 'ID không hợp lệ';
                header('Location: index.php?controller=home');
            exit();
            }

            $id = $_GET['id'];
            //echo $roomid;
            $product_model = new Product();
            $product = $product_model->getById($id);
            //var_dump ($_POST);
            if(isset($_POST['care'])){
                $roomid = $_GET['id'];
              //  echo '</br> '. $roomid; 
                $renterid = $_SESSION['user']['id'];
               // echo '</br> '. $renterid; 
                $care = $_POST['care'];
              //  echo '</br> '. $care; 
                $rent_model = new Rent();
                $rent_model->roomid = $roomid;
                $rent_model->renterid = $renterid;
                $rent_model->care = $care;
                
                if($care == 1){
                    if(!empty($rent_model->findRoom_Renter($roomid,$renterid))){
                        $rent_model->updateCare();
                    }else{
                        $rent_model->insertRent();
                    }
                }else{
                    if(!empty($rent_model->findRoom_Renter($roomid,$renterid))){
                        $rent_model->updateCare();
                    }else{
                        $rent_model->insertRent();
                    }
                }
            }
            $this->content = $this->render('views/home/home_detail.php', [
                'product' => $product
            ]);
            require_once 'views/home/home_layout.php';
        }


        public function update() {
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
                           header('Location: index.php?controller=home');
                           exit();
                       }
                   }
           
                   $this->content = $this->render('views/home/home_update.php', [
                       'user' => $user
                   ]);
           
                   require_once 'views/home/home_layout.php';
               }
        public function userCare()
        {
            $roomid = $_GET['id'];
            $renterid = $_SESSION['user']['id'];
            $care = $_POST['care'];
            $rent_model->roomid = $roomid;
            $rent_model->renterid = $renterid;
            $rent_model->care = $care;
            $rent_model = new Rent();
            if($care == 1){
                if($rent_model->findRoom_Renter()){
                    $rent_model->updateCare();
                }else{
                    $rent_model->insertRent();
                }
            }
            else{
                if($rent_model->findRoom_Renter()){
                    $rent_model->updateCare();
                }else{
                    $rent_model->insertRent();
                }
            }
        }

    }
?>
