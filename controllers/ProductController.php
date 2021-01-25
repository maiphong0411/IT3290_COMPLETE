<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';
require_once 'models/Pagination.php';

class ProductController extends Controller
{
    public function index()
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
        if (isset($_GET['date_start'])) {
            $query_additional .= '&date_start=' . $_GET['date_start'];
        }
        if (isset($_GET['expire'])) {
            $query_additional .= '&expire=' . $_GET['expire'];
        }
        $params = [
            'total' => $count_total,
            'limit' => 15,
            'query_string' => 'page',
            'controller' => 'product',
            'action' => 'index',
            'full_mode' => false,
            'query_additional' => $query_additional,
            'page' => isset($_GET['page']) ? $_GET['page'] : 1
        ];
        $pagination = new Pagination($params);
        $pages = $pagination->getPagination();
        $products = $product_model->getAllPagination($params);
        $this->content = $this->render('views/rooms/index.php', [
            'count_total' => $count_total,
            'products' => $products,
            'pages' => $pages,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function create()
    {
        if (isset($_POST['submit'])) {
        $category_id = $_POST['category_id'];
        $title = $_POST['title'];
        $price = $_POST['price'];
        $amount = $_POST['amount'];
        $summary = $_POST['summary'];
        $content = $_POST['content'];
        $seo_title = $_POST['seo_title'];
        $seo_description = $_POST['seo_description'];
        $seo_keywords = $_POST['seo_keywords'];
        $status = $_POST['status'];
        if (empty($title)) {
            $this->error = 'Không được để trống title';
        } else if ($_FILES['avatar']['error'] == 0) {
            $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];

            $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
            $file_size_mb = round($file_size_mb, 2);

            if (!in_array($extension, $arr_extension)) {
            $this->error = 'Cần upload file định dạng ảnh';
            } else if ($file_size_mb > 2) {
            $this->error = 'File upload không được quá 2MB';
            }
        }

        if (empty($this->error)) {
            $filename = '';
            if ($_FILES['avatar']['error'] == 0) {
            $dir_uploads = __DIR__ . '/../assets/uploads';
            if (!file_exists($dir_uploads)) {
                mkdir($dir_uploads);
            }
            $filename = time() . '-product-' . $_FILES['avatar']['name'];
            move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
            }
            //save dữ liệu vào bảng products
            $product_model = new Product();
            $product_model->category_id = $category_id;
            $product_model->title = $title;
            $product_model->avatar = $filename;
            $product_model->price = $price;
            $product_model->amount = $amount;
            $product_model->summary = $summary;
            $product_model->content = $content;
            $product_model->seo_title = $seo_title;
            $product_model->seo_description = $seo_description;
            $product_model->seo_keywords = $seo_keywords;
            $product_model->status = $status;
            $is_insert = $product_model->insert();
            if ($is_insert) {
            $_SESSION['success'] = 'Insert dữ liệu thành công';
            } else {
            $_SESSION['error'] = 'Insert dữ liệu thất bại';
            }
            header('Location: index.php?controller=product');
            exit();
        }
        }

        $category_model = new Category();
        $categories = $category_model->getAll();

        $this->content = $this->render('views/products/create.php', [
            'categories' => $categories
        ]);
        require_once 'views/layouts/main.php';
    }
    
    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['error'] = 'ID không hợp lệ';
        header('Location: index.php?controller=product');
        exit();
        }

        $id = $_GET['id'];
        $product_model = new Product();
        $product = $product_model->getById($id);

        $this->content = $this->render('views/rooms/detail.php', [
            'product' => $product
        ]);
        require_once 'views/layouts/main.php';
    }

    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['error'] = 'ID không hợp lệ';
        header('Location: index.php?controller=product');
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
            header('Location: index.php?controller=product');
            exit();
        }
        }

        $this->content = $this->render('views/rooms/update.php', [
            'product' => $product,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['error'] = 'ID không hợp lệ';
        header('Location: index.php?controller=product');
        exit();
        }

        $id = $_GET['id'];
        $product_model = new Product();
        $is_delete = $product_model->delete($id);
        if ($is_delete) {
        $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
        $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: index.php?controller=product');
        exit();
    }
}