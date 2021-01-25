<?php
require_once 'helpers/Helper.php';
?>
<!--form search-->
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
        <div class="form-group col-md-2">
            <label for="title">Date_start</label>
            <input type="date" name="date_start" class="form-control" value="<?php echo isset($_GET['date_start']) ? $_GET['date_start'] : '' ?>">
        </div>
        <div class="form-group col-md-2">
            <label for="title">Expire</label>
            <input type="date" name="expire" class="form-control" value="<?php echo isset($_GET['expire']) ? $_GET['expire'] : '' ?>">
        </div>
    </div>
    <input type="hidden" name="controller" value="product"/>
    <input type="hidden" name="action" value="index"/>
    <input type="submit" name="search" value="Tìm kiếm" class="btn btn-primary"/>
    <a href="index.php?controller=product" class="btn btn-default">Xóa filter</a>
</form>

<div class="row justify-content-between">
    <div class="col-md-6">
        <h2>Danh sách phòng</h2>
    </div>
    <div class="col-md-6">
        <h1 class="text-danger text-uppercase font-weight-bold">Có tất cả <?php echo $count_total; ?> bản ghi</h1>
    </div>
</div>

    <!-- <a href="index.php?controller=product&action=create" class="btn btn-success">
        <i class="fa fa-plus"></i> Thêm mới
    </a> -->
<table class="table table-bordered">
    <tr>
        <th>RoomID</th>
        <th>Chủ phòng</th>
        <th>Address</th>
        <th>City</th>
        <th>Max_people</th>
        <th>Parking</th>
        <th>Time</th>
        <th>WC</th>
        <th>Heater</th>
        <th>Air Condition</th>
        <th>Description</th>
        <th>Price</th>
        <th>Type_room</th>
        <th>Area</th>
        <th>Date_start</th>
        <th>Expire</th>
        <th></th>
    </tr>
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['roomid'] ?></td>
                <td><?php 
                        $user_detail = "index.php?controller=user&action=detail&id=" . $product['tenantid'];
                        echo $product['first_name'] ." " . $product['last_name']?>
                    <a title="Chi tiết" href="<?php echo $user_detail ?>" ><i class="fa fa-eye"></i></a>
                </td>
                <td>
                    <?php 
                        echo $product['home_number'] . " " .$product['street']. " ". $product['district'] 
                    ?>
                </td>
                <td>
                    <?php echo $product['city']; ?>
                </td>
                <td><?php echo $product['max_people'] ?></td>
                <td>
                    <?php 
                        if($product['parking'] == 1) echo "Có";
                        else echo "Không";
                    ?>
                </td>
                <td><?php echo $product['time'] ?></td>
                <td>
                    <?php 
                        if($product['wc_type'] == 1) echo "Có";
                        else echo "Không";
                    ?>
                </td>
                <td>
                    <?php 
                        if($product['heater'] == 1) echo "Có";
                        else echo "Không";
                    ?>
                </td>
                <td>
                    <?php 
                        if($product['aircondition'] == 1) echo "Có";
                        else echo "Không";
                    ?>
                </td>
                <td><?php echo $product['description']?></td>
                <td><?php echo $product['price']?></td>
                <td><?php echo $product['type_room']?></td>
                <td><?php echo $product['area']?></td>
                <td><?php echo date('d-m-Y', strtotime($product['date_start'])) ?></td>
                <td><?php echo date('d-m-Y', strtotime($product['expire'])) ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=product&action=detail&id=" . $product['roomid'];
                    $url_update = "index.php?controller=product&action=update&id=" . $product['roomid'];
                    $url_delete = "index.php?controller=product&action=delete&id=" . $product['roomid'];
                    ?>
                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                    <a title="Update" href="<?php echo $url_update ?>"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i
                                class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php else: ?>
        <tr>
            <td colspan="9">No data found</td>
        </tr>
    <?php endif; ?>
</table>
<?php echo $pages; ?>