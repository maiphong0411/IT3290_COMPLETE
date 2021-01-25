<?php
require_once 'helpers/Helper.php';
?>
<h2>Chi tiết user</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $user['id'] ?></td>
    </tr>
    <tr>
        <th>username</th>
        <td><?php echo $user['username'] ?></td>
    </tr>
    <tr>
        <th>first_name</th>
        <td><?php echo $user['first_name'] ?></td>
    </tr>
    <tr>
        <th>last_name</th>
        <td><?php echo $user['last_name'] ?></td>
    </tr>
    <tr>
        <th>gender</th>
        <td>
        <?php 
            $gender = $user['gender'] ==  M ? 'Nam' : 'Nữ';
            echo $gender; 
        ?>
        </td>
    </tr>
    <tr>
        <th>email</th>
        <td><?php echo $user['email'] ?></td>
    </tr>
    <tr>
        <th>phone</th>
        <td><?php echo $user['phone'] ?></td>
    </tr>
    <tr>
        <th>dob</th>
        <td><?php echo $user['dob'] ?></td>
    </tr>
    <tr>
        <th>job</th>
        <td><?php echo $user['job'] ?></td>
    </tr>
    <tr>
        <th>address</th>
        <td><?php echo $user['home_number'] . " " .$user['street']. " ". $user['district'] ?></td>
    </tr>
    <tr>
        <th>avatar</th>
        <td>
            <?php if (!empty($user['avatar'])): ?>
                <img height="80" src="assets/uploads/<?php echo $user['avatar'] ?>"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>role</th>
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
    </tr>
    <tr>
        <th>account_start</th>
        <td><?php echo date('d-m-Y', strtotime($user['account_start'])) ?></td>
    </tr>
</table>
<a href="index.php?controller=user&action=index" class="btn btn-default">Back</a>