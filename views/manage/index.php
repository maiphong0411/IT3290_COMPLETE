<?php
require_once 'helpers/Helper.php';
?>
<!--form search-->


<h2>Danh sách phòng</h2>
    <a href="index.php?controller=manage&action=create_room" class="btn btn-success">
        <i class="fa fa-plus"></i> Thêm mới
    </a>
<table class="table table-bordered">
    <tr>
        <th>RoomID</th>
        <th>Detail</th>
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
                        $user_detail = "index.php?controller=manage&action=detail&id=" . $product['roomid'];
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
                    $url_detail = "index.php?controller=manage&action=detail&id=" . $product['roomid'];
                    $url_update = "index.php?controller=manage&action=updateroom&id=" . $product['roomid'];
                    $url_delete = "index.php?controller=manage&action=delete&id=" . $product['roomid'];
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
