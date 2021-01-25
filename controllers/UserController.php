<?php
require_once 'controllers/Controller.php';
require_once 'models/User.php';
require_once 'models/Pagination.php';
// require_once 'models/District.php';
class UserController extends Controller {
    public function index() {
        $user_model = new User();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        // $district_model = new District();
        $total = $user_model->getTotal();
        $query_additional = '';
        if (isset($_GET['username'])) {
            $query_additional .= "&username=" . $_GET['username'];
        }
        if (isset($_GET['role'])) {
            $query_additional .= '&role=' . $_GET['role'];
        }
        if (isset($_GET['job'])) {
            $query_additional .= '&job=' . $_GET['job'];
        }
        if (isset($_GET['city'])) {
            $query_additional .= '&city=' . $_GET['city'];
        }
        if (isset($_GET['gender'])) {
            $query_additional .= '&gender=' . $_GET['gender'];
        }
        if (isset($_GET['start'])) {
            $query_additional .= '&start=' . $_GET['start'];
        }
        if (isset($_GET['end'])) {
            $query_additional .= '&end=' . $_GET['end'];
        }
        $params = [
            'total' => $total,
            'limit' => 10,
            'query_string' => 'page',
            'controller' => 'user',
            'action' => 'index',
            'page' => $page,
            'query_additional' => $query_additional
        ];
        $pagination = new Pagination($params);
        $pages = $pagination->getPagination();
        $users = $user_model->getAllPagination($params);
        
        $this->content = $this->render('views/users/index.php', [
            'count_total' => $total,
            'users' => $users,
            'pages' => $pages,
        ]);

        require_once 'views/layouts/main.php';
    }

    public function create() {
        $user_model = new User();
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
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
            if (empty($username)) {
                $this->error = 'Username không được để trống';
            } else if (empty($password)) {
                $this->error = 'Password không được để trống';
            } else if (empty($password_confirm)) {
                $this->error = 'Password confirm không được để trống';
            } else if ($password != $password_confirm) {
                $this->error = 'Password confirm chưa đúng';
            } else if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
            } else if (!empty($username)) {
                //kiếm tra xem username đã tồn tại trong DB hay chưa, nếu tồn tại sẽ báo lỗi
                $count_user = $user_model->getUserByUsername($username);
                if ($count_user) {
                    $this->error = 'Username này đã tồn tại trong CSDL';
                }
            }

            if (empty($this->error)) {
                $filename = '';
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = __DIR__ . '/../assets/uploads';
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }

                    $filename = time() . '-user-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
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
                $user_model->insertRegister();
                $user_model->id = $user_model->getId($username, $password, $role);
                $is_insert = $user_model->insert();
                if ($is_insert) {
                    $_SESSION['success'] = 'Insert dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Insert dữ liệu thất bại';
                }
                header('Location: index.php?controller=user');
                exit();
            }
        }

        $this->content = $this->render('views/users/create.php');

        require_once 'views/layouts/main.php';
    }

    public function update() {
 //       if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  //          header("Location: index.php?controller=home");
  //          exit();
  //      }

        $id = $_GET['id'];
        $user_model = new User();

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
                header('Location: index.php?controller=user');
                exit();
            }
        }

        $this->content = $this->render('views/users/update.php', [
            'user' => $user
        ]);

        require_once 'views/layouts/main.php';
    }

    public function delete() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=user');
            exit();
        }

        $id = $_GET['id'];
        $user_model = new User();
        $is_delete = $user_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: index.php?controller=user');
        exit();
    }

    public function detail() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php?controller=user");
            exit();
        }
        $id = $_GET['id'];
        $user_model = new User();
        $user = $user_model->getById($id);

        $this->content = $this->render('views/users/detail.php', [
            'user' => $user
        ]);

        require_once 'views/layouts/main.php';
    }

    public function logout() {

//        session_destroy();
        $_SESSION = [];
        session_destroy();
       unset($_SESSION['user']);
        $_SESSION['success'] = 'Logout thành công';
        header('Location: index.php?controller=login&action=index');
        exit();
    }
}