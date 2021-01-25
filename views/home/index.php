
 <!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="shortcut icon" href="img/fav.png">


<meta name="author" content="codepixer">

<meta name="description" content="">

<meta name="keywords" content="">

<meta charset="UTF-8">

<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">

<link rel="stylesheet" href="assets/css/linearicons.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/magnific-popup.css">
<link rel="stylesheet" href="assets/css/nice-select.css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/owl.carousel.css">
<link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<section class="banner-area relative" id="home" data-parallax="scroll" data-image-src="img/header-bg.jpg">
<div class="overlay-bg overlay"></div>
<div class="container">
<div class="row fullscreen d-flex align-items-center justify-content-center">
<div class="banner-content col-lg-8 col-md-12">

<h1 class="text-uppercase">
Tìm nhà trọ
</h1>
<p class="text-white">
Luôn luôn nắng nghe, luôn luôn thấu hiểu.
</p>

</div>
</div>
</div>
</section>
<section class="projects-area pb-100" id="project">
<div class="container-fluid">
<div class="row d-flex justify-content-center">
<div class="menu-content pb-60 col-lg-8">
<div class="title text-center">
<h1 class="mb-10">Phòng trọ</h1>
<p>Khi bạn cần chúng tôi có,khi bạn có chúng tôi cần !</p>
</div>
</div>
</div>
<form action="" method="GET">
    <div class="row">
        <div class="form-group col-md-2">
            <label for="title">Nhập tên chủ trọ</label>
            <input type="text" name="title" value="<?php echo isset($_GET['title']) ? $_GET['title'] : '' ?>" id="title"
                class="form-control"/>
        </div>
        <div class="form-group col-md-2">
            <label for="title">City</label>
            <select name="city" class="form-control">
                <option value="" >Chọn</option>
                <option value="1" <?php if (isset($_GET['city']) && $_GET['city'] === '1') echo "selected";?>>Hà Nội</option>
                <option value="2" <?php if (isset($_GET['city']) && $_GET['city'] === '2') echo "selected";?>>TP HCM</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="max_people">Max_people</label>
            <select name="max_people" class="form-control">
                <option value="" >Chọn</option>
                <option value="1" <?php if (isset($_GET['max_people']) && $_GET['max_people'] === '1') echo "selected";?>>1-5</option>
                <option value="2" <?php if (isset($_GET['max_people']) && $_GET['max_people'] === '2') echo "selected";?>>5-10</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="title">Parking</label>
            <select name="parking" class="form-control">
                <option value="" >Chọn</option>
                <option value="1" <?php if (isset($_GET['parking']) && $_GET['parking'] === '1') echo "selected";?>>Có</option>
                <option value="2" <?php if (isset($_GET['parking']) && $_GET['parking'] === '2') echo "selected";?>>Không</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="title">Heater</label>
            <select name="heater" class="form-control">
                <option value="" >Chọn</option>
                <option value="1" <?php if (isset($_GET['heater']) && $_GET['heater'] === '1') echo "selected";?>>Có</option>
                <option value="2" <?php if (isset($_GET['heater']) && $_GET['heater'] === '2') echo "selected";?>>Không</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="title">aircondition</label>
            <select name="aircondition" class="form-control">
                <option value="" >Chọn</option>
                <option value="1" <?php if (isset($_GET['aircondition']) && $_GET['aircondition'] === '1') echo "selected";?>>Có</option>
                <option value="2" <?php if (isset($_GET['aircondition']) && $_GET['aircondition'] === '2') echo "selected";?>>Không</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="title">Type_room</label>
            <select name="type_room" class="form-control">
                <option value="" >Chọn</option>
                <option value="Nha Tro" <?php if (isset($_GET['type_room']) && $_GET['type_room'] === 'Nha Tro') echo "selected";?>>Nhà trọ</option>
                <option value="Nha Rieng" <?php if (isset($_GET['type_room']) && $_GET['type_room'] === 'Nha Rieng') echo "selected";?>>Nhà riêng</option>
                <option value="Chung Cu" <?php if (isset($_GET['type_room']) && $_GET['type_room'] === 'Chung Cu') echo "selected";?>>Chung cư</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="title">Price</label>
            <select name="price" class="form-control">
                <option value="" >Chọn</option>
                <option value="1" <?php if (isset($_GET['price']) && $_GET['price'] === '1') echo "selected";?>><5000000</option>
                <option value="2" <?php if (isset($_GET['price']) && $_GET['price'] === '2') echo "selected";?>>5000000->10000000</option>
                <option value="3" <?php if (isset($_GET['price']) && $_GET['price'] === '3') echo "selected";?>>>10000000</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="title">area</label>
            <select name="area" class="form-control">
                <option value="" >Chọn</option>
                <option value="1" <?php if (isset($_GET['area']) && $_GET['area'] === '1') echo "selected";?>><40</option>
                <option value="2" <?php if (isset($_GET['area']) && $_GET['area'] === '2') echo "selected";?>>40->70</option>
                <option value="3" <?php if (isset($_GET['area']) && $_GET['area'] === '3') echo "selected";?>>70->100</option>
                <option value="4" <?php if (isset($_GET['area']) && $_GET['area'] === '4') echo "selected";?>>>100</option>
            </select>
        </div>
    </div>
    <input type="hidden" name="controller" value="home"/>
    <input type="hidden" name="action" value="search"/>
    <input type="submit" name="search" value="Tìm kiếm" class="btn btn-primary"/>
    <a href="index.php?controller=home" class="btn btn-default">Xóa filter</a>
</form>
<h2>Danh sách phòng</h2>
<table width='600px' >
<?php if(!empty($products)): ?>
<?php foreach($products as $product): ?>   

    <tr>
        <tr align='center' > 
            <td colspan='2'><h3>Thông tin phòng</h3></td>
        </tr>
    <!--<tr>
            <td>ID</td>
            <td><?php echo $product['roomid'];?></td>
        </tr> -->
        <tr>
            
            <td>Chủ Phòng</td>
            <td><?php 
                        $user_detail = "index.php?controller=home&action=detail&id=" . $product['roomid'];
                        echo $product['first_name'] ." " . $product['last_name']?>
                    <a title="Chi tiết" href="<?php echo $user_detail ?>" ><i class="fa fa-eye"></i></a>
                </td>
        </tr>
        <tr>
            <td>Địa chỉ</td>
            <td>
                    <?php 
                        echo $product['home_number'] . " " .$product['street']. " ". $product['district'] 
                    ?>
                </td>
        </tr>
        <tr>
            <td>Thành Phố</td>
            <td>
                    <?php echo $product['city']; ?>
            </td>
        </tr>
        <tr>
            <td>Giá</td>
            <td><?php echo $product['price']?></td>
        </tr>
        <tr>
            <td>Loại Phòng</td>
            <td><?php echo $product['type_room']?></td>
        </tr>
        
    </tr>
    <?php endforeach; ?>
    <?php else: ?>
    
        <tr>
            <td colspan="9">No data found</td>
        </tr>
    <?php endif; ?>
</table>
<?php echo $pages; ?>
</div>
</div>
</div>
</div>
</section>


<footer class="footer-area section-gap">
<div class="container">
<div class="row">
<div class="col-lg-3  col-md-6 col-sm-6">
<div class="single-footer-widget">
<h4 class="text-white">About Us</h4>
<p>
Nhóm phát triển gồm có 3 thành viên.</br>
Trần Công Hoan </br>
Mai Thế Phong </br>
Nguyễn Gia Minh </br>
</p>
</div>
</div>
<div class="col-lg-4  col-md-6 col-sm-6">
<div class="single-footer-widget">
<h4 class="text-white">Contact Us</h4>
<p>
Hãy liên lạc với chúng tôi nếu bạn cần !</br>
 ありがとうございます。
</p>
<p class="number">
0396651152 </br>
0943329862
</p>
</div>
</div>
<div class="col-lg-5  col-md-6 col-sm-6">
<div class="single-footer-widget">
<h4 class="text-white">Newsletter</h4>
<p>You can trust us. we only send offers, not a single spam.</p>
<div class="d-flex flex-row" id="mc_embed_signup">
<form class="navbar-form" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get">
<div class="input-group add-on">
<input class="form-control" name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required="" type="email">
<div style="position: absolute; left: -5000px;">
<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
</div>
<div class="input-group-btn">
<button class="genric-btn primary circle arrow"><span class="lnr lnr-arrow-right"></span></button>
</div>
</div>
<div class="info mt-20"></div>
</form>
</div>
</div>
</div>
</div>
<div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">

<p class="footer-text m-0">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved  <i class="fa fa-heart-o" aria-hidden="true"></i> </p>

<div class="footer-social d-flex align-items-center">
<a href="#"><i class="fa fa-facebook"></i></a>
<a href="#"><i class="fa fa-twitter"></i></a>
<a href="#"><i class="fa fa-dribbble"></i></a>
<a href="#"><i class="fa fa-behance"></i></a>
</div>
</div>
</div>
</footer>

<script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="../assets/js/vendor/bootstrap.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<script src="../assets/js/easing.min.js"></script>
<script src="../assets/js/hoverIntent.js"></script>
<script src="../assets/js/superfish.min.js"></script>
<script src="../assets/js/jquery.ajaxchimp.min.js"></script>
<script src="../assets/js/jquery.magnific-popup.min.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/jquery.sticky.js"></script>
<script src="../assets/js/jquery.nice-select.min.js"></script>
<script src="../assets/js/parallax.min.js"></script>
<script src="../assets/js/waypoints.min.js"></script>
<script src="../assets/js/jquery.counterup.min.js"></script>
<script src="../assets/js/mail-script.js"></script>
<script src="../assets/js/main.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"60adbb4ef8bc24b2","version":"2020.12.2","si":10}'></script>
</body>
</html>
