<h2>Danh sách user care</h2>
<!-- <a href="index.php?controller=user&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a> -->
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>RoomID</th>
        <th>first_name</th>
        <th>last_name</th>
        <th>gender</th>
        <th>phone</th>
        <th>email</th>
        <th>city</th>
        <th>address</th>
        <th>dob</th>
        
        <th>jobs</th>
        
        <th>account_start</th>
    </tr>
    <?php if (!empty($renters)): ?>
        <?php foreach ($renters as $renter): ?>
            <tr>
                <td><?php echo $renter['id'] ?></td>
                <td><?php echo $renter['roomid'] ?></td>
                <td><?php echo $renter['first_name'] ?></td>
                <td><?php echo $renter['last_name'] ?></td>
                <td>
                    <?php 
                        $gender = $renter['gender'] ==  M ? 'Nam' : 'Nữ';
                        echo $gender; 
                    ?>
                </td>
                <td><?php echo $renter['phone'] ?></td>
                <td><?php echo $renter['email'] ?></td>
                <td><?php echo $renter['city'] ?></td>
                <td>
                    <?php 
                        echo $renter['home_number'] . " " .$renter['street']. " ". $renter['district'] 
                    ?>
                </td>
                <td><?php echo $renter['dob'] ?></td>
               
                <td><?php echo $renter['job'] ?></td>
                <td><?php echo date('d-m-Y', strtotime($renters['account_start'])) ?></td>
                
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
    <?php endif; ?>
</table>
<?php echo $pages; ?>