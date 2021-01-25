<?php
require_once 'models/User.php';

class LoginController
{
    //chứa nội dung view
    public $content;
    //chứa nội dung lỗi validate
    public $error;

    /**
     * @param $file string Đường dẫn tới file
     * @param array $variables array Danh sách các biến truyền vào file
     * @return false|string
     */
    public function render($file, $variables = []) {
        extract($variables);
        ob_start();
        require_once $file;
        $render_view = ob_get_clean();

        return $render_view;
    }

    public function index() {
        if (isset($_SESSION['user'])) {
            header('Location: index.php?controller=login&action=index');
            exit();
        }
        if (isset($_POST['submit'])) {
            if ( isset($_POST['role'])) $role = $_POST['role'];
            else if (!isset($_POST['role'])) $role = 0;
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (empty($username) || empty($password)) {
                $this->error = 'Username hoặc password không được để trống';
            }
            $user_model = new User();
            if (empty($this->error)) {
                $user = $user_model->getUserByUsernameAndPassword($username, $password, $role);
                if (empty($user)) {
                    $this->error = 'Sai username hoặc password';
                } else {
                    $_SESSION['success'] = 'Đăng nhập thành công';
                    $_SESSION['user'] = $user;
                    if($user['role'] == 1){
                        header("Location: index.php?controller=home&action=index");
                    exit();
                    }
                    elseif($user['role'] == 2){
                        header('Location: index.php?controller=manage&action=index');
                        exit();
                    }
                    elseif($user['role'] == 0){
                        header('Location: index.php?controller=user');
                        exit();
                    }
                }
            }
        }
        $this->content = $this->render('views/users/login.php');

        require_once 'views/layouts/main_login.php';
    }

    /**
     * Đăng ký tài khoản mới, mặc định tất cả các user đều có quyền admin
     */
    public function register() {
        if (isset($_POST['submit']) && isset($_POST['role'])) {
            $user_model = new User();
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $password_confirm = $_POST['password_confirm'];
            $user = $user_model->getUserByUsername($username);
            if (empty($username) || empty($password) || empty($password_confirm) || empty($role)) {
                $this->error = 'Không được để trống các trường';
            }else if(strlen($username)<=8) {
                $this->error = 'Tên đăng nhập có độ dài lớn hơn 8 kí tự';
            }else if(strlen($password)<=8) {
                $this->error = 'Mật khẩu có độ dài lớn hơn 8 kí tự';
            } else if ($password != $password_confirm) {
                $this->error = 'Password nhập lại chưa đúng';
            } else if (!empty($user)) {
                $this->error = 'Username này đã tồn tại';
            }
            if (empty($this->error)) {
                $user_model->username = $username;
                $user_model->password = $password;
                $user_model->role = $role;
                $is_insert = $user_model->insertRegister();
                if ($is_insert) {
                    $_SESSION['success'] = 'Đăng ký thành công';
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    $_SESSION['role'] = $role;
                } else {
                    $_SESSION['error'] = 'Đăng ký thất bại';
                }
                $id = $user_model->getId($username,$password,$role);
                header('Location: index.php?controller=login&action=insertProfile&id='.$id['id']);
                exit();
            }
        }

        $this->content = $this->render('views/users/register.php');
        require_once 'views/layouts/main_login.php';
    }

    public function insertProfile() {
        $user_model = new User();
        if (isset($_POST['submit'])) {
        //    $password_confirm = $_POST['password_confirm'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $street = $_POST['street'];
            $district = $_POST['district'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $home_number = $_POST['home_number'];
            $city = $_POST['city'];
            $job = $_POST['job'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $role = $_POST['role'];
            //xử lý validate
            if (empty($this->error)) {
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
                $user_model->username = $username;
                $user_model->password = $password;
                $user_model->role = $role;
                $user_model->id = $_GET['id'];
                $is_insert = $user_model->insert(); // insert profile
                if ($is_insert) {
                    $_SESSION['success'] = 'Dang Ki thành công';
                    header('Location: index.php?controller=home');
                    exit();
                } else {
                    $_SESSION['error'] = 'Insert dữ liệu thất bại';
                }
               
            }
        }

        $this->content = $this->render('views/home/home_register.php');

        require_once 'views/layouts/main_login.php';
    }
}
