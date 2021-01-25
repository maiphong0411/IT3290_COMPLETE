<h2>Danh sách user</h2>
<!-- <a href="index.php?controller=user&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a> -->
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>first_name</th>
        <th>last_name</th>
        <th>gender</th>
        <th>phone</th>
        <th>email</th>
        <th>city</th>
        <th>address</th>
        <th>dob</th>
        <th>avatar</th>
        <th>jobs</th>
        <th>role</th>
        <th>account_start</th>
    </tr>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td><?php echo $user['username'] ?></td>
                <td><?php echo $user['first_name'] ?></td>
                <td><?php echo $user['last_name'] ?></td>
                <td>
                    <?php 
                        $gender = $user['gender'] ==  M ? 'Nam' : 'Nữ';
                        echo $gender; 
                    ?>
                </td>
                <td><?php echo $user['phone'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['city'] ?></td>
                <td>
                    <?php 
                        echo $user['home_number'] . " " .$user['street']. " ". $user['district'] 
                    ?>
                </td>
                <td><?php echo $user['dob'] ?></td>
                <td>
                    <?php if (!empty($user['avatar'])): ?>
                        <img height="80" src="assets/uploads/<?php echo $user['avatar'] ?>"/>
                    <?php endif; ?>
                </td>
                <td><?php echo $user['job'] ?></td>
                <td>
                    <?php 
                        if($user['role'] == 2) {
                            echo "Người cho thuê";
                        }  
                        elseif ($user['role'] == 1) {
                            echo "Người thuê";
                        }
                        else {
                            echo "Người cho thuê & người thuê";
                        }
                    ?>
                </td>
                <td><?php echo date('d-m-Y', strtotime($user['account_start'])) ?></td>
                
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
    <?php endif; ?>
</table>
<?php echo $pages; ?>