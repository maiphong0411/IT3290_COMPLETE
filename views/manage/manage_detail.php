<?php
require_once 'helpers/Helper.php';
?>
<table class="table table-bordered">
    <tr>
        <th>RoomID</th>
        <td><?php echo $product['roomid']?></td>
    </tr>
    <tr>
        <th>Chủ phòng</th>
        <td><?php  echo $product['first_name'] ." " . $product['last_name']?></td>
    </tr>
    <tr>
        <th>Address</th>
        <td><?php 
            echo $product['home_number'] . " " .$product['street']. " ". $product['district'] 
        ?></td>
    </tr>
    <tr>
        <th>Max_people</th>
        <td><?php echo $product['max_people'] ?></td>
    </tr>
    <tr>
        <th>Parking</th>
        <td>
            <?php 
                if($product['parking'] == 1) echo "Có";
                else echo "Không";
            ?>
        </td>
    </tr>
    <tr>
        <th>Time</th>
        <td><?php echo $product['time'] ?></td>
    </tr>
    <tr>
        <th>WC</th>
        <td>
            <?php 
                if($product['wc_type'] == 1) echo "Có";
                else echo "Không";
            ?>
        </td>
    </tr>
    <tr>
        <th>Heater</th>
        <td>
            <?php 
                if($product['heater'] == 1) echo "Có";
                else echo "Không";
            ?>
        </td>
    </tr>
    <tr>
        <th>Air Condition</th>
        <td>
            <?php 
                if($product['aircondition'] == 1) echo "Có";
                else echo "Không";
            ?>
        </td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?php echo $product['description'] ?></td>
    </tr>
    
    <tr>
        <th>Price</th>
        <td><?php echo number_format($product['price']) ?></td>
    </tr>
    <tr>
        <th>Type_room</th>
        <td><?php echo $product['type_room'] ?></td>
    </tr>
    <tr>
        <th>Area</th>
        <td><?php echo $product['area'] ?></td>
    </tr>
    <tr>
        <th>Date_start</th>
        <td><?php echo date('d-m-Y', strtotime($product['date_start'])) ?></td>
    </tr>
    <tr>
    <th>Expire</th>
        <td><?php echo date('d-m-Y', strtotime($product['expire'])) ?></td>
    </tr>
</table>
<a href="index.php?controller=manage&action=index" class="btn btn-default">Back</a>